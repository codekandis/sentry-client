<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\DataProviders\SentryClientInterfaceTest;

use ArrayIterator;
use CodeKandis\SentryClient\Configurations\SentryClientConfiguration;
use CodeKandis\SentryClient\ErrorLevelValues;
use CodeKandis\SentryClient\Handlers\ErrorHandler;
use CodeKandis\SentryClient\Tests\Helpers\Constants\TestConstants;

/**
 * Represents a data provider providing initiated sentry client configurations with errors, expected error handler classes, event titles and output regular expressions.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class InitiatedSentryClientConfigurationsWithErrorsExpectedErrorHandlerClassesEventTitlesAndOutputRegExsDataProvider extends ArrayIterator
{
	/**
	 * Constructor method.
	 */
	public function __construct()
	{
		parent::__construct(
			[
				0 => [
					'sentryClientConfiguration' => ( new SentryClientConfiguration() )
						->setDsn( TestConstants::DSN )
						->setErrorTypes( ErrorLevelValues::E_ALL )
						->setDisplayErrors( false )
						->setRelease( 'none' )
						->setEnvironment( 'development' ),
					'errorLevel'                => ErrorLevelValues::E_NOTICE,
					'errorMessage'              => 'Automatically captured error without `displayErrors`.',
					'errorFile'                 => '/path/to/the/error/file',
					'errorLine'                 => 42,
					'expectedErrorHandlerClass' => ErrorHandler::class,
					'expectedEventTitle'        => 'ErrorException: Notice: Automatically captured error without `displayErrors`.',
					'expectedOutputRegEx'       => <<<END
^$
END
				],
				1 => [
					'sentryClientConfiguration' => ( new SentryClientConfiguration() )
						->setDsn( TestConstants::DSN )
						->setErrorTypes( ErrorLevelValues::E_ALL )
						->setDisplayErrors( true )
						->setRelease( 'none' )
						->setEnvironment( 'development' ),
					'errorLevel'                => ErrorLevelValues::E_NOTICE,
					'errorMessage'              => 'Automatically captured error with `displayErrors`.',
					'errorFile'                 => '/path/to/the/error/file',
					'errorLine'                 => 42,
					'expectedErrorHandlerClass' => ErrorHandler::class,
					'expectedEventTitle'        => 'ErrorException: Notice: Automatically captured error with `displayErrors`.',
					'expectedOutputRegEx'       => <<<END
^execution interrupted
\[type\]     error
\[severity\] info
\[level\]    E_NOTICE
\[message\]  Automatically captured error with `displayErrors`.
\[line\]     42
\[file\]     /path/to/the/error/file
$
END
				]
			]
		);
	}
}
