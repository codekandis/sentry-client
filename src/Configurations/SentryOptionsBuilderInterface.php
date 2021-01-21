<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Configurations;

/**
 * Represents the interface of all builders to create Sentry options.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
interface SentryOptionsBuilderInterface
{
	/**
	 * Creates an array of Sentry options from a `SentryClient` configuration.
	 * @param SentryClientConfigurationInterface $clientConfiguration The configuration of the `SentryClient`.
	 * @return array The array of Sentry options.
	 */
	public function buildFromClientConfiguration( SentryClientConfigurationInterface $clientConfiguration ): array;
}
