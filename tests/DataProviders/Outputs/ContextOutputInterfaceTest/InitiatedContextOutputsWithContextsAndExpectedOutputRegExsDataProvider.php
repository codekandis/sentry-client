<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\DataProviders\Outputs\ContextOutputInterfaceTest;

use ArrayIterator;
use CodeKandis\SentryClient\Outputs\ContextOutput;
use CodeKandis\SentryClient\Outputs\ContextOutputInterface;

/**
 * Represents a data provider providing initiated context outputs with contexts and expected output regular expressions.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class InitiatedContextOutputsWithContextsAndExpectedOutputRegExsDataProvider extends ArrayIterator
{
	/**
	 * Constructor method.
	 */
	public function __construct()
	{
		parent::__construct(
			[
				0 => [
					'contextOutput'       => new class() implements ContextOutputInterface {
						public function print( array $context ): void
						{
							echo 'context output';
						}
					},
					'context'             => [],
					'expectedOutputRegEx' => <<<END
^context output$
END
				],
				1 => [
					'contextOutput'       => new ContextOutput(),
					'context'             => [
						'context_key_1' => 'context_value_1',
						'context_key_2' => 'context_value_2',
						'context_key_3' => [
							'context_key_3_1' => 'context_value_3_1',
							'context_key_3_2' => 'context_value_3_2',
							'context_key_3_3' => 'context_value_3_3'
						]
					],
					'expectedOutputRegEx' => <<<END
^\[context\]
Array
\(
    \[context_key_1\] => context_value_1
    \[context_key_2\] => context_value_2
    \[context_key_3\] => Array
        \(
            \[context_key_3_1\] => context_value_3_1
            \[context_key_3_2\] => context_value_3_2
            \[context_key_3_3\] => context_value_3_3
        \)

\)
$
END
				]
			]
		);
	}
}
