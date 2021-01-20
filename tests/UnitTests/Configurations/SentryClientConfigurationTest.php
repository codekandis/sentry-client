<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\UnitTests\Configurations;

use ArrayIterator;
use CodeKandis\PhpUnit\TestCase;
use CodeKandis\SentryClient\Configurations\SentryClientConfigurationInterface;
use CodeKandis\SentryClient\Tests\DataProviders\Configurations\SentryClientConfigurationTest\InitiatedSentryClientConfigurationsWithPropertiesValuesDataProvider;
use function ucfirst;

/**
 * Represents the test case of the `SentryClientConfiguration`.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class SentryClientConfigurationTest extends TestCase
{
	/**
	 * Represents a data provider providing initiated sentry client configurations with properties values.
	 * @return ArrayIterator The initiated sentry client configurations with properties values.
	 */
	public function InitiatedSentryClientConfigurationsWithPropertiesValuesDataProvider(): ArrayIterator
	{
		return new InitiatedSentryClientConfigurationsWithPropertiesValuesDataProvider();
	}

	/**
	 * Tests if the sentry client configuration will set and return the correct properties values.
	 * @param SentryClientConfigurationInterface $sentryClientConfiguration The initiated sentry client configuration.
	 * @param array $propertiesValues The properties values of the sentry client configuration.
	 * @dataProvider InitiatedSentryClientConfigurationsWithPropertiesValuesDataProvider
	 */
	public function testSentryClientConfigurationSetsAndReturnsCorrectPropertyValues( SentryClientConfigurationInterface $sentryClientConfiguration, array $propertiesValues )
	{
		foreach ( $propertiesValues as $propertyName => $propertyValue )
		{
			$setterName                = 'set' . ucfirst( $propertyName );
			$resultedSetterReturnValue = $sentryClientConfiguration->$setterName( $propertyValue );
			$getterName                = 'get' . ucfirst( $propertyName );
			$resultedGetterReturnValue = $sentryClientConfiguration->$getterName();

			static::assertSame( $sentryClientConfiguration, $resultedSetterReturnValue );
			static::assertSame( $propertyValue, $resultedGetterReturnValue );
		}
	}
}
