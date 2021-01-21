<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\DataProviders\Outputs\ErrorOutputInterfaceTest;

use ArrayIterator;
use CodeKandis\SentryClient\ErrorLevelValues;
use CodeKandis\SentryClient\Outputs\ErrorOutput;
use CodeKandis\SentryClient\Severities;

/**
 * Represents a data provider providing initiated error outputs with severites, error data and expected output regular expressions.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class InitiatedErrorOutputsWithSeveritiesErrorDataAndExpectedOutputRegExsDataProvider extends ArrayIterator
{
	/**
	 * Constructor method.
	 */
	public function __construct()
	{
		parent::__construct(
			[
				0 => [
					'messageOutput'       => new ErrorOutput(),
					'severity'            => Severities::INFO,
					'level'               => ErrorLevelValues::E_NOTICE,
					'message'             => 'an error message',
					'file'                => '/path/to/a/file',
					'line'                => 42,
					'expectedOutputRegEx' => <<<END
^execution interrupted
\[type\]     error
\[severity\] info
\[level\]    E_NOTICE
\[message\]  an error message
\[line\]     42
\[file\]     /path/to/a/file
$
END
				],
				1 => [
					'messageOutput'       => new ErrorOutput(),
					'severity'            => Severities::WARNING,
					'level'               => ErrorLevelValues::E_ALL,
					'message'             => 'another error message',
					'file'                => '/path/to/another/file',
					'line'                => 23,
					'expectedOutputRegEx' => <<<END
^execution interrupted
\[type\]     error
\[severity\] warning
\[level\]    E_ALL
\[message\]  another error message
\[line\]     23
\[file\]     /path/to/another/file
$
END
				]
			]
		);
	}
}
