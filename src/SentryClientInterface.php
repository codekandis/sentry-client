<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient;

use CodeKandis\SentryClient\Handlers\ErrorHandlerInterface;
use CodeKandis\SentryClient\Handlers\ThrowableHandlerInterface;
use Throwable;

/**
 * Represents the interface of all `SentryClient` implementations.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
interface SentryClientInterface
{
	/**
	 * Registers the `SentryClient` error and throwable handlers.
	 */
	public function register(): void;

	/**
	 * Gets the error handler of the `SentryClient`.
	 * @return ?ErrorHandlerInterface The error handler of the `SentryClient`.
	 */
	public function getErrorHandler(): ?ErrorHandlerInterface;

	/**
	 * Gets the throwable handler of the `SentryClient`.
	 * @return ?ThrowableHandlerInterface The throwable handler of the `SentryClient`.
	 */
	public function getThrowableHandler(): ?ThrowableHandlerInterface;

	/**
	 * Captures a message and sends it to Sentry.
	 * @param string $message The message to send to Sentry.
	 * @param string $severity The severity of the message.
	 * @param array $context The context of the message.
	 * @param array $tags The additional tags of the message.
	 * @param array $user The user causing the message.
	 * @return ?string The resulting Sentry event ID of the message.
	 */
	public function captureMessage( string $message, string $severity = Severities::INFO, array $context = [], array $tags = [], array $user = [] ): ?string;

	/**
	 * Captures the last error and sends it to Sentry.
	 * @param string $severity The severity of the error.
	 * @param array $context The context of the error.
	 * @param array $tags The additional tags of the error.
	 * @param array $user The user causing the error.
	 * @return ?string The resulting Sentry event ID of the error.
	 */
	public function captureLastError( string $severity = Severities::ERROR, array $context = [], array $tags = [], array $user = [] ): ?string;

	/**
	 * Captures an throwable and sends it to Sentry.
	 * @param Throwable $throwable The throwable to send to Sentry.
	 * @param string $severity The severity of the throwable.
	 * @param array $context The context of the throwable.
	 * @param array $tags The additional tags of the throwable.
	 * @param array $user The user causing the throwable.
	 * @return ?string The resulting Sentry event ID of the throwable.
	 */
	public function captureThrowable( Throwable $throwable, string $severity = Severities::ERROR, array $context = [], array $tags = [], array $user = [] ): ?string;

	/**
	 * Gets the ID of the last captured event of Sentry.
	 * @return ?string The ID of the last captured event of Sentry.
	 */
	public function getLastEventId(): ?string;
}
