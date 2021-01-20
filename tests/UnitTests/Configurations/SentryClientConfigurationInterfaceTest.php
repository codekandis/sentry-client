<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\UnitTests\Configurations;

use ArrayIterator;
use CodeKandis\PhpUnit\TestCase;
use CodeKandis\SentryClient\Configurations\SentryClientConfigurationInterface;
use CodeKandis\SentryClient\Tests\DataProviders\Configurations\SentryClientConfigurationInterfaceTest\InitiatedSentryClientConfigurationsWithExpectedPropertyValuesDataProvider;
use function ucfirst;

/**
 * Represents the test case of the `SentryClientConfigurationInterface`.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class SentryClientConfigurationInterfaceTest extends TestCase
{
	/**
	 * Represents a data provider providing initiated sentry client configurations with expected properties values.
	 * @return ArrayIterator The initiated sentry client configurations with expected properties values.
	 */
	public function SentryClientConfigurationsWithExpectedPropertyValuesDataProvider(): ArrayIterator
	{
		return new InitiatedSentryClientConfigurationsWithExpectedPropertyValuesDataProvider();
	}

	/**
	 * Tests if the sentry client configuration will return the correct properties values.
	 * @param SentryClientConfigurationInterface $sentryClientConfiguration The initiated sentry client configuration.
	 * @param array $expectedPropertiesValues The expected properties values of the sentry client configuration.
	 * @dataProvider SentryClientConfigurationsWithExpectedPropertyValuesDataProvider
	 */
	public function testSentryClientConfigurationReturnsCorrectPropertyValues( SentryClientConfigurationInterface $sentryClientConfiguration, array $expectedPropertiesValues )
	{
		foreach ( $expectedPropertiesValues as $propertyName => $expectedPropertyValue )
		{
			$getterName    = 'get' . ucfirst( $propertyName );
			$resultedValue = $sentryClientConfiguration->$getterName();

			static::assertSame( $expectedPropertyValue, $resultedValue );
		}
	}
}
