<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\UnitTests;

use ArrayIterator;
use CodeKandis\PhpUnit\TestCase;
use CodeKandis\SentryClient\Configurations\SentryClientConfigurationInterface;
use CodeKandis\SentryClient\SentryClient;
use CodeKandis\SentryClient\Tests\DataProviders\SentryClientInterfaceTest\InitiatedSentryClientConfigurationsWithExpectedErrorTypesAndDisplayErrorsDataProvider;
use function error_reporting;
use function ini_get;

/**
 * Represents the test case of the `SentryClient`.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class SentryClientTest extends TestCase
{
	/**
	 * Provides initiated `SentryClient` configurations with expected error types and display errors data provider.
	 * @return ArrayIterator The initiated `SentryClient` configurations with expected error types and display errors data provider.
	 */
	public function initiatedSentryClientConfigurationsWithExpectedErrorTypesAndDisplayErrorsDataProvider(): ArrayIterator
	{
		return new InitiatedSentryClientConfigurationsWithExpectedErrorTypesAndDisplayErrorsDataProvider();
	}

	/**
	 * Tests if the constructor setup the runtime error handling correctly.
	 * @param SentryClientConfigurationInterface $sentryClientConfiguration The initiated `SentryClientConfiguration`.
	 * @param int $expectedErrorTypes The expected error types setting.
	 * @param string $expectedDisplayErrors The expected display errors setting.
	 * @dataProvider initiatedSentryClientConfigurationsWithExpectedErrorTypesAndDisplayErrorsDataProvider
	 */
	public function testConstructorSetupRuntimeErrorHandlingCorrectly( SentryClientConfigurationInterface $sentryClientConfiguration, int $expectedErrorTypes, string $expectedDisplayErrors ): void
	{
		new SentryClient( $sentryClientConfiguration );

		$resultedErrorTypes    = error_reporting();
		$resultedDisplayErrors = ini_get( 'display_errors' );

		static::assertSame( $expectedErrorTypes, $resultedErrorTypes, 'errorReporting' );
		static::assertSame( $expectedDisplayErrors, $resultedDisplayErrors, 'displayErrors' );
	}
}
