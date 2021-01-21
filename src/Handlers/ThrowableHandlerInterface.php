<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Handlers;

use Closure;
use Throwable;

/**
 * Represents the interface of all throwable handlers.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
interface ThrowableHandlerInterface
{
	/**
	 * Invokes the throwable handler.
	 * @param Throwable $throwable The throwable.
	 */
	public function __invoke( Throwable $throwable ): void;

	/**
	 * Gets the callback of the throwable handler.
	 * @return Closure The callback of the throwable handler.
	 */
	public function getThrowableHandlerCallback(): Closure;

	/**
	 * Registers the throwable handler.
	 */
	public function register(): void;
}
