<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Outputs;

use function print_r;
use function printf;

/**
 * Represents a context output.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class ContextOutput implements ContextOutputInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function print( array $context ): void
	{
		if ( false === empty( $context ) )
		{
			printf(
				"[context]\n%s",
				print_r( $context, true )
			);
		}
	}
}
