<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Outputs;

/**
 * Represents an interface of all error outputs.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
interface ErrorOutputInterface
{
	/**
	 * Prints an error.
	 * @param string $severity The severity of the error to print.
	 * @param int $level The level of the error to print.
	 * @param string $message The message of the error to print.
	 * @param string $file The file of the error to print.
	 * @param int $line The line of the error to print.
	 */
	public function print( string $severity, int $level, string $message, string $file, int $line ): void;
}
