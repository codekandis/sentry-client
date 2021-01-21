<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\UnitTests\Outputs;

use ArrayIterator;
use CodeKandis\PhpUnit\TestCase;
use CodeKandis\SentryClient\Outputs\ContextOutputInterface;
use CodeKandis\SentryClient\Tests\DataProviders\Outputs\ContextOutputInterfaceTest\InitiatedContextOutputsWithContextsAndExpectedOutputRegExsDataProvider;

/**
 * Represents the test case of the `ContextOutputInterface`.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class ContextOutputInterfaceTest extends TestCase
{
	/**
	 * Provides initiated context outputs with contexts and expected output regular expressions.
	 * @return ArrayIterator The initiated context outputs with contexts and expected output regular expressions.
	 */
	public function initiatedContextOutputsWithContextsAndExpectedOutputRegExsDataProvider(): ArrayIterator
	{
		return new InitiatedContextOutputsWithContextsAndExpectedOutputRegExsDataProvider();
	}

	/**
	 * Test if the method print prints correctly.
	 * @param ContextOutputInterface $contextOutput The initiated context output.
	 * @param array $context The context to print.
	 * @param string $expectedOutputRegEx The expected output regular expression.
	 * @dataProvider initiatedContextOutputsWithContextsAndExpectedOutputRegExsDataProvider
	 */
	public function testPrint( ContextOutputInterface $contextOutput, array $context, string $expectedOutputRegEx ): void
	{
		$contextOutput->print( $context );

		$this->expectOutputRegex( '~' . $expectedOutputRegEx . '~' );
	}
}
