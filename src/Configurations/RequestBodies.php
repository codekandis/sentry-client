<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Configurations;

/**
 * Represents the values of the Sentry Client `requestBodies` configuration option.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class RequestBodies
{
	/**
	 * @see https://docs.sentry.io/error-reporting/configuration/?platform=php#request-bodies
	 * @var string
	 */
	public const NEVER = 'never';

	/**
	 * @see https://docs.sentry.io/error-reporting/configuration/?platform=php#request-bodies
	 * @var string
	 */
	public const SMALL = 'small';

	/**
	 * @see https://docs.sentry.io/error-reporting/configuration/?platform=php#request-bodies
	 * @var string
	 */
	public const MEDIUM = 'medium';

	/**
	 * @see https://docs.sentry.io/error-reporting/configuration/?platform=php#request-bodies
	 * @var string
	 */
	public const ALWAYS = 'always';
}
