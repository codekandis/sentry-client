<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Outputs;

use function printf;

/**
 * Represents a message output.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class MessageOutput implements MessageOutputInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function print( string $severity, string $message ): void
	{
		$paddingLength = 11;
		printf(
			"message captured\n%-{$paddingLength}s%s\n%-{$paddingLength}s%s\n",
			'[severity]',
			$severity,
			'[message]',
			$message
		);
	}
}
