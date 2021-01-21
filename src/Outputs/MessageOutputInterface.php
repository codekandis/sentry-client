<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Outputs;

/**
 * Represents an interface of all message outputs.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
interface MessageOutputInterface
{
	/**
	 * Prints a message.
	 * @param string $severity The severity of the message to print.
	 * @param string $message The message to print.
	 */
	public function print( string $severity, string $message ): void;
}
