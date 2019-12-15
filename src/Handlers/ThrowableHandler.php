<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Handlers;

use Closure;
use Throwable;
use function set_exception_handler;

/**
 * Represents an throwable handler.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class ThrowableHandler implements ThrowableHandlerInterface
{
	/**
	 * Stores the previous set throwable handler.
	 * @var ?callable
	 */
	private $previousThrowableHandlerCallback;

	/**
	 * Stores the callback of the throwable handler.
	 * @var Closure
	 */
	private Closure $throwableHandlerCallback;

	/**
	 * Constructor method.
	 * @param Closure $throwableHandlerCallback The throwable handler callback.
	 */
	public function __construct( Closure $throwableHandlerCallback )
	{
		$this->throwableHandlerCallback = $throwableHandlerCallback;
	}

	/**
	 * {@inheritdoc}
	 */
	public function __invoke( Throwable $throwable ): void
	{
		if ( null !== $this->previousThrowableHandlerCallback )
		{
			try
			{
				( $this->previousThrowableHandlerCallback )( $throwable );
			}
			catch ( Throwable $throwable )
			{
			}
		}
		( $this->throwableHandlerCallback )( $throwable );
	}

	/**
	 * {@inheritdoc}
	 */
	public function getThrowableHandlerCallback(): Closure
	{
		return $this->throwableHandlerCallback;
	}

	/**
	 * {@inheritdoc}
	 */
	public function register(): void
	{
		$this->previousThrowableHandlerCallback = set_exception_handler( $this );
	}
}
