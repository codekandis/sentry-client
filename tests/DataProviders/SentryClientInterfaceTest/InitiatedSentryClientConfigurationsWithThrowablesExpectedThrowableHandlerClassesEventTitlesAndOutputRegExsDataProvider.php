<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\DataProviders\SentryClientInterfaceTest;

use ArrayIterator;
use CodeKandis\SentryClient\Configurations\SentryClientConfiguration;
use CodeKandis\SentryClient\ErrorLevelValues;
use CodeKandis\SentryClient\Handlers\ThrowableHandler;
use CodeKandis\SentryClient\Tests\Helpers\Constants\TestConstants;
use LogicException;

/**
 * Represents a data provider providing initiated sentry client configurations with throwables, expected throwable handler classes, event titles and output regular expressions.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class InitiatedSentryClientConfigurationsWithThrowablesExpectedThrowableHandlerClassesEventTitlesAndOutputRegExsDataProvider extends ArrayIterator
{
	/**
	 * Constructor method.
	 */
	public function __construct()
	{
		parent::__construct(
			[
				0 => [
					'sentryClientConfiguration'     => ( new SentryClientConfiguration() )
						->setDsn( TestConstants::DSN )
						->setErrorTypes( ErrorLevelValues::E_ALL )
						->setDisplayErrors( false )
						->setRelease( 'none' )
						->setEnvironment( 'development' ),
					'throwable'                     => new LogicException( 'Automatically captured throwable without `displayErrors`.' ),
					'expectedThrowableHandlerClass' => ThrowableHandler::class,
					'expectedEventTitle'            => 'LogicException: Automatically captured throwable without `displayErrors`.',
					'expectedOutputRegEx'           => <<<END
^$
END
				],
				1 => [
					'sentryClientConfiguration'     => ( new SentryClientConfiguration() )
						->setDsn( TestConstants::DSN )
						->setErrorTypes( ErrorLevelValues::E_ALL )
						->setDisplayErrors( true )
						->setRelease( 'none' )
						->setEnvironment( 'development' ),
					'throwable'                     => new LogicException( 'Automatically captured throwable with `displayErrors`.' ),
					'expectedThrowableHandlerClass' => ThrowableHandler::class,
					'expectedEventTitle'            => 'LogicException: Automatically captured throwable with `displayErrors`.',
					'expectedOutputRegEx'           => <<<END
^execution interrupted
\[type\]     throwable
\[class\]    LogicException
\[severity\] error
\[code\]     0
\[message\]  Automatically captured throwable with `displayErrors`.
\[line\]     46
\[file\]     /vagrant/tests/DataProviders/SentryClientInterfaceTest/InitiatedSentryClientConfigurationsWithThrowablesExpectedThrowableHandlerClassesEventTitlesAndOutputRegExsDataProvider.php
\[stacktrace\]
(#\d+ .+\n)+$
END
				]
			]
		);
	}
}
