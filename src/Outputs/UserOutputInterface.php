<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Outputs;

/**
 * Represents an interface of all user outputs.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
interface UserOutputInterface
{
	/**
	 * Prints an user.
	 * @param array $user The user to print.
	 */
	public function print( array $user ): void;
}
