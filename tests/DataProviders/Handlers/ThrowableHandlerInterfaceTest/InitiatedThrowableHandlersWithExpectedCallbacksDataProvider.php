<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\DataProviders\Handlers\ThrowableHandlerInterfaceTest;

use ArrayIterator;
use CodeKandis\SentryClient\Handlers\ThrowableHandler;
use Throwable;

/**
 * Represents a data provider providing initiated throwable handlers with expected callbacks.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class InitiatedThrowableHandlersWithExpectedCallbacksDataProvider extends ArrayIterator
{
	/**
	 * Constructor method.
	 */
	public function __construct()
	{
		$throwableHandlerCallback = static function ( Throwable $throwable ): void
		{
		};

		parent::__construct(
			[
				0 => [
					'throwableHandler'                 => new ThrowableHandler( $throwableHandlerCallback ),
					'expectedThrowableHandlerCallback' => $throwableHandlerCallback
				]
			]
		);
	}
}
