<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Outputs;

use Throwable;
use function get_class;
use function printf;

/**
 * Represents an throwable output.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class ThrowableOutput implements ThrowableOutputInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function print( string $severity, Throwable $throwable ): void
	{
		$paddingLength = 11;
		printf(
			"execution interrupted\n%-{$paddingLength}s%s\n%-{$paddingLength}s%s\n%-{$paddingLength}s%s\n%-{$paddingLength}s%s\n%-{$paddingLength}s%s\n%-{$paddingLength}s%s\n%-{$paddingLength}s%s\n%s\n%s\n",
			'[type]',
			'throwable',
			'[class]',
			get_class( $throwable ),
			'[severity]',
			$severity,
			'[code]',
			$throwable->getCode(),
			'[message]',
			$throwable->getMessage(),
			'[line]',
			$throwable->getLine(),
			'[file]',
			$throwable->getFile(),
			'[stacktrace]',
			$throwable->getTraceAsString()
		);
	}
}
