<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\DataProviders\Handlers\ThrowableHandlerInterfaceTest;

use ArrayIterator;
use CodeKandis\SentryClient\Handlers\ThrowableHandler;

/**
 * Represents a data provider providing initiated throwable handlers with callbacks producing outputs and expected output regular expressions.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class InitiatedThrowableHandlersWithCallbacksProducingOutputsAndExpectedOutputRegExsDataProvider extends ArrayIterator
{
	/**
	 * Constructor method.
	 */
	public function __construct()
	{
		parent::__construct(
			[
				0 => [
					'throwableHandler'               => new ThrowableHandler(
						static function (): void
						{
							echo 'a throwable message';
						}
					),
					'expectedThrowableHandlerOutput' => <<<END
.*a throwable message$
END
				]
			]
		);
	}
}
