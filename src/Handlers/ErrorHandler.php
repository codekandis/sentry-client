<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Handlers;

use Closure;
use Throwable;
use function set_error_handler;

/**
 * Represents an error handler.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class ErrorHandler implements ErrorHandlerInterface
{
	/**
	 * Stores the previous set error handler.
	 * @var ?callable
	 */
	private $previousErrorHandlerCallback;

	/**
	 * Stores the callback of the error handler.
	 * @var Closure
	 */
	private Closure $errorHandlerCallback;

	/**
	 * Constructor method.
	 * @param Closure $errorHandlerCallback The error handler callback.
	 */
	public function __construct( Closure $errorHandlerCallback )
	{
		$this->errorHandlerCallback = $errorHandlerCallback;
	}

	/**
	 * {@inheritdoc}
	 */
	public function __invoke( int $level, string $message, string $file, int $line ): void
	{
		if ( null !== $this->previousErrorHandlerCallback )
		{
			try
			{
				( $this->previousErrorHandlerCallback )( $level, $message, $file, $line );
			}
			catch ( Throwable $error )
			{
			}
		}
		( $this->errorHandlerCallback )( $level, $message, $file, $line );
	}

	/**
	 * {@inheritdoc}
	 */
	public function getErrorHandlerCallback(): Closure
	{
		return $this->errorHandlerCallback;
	}

	/**
	 * {@inheritdoc}
	 */
	public function register(): void
	{
		$this->previousErrorHandlerCallback = set_error_handler( $this );
	}
}
