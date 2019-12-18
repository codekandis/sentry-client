<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\DataProviders\Handlers\ErrorHandlerInterfaceTest;

use ArrayIterator;
use CodeKandis\SentryClient\Handlers\ErrorHandler;

/**
 * Represents a data provider providing initiated error handlers with expected callbacks.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class InitiatedErrorHandlersWithExpectedCallbacksDataProvider extends ArrayIterator
{
	/**
	 * Constructor method.
	 */
	public function __construct()
	{
		$errorHandlerCallback = static function ( int $level, string $message, string $file, int $line ): void
		{
		};

		parent::__construct(
			[
				0 => [
					'errorHandler'                 => new ErrorHandler( $errorHandlerCallback ),
					'expectedErrorHandlerCallback' => $errorHandlerCallback
				]
			]
		);
	}
}
