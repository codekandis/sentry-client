<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\UnitTests\Outputs;

use ArrayIterator;
use CodeKandis\PhpUnit\TestCase;
use CodeKandis\SentryClient\Outputs\ErrorOutputInterface;
use CodeKandis\SentryClient\Tests\DataProviders\Outputs\ErrorOutputInterfaceTest\InitiatedErrorOutputsWithSeveritiesErrorDataAndExpectedOutputRegExsDataProvider;

/**
 * Represents the test case of the `ErrorOutputInterface`.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class ErrorOutputInterfaceTest extends TestCase
{
	/**
	 * Provides initiated error outputs with severities, error data and expected output regular expressions.
	 * @return ArrayIterator The initiated error outputs with severities, error data and expected output regular expressions.
	 */
	public function initiatedErrorOutputsWithSeveritiesErrorDataAndExpectedOutputRegExsDataProvider(): ArrayIterator
	{
		return new InitiatedErrorOutputsWithSeveritiesErrorDataAndExpectedOutputRegExsDataProvider();
	}

	/**
	 * Test if the method print prints correctly.
	 * @param ErrorOutputInterface $errorOutput The initiated error output.
	 * @param string $severity The severity of the error to print.
	 * @param int $level The level of the error to print.
	 * @param string $message The message of the error to print.
	 * @param string $file The file of the error to print.
	 * @param int $line The line of the error to print.
	 * @param string $expectedOutputRegEx The expected output regular expression.
	 * @dataProvider initiatedErrorOutputsWithSeveritiesErrorDataAndExpectedOutputRegExsDataProvider
	 */
	public function testPrint( ErrorOutputInterface $errorOutput, string $severity, int $level, string $message, string $file, int $line, string $expectedOutputRegEx ): void
	{
		$errorOutput->print( $severity, $level, $message, $file, $line );

		$this->expectOutputRegex( '~' . $expectedOutputRegEx . '~' );
	}
}
