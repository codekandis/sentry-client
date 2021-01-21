<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\DataProviders\SentryClientInterfaceTest;

use ArrayIterator;
use CodeKandis\SentryClient\Configurations\SentryClientConfiguration;
use CodeKandis\SentryClient\ErrorLevelValues;

/**
 * Represents a data provider providing initiated sentry client configurations with expected error types and display errors.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class InitiatedSentryClientConfigurationsWithExpectedErrorTypesAndDisplayErrorsDataProvider extends ArrayIterator
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
						->setErrorTypes( ErrorLevelValues::E_ERROR )
						->setDisplayErrors( false ),
					'expectedErrorTypes'        => ErrorLevelValues::E_ERROR,
					'expectedDisplayErrors'     => 'Off'
				],
				1 => [
					'sentryClientConfiguration' => ( new SentryClientConfiguration() )
						->setErrorTypes( ErrorLevelValues::E_ALL )
						->setDisplayErrors( true ),
					'expectedErrorTypes'        => ErrorLevelValues::E_ALL,
					'expectedDisplayErrors'     => 'On'
				]
			]
		);
	}
}
