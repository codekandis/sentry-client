<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\DataProviders\Outputs\TagsOutputInterfaceTest;

use ArrayIterator;
use CodeKandis\SentryClient\Outputs\TagsOutput;

/**
 * Represents a data provider providing initiated tags outputs with tags and expected output regular expressions.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class InitiatedTagsOutputsWithTagsAndExpectedOutputRegExsDataProvider extends ArrayIterator
{
	/**
	 * Constructor method.
	 */
	public function __construct()
	{
		parent::__construct(
			[
				0 => [
					'tagsOutput'          => new TagsOutput(),
					'tags'                => [
						'tag_key_1' => 'tag_value_1',
						'tag_key_2' => 'tag_value_2'
					],
					'expectedOutputRegEx' => <<<END
^\[tags\]
Array
\(
    \[tag_key_1\] => tag_value_1
    \[tag_key_2\] => tag_value_2
\)
$
END
				]
			]
		);
	}
}
