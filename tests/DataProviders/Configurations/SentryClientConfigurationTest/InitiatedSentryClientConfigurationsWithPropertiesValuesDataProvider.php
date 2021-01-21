<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\DataProviders\Configurations\SentryClientConfigurationTest;

use ArrayIterator;
use CodeKandis\SentryClient\Configurations\SentryClientConfiguration;

/**
 * Represents a data provider providing initiated sentry client configurations with properties values.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class InitiatedSentryClientConfigurationsWithPropertiesValuesDataProvider extends ArrayIterator
{
	/**
	 * Constructor method.
	 */
	public function __construct()
	{
		parent::__construct(
			[
				0 => [
					'sentryClientConfiguration' => new SentryClientConfiguration(),
					'propertiesValues'          => [
						'dsn'                   => 'dsn',
						'errorTypes'            => 0,
						'displayErrors'         => true,
						'release'               => 'release',
						'environment'           => 'environment',
						'sampleRate'            => 0.1,
						'maxBreadcrumbs'        => 1,
						'attachStacktrace'      => true,
						'sendDefaultPii'        => true,
						'serverName'            => 'serverName',
						'inAppExclude'          => [
							'a',
							'b'
						],
						'requestBodies'         => 'requestBodies',
						'integrations'          => 'integrations',
						'defaultIntegrations'   => true,
						'beforeSend'            => fn() => 1,
						'beforeBreadcrumb'      => fn() => 2,
						'httpProxy'             => 'httpProxy',
						'captureSilencedErrors' => true,
						'contextLines'          => 2,
						'enableCompression'     => true,
						'excludedAppPaths'      => [
							'c',
							'd'
						],
						'excludedExceptions'    => [
							'e',
							'f'
						],
						'prefixes'              => [
							'g',
							'h'
						],
						'projectRoot'           => 'projectRoot',
						'sendAttempts'          => 3
					]
				],
				1 => [
					'sentryClientConfiguration' => new SentryClientConfiguration(),
					'propertiesValues'          => [
						'dsn'                   => 'dsn',
						'errorTypes'            => null,
						'displayErrors'         => true,
						'release'               => null,
						'environment'           => null,
						'sampleRate'            => null,
						'maxBreadcrumbs'        => null,
						'attachStacktrace'      => null,
						'sendDefaultPii'        => null,
						'serverName'            => null,
						'inAppExclude'          => null,
						'requestBodies'         => null,
						'integrations'          => null,
						'defaultIntegrations'   => null,
						'beforeSend'            => null,
						'beforeBreadcrumb'      => null,
						'httpProxy'             => null,
						'captureSilencedErrors' => null,
						'contextLines'          => null,
						'enableCompression'     => null,
						'excludedAppPaths'      => null,
						'excludedExceptions'    => null,
						'prefixes'              => null,
						'projectRoot'           => null,
						'sendAttempts'          => null
					]
				]
			]
		);
	}
}
