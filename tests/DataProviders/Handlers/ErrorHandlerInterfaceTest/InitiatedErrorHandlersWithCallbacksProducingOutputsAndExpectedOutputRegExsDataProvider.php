<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\DataProviders\Handlers\ErrorHandlerInterfaceTest;

use ArrayIterator;
use CodeKandis\SentryClient\Handlers\ErrorHandler;

/**
 * Represents a data provider providing initiated error handlers with callbacks producing outputs and expected output regular expressions.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class InitiatedErrorHandlersWithCallbacksProducingOutputsAndExpectedOutputRegExsDataProvider extends ArrayIterator
{
	/**
	 * Constructor method.
	 */
	public function __construct()
	{
		parent::__construct(
			[
				0 => [
					'errorHandler'                    => new ErrorHandler(
						static function (): void
						{
							echo 'an error message';
						}
					),
					'expectedErrorHandlerOutputRegEx' => <<<END
.*an error message$
END
				]
			]
		);
	}
}
