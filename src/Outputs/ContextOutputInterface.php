<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Outputs;

/**
 * Represents an interface of all context outputs.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
interface ContextOutputInterface
{
	/**
	 * Prints a context.
	 * @param array $context The context to print.
	 */
	public function print( array $context ): void;
}
