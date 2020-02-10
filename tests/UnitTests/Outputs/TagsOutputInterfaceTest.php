<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\UnitTests\Outputs;

use ArrayIterator;
use CodeKandis\PhpUnit\TestCase;
use CodeKandis\SentryClient\Outputs\TagsOutputInterface;
use CodeKandis\SentryClient\Tests\DataProviders\Outputs\TagsOutputInterfaceTest\InitiatedTagsOutputsWithTagsAndExpectedOutputRegExsDataProvider;

/**
 * Represents the test case of the `TagsOutputInterface`.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class TagsOutputInterfaceTest extends TestCase
{
	/**
	 * Provides initiated tags outputs with tags and expected output regular expressions.
	 * @return ArrayIterator The initiated tags outputs with tags and expected output regular expressions.
	 */
	public function initiatedTagsOutputsWithTagsAndExpectedOutputRegExsDataProvider(): ArrayIterator
	{
		return new InitiatedTagsOutputsWithTagsAndExpectedOutputRegExsDataProvider();
	}

	/**
	 * Test if the method print prints correctly.
	 * @param TagsOutputInterface $tagsOutput The initiated tags output.
	 * @param array $tags The tags to print.
	 * @param string $expectedOutputRegEx The expected output regular expression.
	 * @dataProvider initiatedTagsOutputsWithTagsAndExpectedOutputRegExsDataProvider
	 */
	public function testPrint( TagsOutputInterface $tagsOutput, array $tags, string $expectedOutputRegEx ): void
	{
		$tagsOutput->print( $tags );

		$this->expectOutputRegex( '~' . $expectedOutputRegEx . '~' );
	}
}
