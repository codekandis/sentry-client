<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Outputs;

use function print_r;
use function printf;

/**
 * Represents a tags output.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class TagsOutput implements TagsOutputInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function print( array $tags ): void
	{
		if ( false === empty( $tags ) )
		{
			printf(
				"[tags]\n%s",
				print_r( $tags, true )
			);
		}
	}
}
