<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\DataProviders\Outputs\MessageOutputInterfaceTest;

use ArrayIterator;
use CodeKandis\SentryClient\ErrorLevelValues;
use CodeKandis\SentryClient\Outputs\MessageOutput;
use CodeKandis\SentryClient\Outputs\MessageOutputInterface;
use CodeKandis\SentryClient\Severities;

/**
 * Represents a data provider providing initiated message outputs with severites, messages and expected output regular expressions.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class InitiatedMessageOutputsWithSeveritiesMessagesAndExpectedOutputRegExsDataProvider extends ArrayIterator
{
	/**
	 * Constructor method.
	 */
	public function __construct()
	{
		parent::__construct(
			[
				0 => [
					'messageOutput'       => new class() implements MessageOutputInterface {
						public function print( string $severity, string $message ): void
						{
							echo 'message output';
						}
					},
					'severity'            => Severities::INFO,
					'message'             => 'a captured message',
					'expectedOutputRegEx' => <<<END
^message output$
END
				],
				1 => [
					'messageOutput'       => new MessageOutput(),
					'severity'            => Severities::INFO,
					'message'             => 'a captured message',
					'expectedOutputRegEx' => <<<END
^message captured
\[severity\] info
\[message\]  a captured message
$
END
				],
				2 => [
					'messageOutput'       => new MessageOutput(),
					'severity'            => Severities::WARNING,
					'message'             => 'another captured message',
					'expectedOutputRegEx' => <<<END
^message captured
\[severity\] warning
\[message\]  another captured message
$
END
				]
			]
		);
	}
}
