<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient;

/**
 * Represents the enumeration of all PHP error level values.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class ErrorLevelValues
{
	/**
	 * @see https://www.php.net/manual/de/errorfunc.constants.php#errorfunc.constants.errorlevels
	 */
	public const E_ALL = E_ALL;

	/**
	 * @see https://www.php.net/manual/de/errorfunc.constants.php#errorfunc.constants.errorlevels
	 */
	public const E_COMPILE_ERROR = E_COMPILE_ERROR;

	/**
	 * @see https://www.php.net/manual/de/errorfunc.constants.php#errorfunc.constants.errorlevels
	 */
	public const E_COMPILE_WARNING = E_COMPILE_WARNING;

	/**
	 * @see https://www.php.net/manual/de/errorfunc.constants.php#errorfunc.constants.errorlevels
	 */
	public const E_CORE_ERROR = E_CORE_ERROR;

	/**
	 * @see https://www.php.net/manual/de/errorfunc.constants.php#errorfunc.constants.errorlevels
	 */
	public const E_CORE_WARNING = E_CORE_WARNING;

	/**
	 * @see https://www.php.net/manual/de/errorfunc.constants.php#errorfunc.constants.errorlevels
	 */
	public const E_DEPRECATED = E_DEPRECATED;

	/**
	 * @see https://www.php.net/manual/de/errorfunc.constants.php#errorfunc.constants.errorlevels
	 */
	public const E_ERROR = E_ERROR;

	/**
	 * @see https://www.php.net/manual/de/errorfunc.constants.php#errorfunc.constants.errorlevels
	 */
	public const E_NOTICE = E_NOTICE;

	/**
	 * @see https://www.php.net/manual/de/errorfunc.constants.php#errorfunc.constants.errorlevels
	 */
	public const E_PARSE = E_PARSE;

	/**
	 * @see https://www.php.net/manual/de/errorfunc.constants.php#errorfunc.constants.errorlevels
	 */
	public const E_RECOVERABLE_ERROR = E_RECOVERABLE_ERROR;

	/**
	 * @see https://www.php.net/manual/de/errorfunc.constants.php#errorfunc.constants.errorlevels
	 */
	public const E_STRICT = E_STRICT;

	/**
	 * @see https://www.php.net/manual/de/errorfunc.constants.php#errorfunc.constants.errorlevels
	 */
	public const E_USER_DEPRECATED = E_USER_DEPRECATED;

	/**
	 * @see https://www.php.net/manual/de/errorfunc.constants.php#errorfunc.constants.errorlevels
	 */
	public const E_USER_ERROR = E_USER_ERROR;

	/**
	 * @see https://www.php.net/manual/de/errorfunc.constants.php#errorfunc.constants.errorlevels
	 */
	public const E_USER_NOTICE = E_USER_NOTICE;

	/**
	 * @see https://www.php.net/manual/de/errorfunc.constants.php#errorfunc.constants.errorlevels
	 */
	public const E_USER_WARNING = E_USER_WARNING;

	/**
	 * @see https://www.php.net/manual/de/errorfunc.constants.php#errorfunc.constants.errorlevels
	 */
	public const E_WARNING = E_WARNING;
}
