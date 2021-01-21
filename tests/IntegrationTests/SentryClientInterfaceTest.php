<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\IntegrationTests;

use ArrayIterator;
use CodeKandis\PhpUnit\TestCase;
use CodeKandis\SentryClient\Configurations\SentryClientConfigurationInterface;
use CodeKandis\SentryClient\SentryClient;
use CodeKandis\SentryClient\Severities;
use CodeKandis\SentryClient\Tests\DataProviders\SentryClientInterfaceTest\InitiatedSentryClientConfigurationsWithErrorsExpectedErrorHandlerClassesEventTitlesAndOutputRegExsDataProvider;
use CodeKandis\SentryClient\Tests\DataProviders\SentryClientInterfaceTest\InitiatedSentryClientConfigurationsWithErrorsSeveritiesContextsTagsUsersExpectedEventTitlesTagsUsersAndOutputRegExsDataProvider;
use CodeKandis\SentryClient\Tests\DataProviders\SentryClientInterfaceTest\InitiatedSentryClientConfigurationsWithMessagesSeveritiesContextsTagsUsersExpectedEventTitlesTagsUsersAndOutputRegExsDataProvider;
use CodeKandis\SentryClient\Tests\DataProviders\SentryClientInterfaceTest\InitiatedSentryClientConfigurationsWithThrowablesExpectedThrowableHandlerClassesEventTitlesAndOutputRegExsDataProvider;
use CodeKandis\SentryClient\Tests\DataProviders\SentryClientInterfaceTest\InitiatedSentryClientConfigurationsWithThrowablesSeveritiesContextsTagsUsersExpectedEventTitlesTagsUsersAndOutputRegExsDataProvider;
use CodeKandis\SentryClient\Tests\Helpers\Constants\TestConstants;
use CodeKandis\SentryClient\Tests\Helpers\SentryApi\ApiRequests;
use Throwable;
use function error_reporting;
use function restore_error_handler;
use function restore_exception_handler;
use function set_error_handler;
use function set_exception_handler;
use function sleep;
use function trigger_error;
use const E_NOTICE;

/**
 * Represents the test case of the `SentryClientInterface`.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class SentryClientInterfaceTest extends TestCase
{
	/**
	 * Provides initiated `SentryClient` configurations with throwables, expected throwable handler classes, event titles and output regular expressions.
	 * @return ArrayIterator The initiated `SentryClient` configurations with throwables, expected throwable handler classes, event titles and output regular expressions.
	 */
	public function initiatedSentryClientConfigurationsWithErrorsExpectedErrorHandlerClassesEventTitlesAndOutputRegExsDataProvider(): ArrayIterator
	{
		return new InitiatedSentryClientConfigurationsWithErrorsExpectedErrorHandlerClassesEventTitlesAndOutputRegExsDataProvider();
	}

	/**
	 * Tests if the throwable handler will be registered correctly and captures throwables automatically.
	 * @param SentryClientConfigurationInterface $sentryClientConfiguration The initiated `SentryClientConfigurationTest`.
	 * @param int $errorCode The code of the error to capture.
	 * @param string $errorMessage The message of the error to capture.
	 * @param string $errorFile The file of the error to capture.
	 * @param int $errorLine The line of the error to capture.
	 * @param string $expectedErrorHandlerClass The expected error handler class.
	 * @param string $expectedEventTitle The expected event title.
	 * @param string $expectedOutputRegEx The expected output regular expression.
	 * @dataProvider initiatedSentryClientConfigurationsWithErrorsExpectedErrorHandlerClassesEventTitlesAndOutputRegExsDataProvider
	 */
	public function testRegisterWithAutomaticallyErrorCapturing( SentryClientConfigurationInterface $sentryClientConfiguration, int $errorCode, string $errorMessage, string $errorFile, int $errorLine, string $expectedErrorHandlerClass, string $expectedEventTitle, string $expectedOutputRegEx ): void
	{
		$sentryClient = new SentryClient( $sentryClientConfiguration );
		$sentryClient->register();

		$errorHandler = set_error_handler(
			static function ( int $code, string $message, string $file, int $line ): void
			{
			}
		);
		restore_error_handler();
		$errorHandler( $errorCode, $errorMessage, $errorFile, $errorLine );
		$eventId = $sentryClient->getLastEventId();

		sleep( TestConstants::EVENT_PROCESSING_THRESHOLD );

		$apiEventRequests = new ApiRequests(
			TestConstants::API_URI,
			TestConstants::AUTH_TOKEN,
			TestConstants::COMPANY_NAME,
			TestConstants::PROJECT_NAME
		);
		$event            = $apiEventRequests->getEvent( $eventId );

		$resultedTitle = $event[ 'title' ];

		static::assertInstanceOf( $expectedErrorHandlerClass, $errorHandler );
		static::assertSame( $sentryClient->getErrorHandler(), $errorHandler );
		static::assertSame( $expectedEventTitle, $resultedTitle );

		$this->expectOutputRegex( '~' . $expectedOutputRegEx . '~' );
	}

	/**
	 * Provides initiated `SentryClient` configurations with throwables, expected throwable handler classes, event titles and output regular expressions.
	 * @return ArrayIterator The initiated `SentryClient` configurations with throwables, expected throwable handler classes, event titles and output regular expressions.
	 */
	public function initiatedSentryClientConfigurationsWithThrowablesExpectedThrowableHandlerClassesEventTitlesAndOutputRegExsDataProvider(): ArrayIterator
	{
		return new InitiatedSentryClientConfigurationsWithThrowablesExpectedThrowableHandlerClassesEventTitlesAndOutputRegExsDataProvider();
	}

	/**
	 * Tests if the throwable handler will be registered correctly and captures throwables automatically.
	 * @param SentryClientConfigurationInterface $sentryClientConfiguration The initiated `SentryClientConfigurationTest`.
	 * @param Throwable $throwable The throwable to capture.
	 * @param string $expectedThrowableHandlerClass The expected throwable handler class.
	 * @param string $expectedEventTitle The expected event title.
	 * @param string $expectedOutputRegEx The expected output regular expression.
	 * @dataProvider initiatedSentryClientConfigurationsWithThrowablesExpectedThrowableHandlerClassesEventTitlesAndOutputRegExsDataProvider
	 */
	public function testRegisterWithAutomaticallyThrowableCapturing( SentryClientConfigurationInterface $sentryClientConfiguration, Throwable $throwable, string $expectedThrowableHandlerClass, string $expectedEventTitle, string $expectedOutputRegEx ): void
	{
		$sentryClient = new SentryClient( $sentryClientConfiguration );
		$sentryClient->register();

		$throwableHandler = set_exception_handler(
			static function ( Throwable $throwable ): void
			{
			}
		);
		restore_exception_handler();
		$throwableHandler( $throwable );
		$eventId = $sentryClient->getLastEventId();

		sleep( TestConstants::EVENT_PROCESSING_THRESHOLD );

		$apiEventRequests = new ApiRequests(
			TestConstants::API_URI,
			TestConstants::AUTH_TOKEN,
			TestConstants::COMPANY_NAME,
			TestConstants::PROJECT_NAME
		);
		$event            = $apiEventRequests->getEvent( $eventId );

		$resultedTitle = $event[ 'title' ];

		static::assertInstanceOf( $expectedThrowableHandlerClass, $throwableHandler );
		static::assertSame( $sentryClient->getThrowableHandler(), $throwableHandler );
		static::assertSame( $expectedEventTitle, $resultedTitle );

		$this->expectOutputRegex( '~' . $expectedOutputRegEx . '~' );
	}

	/**
	 * Provides initiated sentry client configurations with messages, severities, contexts, tags, users, expected event titles, tags, users and output regular expressions.
	 * @return ArrayIterator The initiated sentry client configurations with messages, severities, contexts, tags, users, expected event titles, tags, users and output regular expressions.
	 */
	public function initiatedSentryClientConfigurationsWithMessagesSeveritiesContextsTagsUsersExpectedEventTitlesTagsUsersAndOutputRegExsDataProvider(): ArrayIterator
	{
		return new InitiatedSentryClientConfigurationsWithMessagesSeveritiesContextsTagsUsersExpectedEventTitlesTagsUsersAndOutputRegExsDataProvider();
	}

	/**
	 * Tests if messages will be captured and outputted correctly.
	 * @param SentryClientConfigurationInterface $sentryClientConfiguration The initiated `SentryClientConfigurationTest`.
	 * @param string $message The message to capture.
	 * @param string $severity The severity of the message.
	 * @param array $context The context of the message.
	 * @param array $tags The tags of the message.
	 * @param array $user The user of the message.
	 * @param string $expectedEventTitle The expected event title.
	 * @param array $expectedContext The expected event context.
	 * @param array $expectedTags The expected event tags.
	 * @param array $expectedUser The expected event user.
	 * @param string $expectedOutputRegEx The expected output regular expression.
	 * @dataProvider initiatedSentryClientConfigurationsWithMessagesSeveritiesContextsTagsUsersExpectedEventTitlesTagsUsersAndOutputRegExsDataProvider
	 */
	public function testCaptureMessageCapturesAndOutputsCorrectly( SentryClientConfigurationInterface $sentryClientConfiguration, string $message, string $severity, array $context, array $tags, array $user, string $expectedEventTitle, array $expectedContext, array $expectedTags, array $expectedUser, string $expectedOutputRegEx ): void
	{
		$eventId = ( new SentryClient( $sentryClientConfiguration ) )
			->captureMessage( $message, $severity, $context, $tags, $user );

		sleep( TestConstants::EVENT_PROCESSING_THRESHOLD );

		$apiEventRequests = new ApiRequests(
			TestConstants::API_URI,
			TestConstants::AUTH_TOKEN,
			TestConstants::COMPANY_NAME,
			TestConstants::PROJECT_NAME
		);
		$event            = $apiEventRequests->getEvent( $eventId );

		$resultedTitle   = $event[ 'title' ];
		$resultedContext = $event[ 'context' ];
		$resultedTags    = [];
		foreach ( $event[ 'tags' ] as $tag )
		{
			$resultedTags[ $tag[ 'key' ] ] = $tag[ 'value' ];
		}
		$resultedSeverity = $resultedTags[ 'level' ];
		$resultedUser     = $event[ 'user' ];

		static::assertSame( $expectedEventTitle, $resultedTitle );
		static::assertSame( $severity, $resultedSeverity );

		if ( [] !== $expectedContext )
		{
			static::assertArraySubset( $context, $resultedContext );
		}
		if ( [] !== $expectedTags )
		{
			static::assertArraySubset( $expectedTags, $resultedTags );
		}
		if ( [] !== $expectedUser )
		{
			static::assertArraySubset( $expectedUser, $resultedUser );
		}

		$this->expectOutputRegex( '~' . $expectedOutputRegEx . '~' );
	}

	/**
	 * Provides initiated sentry client configurations with messages, severities, contexts, tags, users, expected event titles, tags, users and output regular expressions.
	 * @return ArrayIterator The initiated sentry client configurations with messages, severities, contexts, tags, users, expected event titles, tags, users and output regular expressions.
	 */
	public function initiatedSentryClientConfigurationsWithErrorsSeveritiesContextsTagsUsersExpectedEventTitlesTagsUsersAndOutputRegExsDataProvider(): ArrayIterator
	{
		return new InitiatedSentryClientConfigurationsWithErrorsSeveritiesContextsTagsUsersExpectedEventTitlesTagsUsersAndOutputRegExsDataProvider();
	}

	/**
	 * Tests if errors will be captured and outputted correctly.
	 * @param SentryClientConfigurationInterface $sentryClientConfiguration The initiated `SentryClientConfigurationTest`.
	 * @param string $errorMessage The message of the error to capture.
	 * @param int $errorLevel The error level of the error.
	 * @param string $severity The severity of the error.
	 * @param array $context The context of the error.
	 * @param array $tags The tags of the error.
	 * @param array $user The user of the error.
	 * @param string $expectedEventTitle The expected event title.
	 * @param array $expectedContext The expected event context.
	 * @param array $expectedTags The expected event tags.
	 * @param array $expectedUser The expected event user.
	 * @param string $expectedOutputRegEx The expected output regular expression.
	 * @dataProvider initiatedSentryClientConfigurationsWithErrorsSeveritiesContextsTagsUsersExpectedEventTitlesTagsUsersAndOutputRegExsDataProvider
	 */
	public function testCaptureLastErrorCapturesAndOutputsCorrectly( SentryClientConfigurationInterface $sentryClientConfiguration, string $errorMessage, int $errorLevel, string $severity, array $context, array $tags, array $user, string $expectedEventTitle, array $expectedContext, array $expectedTags, array $expectedUser, string $expectedOutputRegEx ): void
	{
		$previousErrorReporting = error_reporting( E_NOTICE );
		trigger_error( $errorMessage, $errorLevel );
		error_reporting( $previousErrorReporting );

		$eventId = ( new SentryClient( $sentryClientConfiguration ) )
			->captureLastError( Severities::WARNING, $context, $tags, $user );

		sleep( TestConstants::EVENT_PROCESSING_THRESHOLD );

		$event = ( new ApiRequests(
			TestConstants::API_URI,
			TestConstants::AUTH_TOKEN,
			TestConstants::COMPANY_NAME,
			TestConstants::PROJECT_NAME
		) )
			->getEvent( $eventId );

		$resultedTitle   = $event[ 'title' ];
		$resultedContext = $event[ 'context' ];
		$resultedTags    = [];
		foreach ( $event[ 'tags' ] as $tag )
		{
			$resultedTags[ $tag[ 'key' ] ] = $tag[ 'value' ];
		}
		$resultedSeverity = $resultedTags[ 'level' ];
		$resultedUser     = $event[ 'user' ];

		static::assertSame( $expectedEventTitle, $resultedTitle );
		static::assertSame( $severity, $resultedSeverity );

		if ( [] !== $expectedContext )
		{
			static::assertArraySubset( $expectedContext, $resultedContext );
		}
		if ( [] !== $expectedTags )
		{
			static::assertArraySubset( $expectedTags, $resultedTags );
		}
		if ( [] !== $expectedUser )
		{
			static::assertArraySubset( $expectedUser, $resultedUser );
		}

		$this->expectOutputRegex( '~' . $expectedOutputRegEx . '~' );
	}

	/**
	 * Provides initiated `SentryClients` with throwables, severities, contexts, tags, users, expected titles, tags, users and output regular expressions.
	 * @return ArrayIterator The initiated `SentryClients` with throwables, severities, contexts, tags, users, expected titles, tags, users and output regular expressions.
	 */
	public function initiatedSentryClientConfigurationsWithThrowablesSeveritiesContextsTagsUsersExpectedEventTitlesTagsUsersAndOutputRegExsDataProvider(): ArrayIterator
	{
		return new InitiatedSentryClientConfigurationsWithThrowablesSeveritiesContextsTagsUsersExpectedEventTitlesTagsUsersAndOutputRegExsDataProvider();
	}

	/**
	 * Tests if errors will be captured and outputted correctly.
	 * @param SentryClientConfigurationInterface $sentryClientConfiguration The initiated `SentryClientConfigurationTest`.
	 * @param Throwable $throwable The exception to capture.
	 * @param string $severity The severity of the exception.
	 * @param array $context The context of the exception.
	 * @param array $tags The tags of the exception.
	 * @param array $user The user of the exception.
	 * @param string $expectedEventTitle The expected event title.
	 * @param array $expectedContext The expected event context.
	 * @param array $expectedTags The expected event tags.
	 * @param array $expectedUser The expected event user.
	 * @param string $expectedOutputRegEx The expected output regular expression.
	 * @dataProvider initiatedSentryClientConfigurationsWithThrowablesSeveritiesContextsTagsUsersExpectedEventTitlesTagsUsersAndOutputRegExsDataProvider
	 */
	public function testCaptureThrowableCapturesAndOutputsCorrectly( SentryClientConfigurationInterface $sentryClientConfiguration, Throwable $throwable, string $severity, array $context, array $tags, array $user, string $expectedEventTitle, array $expectedContext, array $expectedTags, array $expectedUser, string $expectedOutputRegEx ): void
	{
		$eventId = ( new SentryClient( $sentryClientConfiguration ) )
			->captureThrowable( $throwable, $severity, $context, $tags, $user );

		sleep( TestConstants::EVENT_PROCESSING_THRESHOLD );

		$event = ( new ApiRequests(
			TestConstants::API_URI,
			TestConstants::AUTH_TOKEN,
			TestConstants::COMPANY_NAME,
			TestConstants::PROJECT_NAME
		) )
			->getEvent( $eventId );

		$resultedTitle   = $event[ 'title' ];
		$resultedContext = $event[ 'context' ];
		$resultedTags    = [];
		foreach ( $event[ 'tags' ] as $tag )
		{
			$resultedTags[ $tag[ 'key' ] ] = $tag[ 'value' ];
		}
		$resultedSeverity = $resultedTags[ 'level' ];
		$resultedUser     = $event[ 'user' ];

		static::assertSame( $expectedEventTitle, $resultedTitle );
		static::assertSame( $severity, $resultedSeverity );

		if ( [] !== $expectedContext )
		{
			static::assertArraySubset( $expectedContext, $resultedContext );
		}
		if ( [] !== $expectedTags )
		{
			static::assertArraySubset( $expectedTags, $resultedTags );
		}
		if ( [] !== $expectedUser )
		{
			static::assertArraySubset( $expectedUser, $resultedUser );
		}

		$this->expectOutputRegex( '~' . $expectedOutputRegEx . '~' );
	}
}
