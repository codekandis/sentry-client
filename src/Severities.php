<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient;

/**
 * Represents the severity levels of all Sentry events.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class Severities
{
	/**
	 * Represents the severity level `debug`.
	 * @var string
	 */
	public const DEBUG = 'debug';

	/**
	 * Represents the severity level `info`.
	 * @var string
	 */
	public const INFO = 'info';

	/**
	 * Represents the severity level `warning`.
	 * @var string
	 */
	public const WARNING = 'warning';

	/**
	 * Represents the severity level `error`.
	 * @var string
	 */
	public const ERROR = 'error';

	/**
	 * Represents the severity level `fatal`.
	 * @var string
	 */
	public const FATAL = 'fatal';
}
