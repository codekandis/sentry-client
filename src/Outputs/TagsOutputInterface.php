<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Outputs;

/**
 * Represents an interface of all tags outputs.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
interface TagsOutputInterface
{
	/**
	 * Prints tags.
	 * @param array $tags The tags to print.
	 */
	public function print( array $tags ): void;
}
