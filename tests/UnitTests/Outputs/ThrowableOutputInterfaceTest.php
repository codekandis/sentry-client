<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\UnitTests\Outputs;

use ArrayIterator;
use CodeKandis\PhpUnit\TestCase;
use CodeKandis\SentryClient\Outputs\ThrowableOutputInterface;
use CodeKandis\SentryClient\Tests\DataProviders\Outputs\ThrowableOutputInterfaceTest\InitiatedThrowableOutputsWithSeveritiesThrowablesAndExpectedOutputRegExsDataProvider;
use Throwable;

/**
 * Represents the test case of the `ThrowableOutputInterface`.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class ThrowableOutputInterfaceTest extends TestCase
{
	/**
	 * Provides initiated throwable outputs with severities, throwables and expected output regular expressions.
	 * @return ArrayIterator The initiated throwable outputs with severities, throwables and expected output regular expressions.
	 */
	public function initiatedThrowableOutputsWithSeveritiesThrowablesAndExpectedOutputRegExsDataProvider(): ArrayIterator
	{
		return new InitiatedThrowableOutputsWithSeveritiesThrowablesAndExpectedOutputRegExsDataProvider();
	}

	/**
	 * Test if the method print prints correctly.
	 * @param ThrowableOutputInterface $throwableOutput The initiated throwable output.
	 * @param string $severity The severity of the throwable to print.
	 * @param Throwable $throwable The throwable to print its data.
	 * @param string $expectedOutput The expected output.
	 * @dataProvider initiatedThrowableOutputsWithSeveritiesThrowablesAndExpectedOutputRegExsDataProvider
	 */
	public function testPrint( ThrowableOutputInterface $throwableOutput, string $severity, Throwable $throwable, string $expectedOutput ): void
	{
		$throwableOutput->print( $severity, $throwable );

		$this->expectOutputRegex( '~' . $expectedOutput . '~' );
	}
}
