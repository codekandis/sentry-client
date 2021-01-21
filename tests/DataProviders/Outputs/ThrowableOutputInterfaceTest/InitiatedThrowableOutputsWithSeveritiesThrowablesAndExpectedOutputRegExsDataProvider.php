<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\DataProviders\Outputs\ThrowableOutputInterfaceTest;

use ArrayIterator;
use CodeKandis\SentryClient\Outputs\ThrowableOutput;
use CodeKandis\SentryClient\Severities;
use Exception;
use LogicException;

/**
 * Represents a data provider providing initiated throwable outputs with severites, throwables and expected output regular expressions.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class InitiatedThrowableOutputsWithSeveritiesThrowablesAndExpectedOutputRegExsDataProvider extends ArrayIterator
{
	/**
	 * Constructor method.
	 */
	public function __construct()
	{
		parent::__construct(
			[
				0 => [
					'throwableOutput'     => new ThrowableOutput(),
					'severity'            => Severities::INFO,
					'throwable'           => new Exception( 'a throwable message', 0 ),
					'expectedOutputRegEx' => <<<END
^execution interrupted
\[type\]     throwable
\[class\]    Exception
\[severity\] info
\[code\]     0
\[message\]  a throwable message
\[line\]     27
\[file\]     /vagrant/tests/DataProviders/Outputs/ThrowableOutputInterfaceTest/InitiatedThrowableOutputsWithSeveritiesThrowablesAndExpectedOutputRegExsDataProvider.php
\[stacktrace\]
(#\d+ .+\n)+$
END
				],
				1 => [
					'throwableOutput'     => new ThrowableOutput(),
					'severity'            => Severities::WARNING,
					'throwable'           => new LogicException( 'another throwable message', 42 ),
					'expectedOutputRegEx' => <<<END
^execution interrupted
\[type\]     throwable
\[class\]    LogicException
\[severity\] warning
\[code\]     42
\[message\]  another throwable message
\[line\]     44
\[file\]     /vagrant/tests/DataProviders/Outputs/ThrowableOutputInterfaceTest/InitiatedThrowableOutputsWithSeveritiesThrowablesAndExpectedOutputRegExsDataProvider.php
\[stacktrace\]
(#\d+ .+\n)+$
END
				]
			]
		);
	}
}
