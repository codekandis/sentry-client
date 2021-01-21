<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Outputs;

use Throwable;

/**
 * Represents an interface of all throwable outputs.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
interface ThrowableOutputInterface
{
	/**
	 * Prints a throwable.
	 * @param string $severity The severity of the throwable to print.
	 * @param Throwable $throwable The throwable to print.
	 */
	public function print( string $severity, Throwable $throwable ): void;
}
