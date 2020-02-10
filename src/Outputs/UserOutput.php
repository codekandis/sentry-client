<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Outputs;

use function print_r;
use function printf;

/**
 * Represents an user output.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class UserOutput implements UserOutputInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function print( array $user ): void
	{
		if ( false === empty( $user ) )
		{
			printf(
				"[user]\n%s",
				print_r( $user, true )
			);
		}
	}
}
