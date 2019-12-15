<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Handlers;

use Closure;

/**
 * Represents the interface of all error handlers.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
interface ErrorHandlerInterface
{
	/**
	 * Invokes the error handler.
	 * @param int $level The level of the error.
	 * @param string $message The message of the error.
	 * @param string $file The file of the error.
	 * @param int $line The line of the error.
	 */
	public function __invoke( int $level, string $message, string $file, int $line ): void;

	/**
	 * Gets the callback of the error handler.
	 * @return Closure The callback of the error handler.
	 */
	public function getErrorHandlerCallback(): Closure;

	/**
	 * Registers the error handler.
	 */
	public function register(): void;
}
