<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\UnitTests\Outputs;

use ArrayIterator;
use CodeKandis\PhpUnit\TestCase;
use CodeKandis\SentryClient\Outputs\UserOutputInterface;
use CodeKandis\SentryClient\Tests\DataProviders\Outputs\UserOutputInterfaceTest\InitiatedUserOutputsWithUserAndExpectedOutputRegExsDataProvider;

/**
 * Represents the test case of the `UserOutputInterface`.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class UserOutputInterfaceTest extends TestCase
{
	/**
	 * Provides initiated user outputs with user and expected output regular expressions.
	 * @return ArrayIterator The initiated user outputs with user and expected output regular expressions.
	 */
	public function initiatedUserOutputsWithUserAndExpectedOutputRegExsDataProvider(): ArrayIterator
	{
		return new InitiatedUserOutputsWithUserAndExpectedOutputRegExsDataProvider();
	}

	/**
	 * Test if the method print prints correctly.
	 * @param UserOutputInterface $userOutput The initiated user output.
	 * @param array $user The user to print.
	 * @param string $expectedOutputRegEx The expected output regular expression.
	 * @dataProvider initiatedUserOutputsWithUserAndExpectedOutputRegExsDataProvider
	 */
	public function testPrint( UserOutputInterface $userOutput, array $user, string $expectedOutputRegEx ): void
	{
		$userOutput->print( $user );

		$this->expectOutputRegex( '~' . $expectedOutputRegEx . '~' );
	}
}
