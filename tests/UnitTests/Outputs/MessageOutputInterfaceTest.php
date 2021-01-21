<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\UnitTests\Outputs;

use ArrayIterator;
use CodeKandis\PhpUnit\TestCase;
use CodeKandis\SentryClient\Outputs\MessageOutputInterface;
use CodeKandis\SentryClient\Tests\DataProviders\Outputs\MessageOutputInterfaceTest\InitiatedMessageOutputsWithSeveritiesMessagesAndExpectedOutputRegExsDataProvider;

/**
 * Represents the test case of the `MessageOutputInterface`.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class MessageOutputInterfaceTest extends TestCase
{
	/**
	 * Provides initiated message outputs with severities, messages and expected output regular expressions.
	 * @return ArrayIterator The initiated message outputs with severities, messages and expected output regular expressions.
	 */
	public function initiatedMessageOutputsWithSeveritiesMessagesAndExpectedOutputRegExsDataProvider(): ArrayIterator
	{
		return new InitiatedMessageOutputsWithSeveritiesMessagesAndExpectedOutputRegExsDataProvider();
	}

	/**
	 * Test if the method print prints correctly.
	 * @param MessageOutputInterface $messageOutput The initiated message output.
	 * @param string $severity The severity of the message to print.
	 * @param string $message The message to print.
	 * @param string $expectedOutputRegEx The expected output regular expression.
	 * @dataProvider initiatedMessageOutputsWithSeveritiesMessagesAndExpectedOutputRegExsDataProvider
	 */
	public function testPrint( MessageOutputInterface $messageOutput, string $severity, string $message, string $expectedOutputRegEx ): void
	{
		$messageOutput->print( $severity, $message );

		$this->expectOutputRegex( '~' . $expectedOutputRegEx . '~' );
	}
}
