<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\UnitTests\Handlers;

use ArrayIterator;
use Closure;
use CodeKandis\PhpUnit\TestCase;
use CodeKandis\SentryClient\Handlers\ThrowableHandler;
use CodeKandis\SentryClient\Tests\DataProviders\Handlers\ThrowableHandlerInterfaceTest\InitiatedThrowableHandlersWithCallbacksProducingOutputsAndExpectedOutputRegExsDataProvider;
use CodeKandis\SentryClient\Tests\DataProviders\Handlers\ThrowableHandlerInterfaceTest\InitiatedThrowableHandlersWithExpectedCallbacksDataProvider;
use LogicException;
use Throwable;
use function set_exception_handler;

class ThrowableHandlerInterfaceTest extends TestCase
{
	/**
	 * Provides initiated throwable handlers with expected callbacks.
	 * @return ArrayIterator The initiated throwable handlers with expected callbacks.
	 */
	public function initiatedThrowableHandlersWithExpectedCallbacksDataProvider(): ArrayIterator
	{
		return new InitiatedThrowableHandlersWithExpectedCallbacksDataProvider();
	}

	/**
	 * Tests if the throwable handler callback is returned correctly.
	 * @param ThrowableHandler $throwableHandler The initiated throwable handler.
	 * @param Closure $expectedThrowableHandlerCallback The expected throwable handler callback.
	 * @dataProvider initiatedThrowableHandlersWithExpectedCallbacksDataProvider
	 */
	public function testGetThrowableHandlerCallback( ThrowableHandler $throwableHandler, Closure $expectedThrowableHandlerCallback ): void
	{
		$resultedExpectedThrowableHandlerCallback = $throwableHandler->getThrowableHandlerCallback();

		static::assertSame( $expectedThrowableHandlerCallback, $resultedExpectedThrowableHandlerCallback );
	}

	/**
	 * Provides initiated throwable handlers with callbacks producing outputs and expected output regular expressions.
	 * @return ArrayIterator The initiated throwable handlers with callbacks producing outputs and expected output regular expressions.
	 */
	public function initiatedThrowableHandlersWithCallbacksProducingOutputsAndExpectedOutputRegExsDataProvider(): ArrayIterator
	{
		return new InitiatedThrowableHandlersWithCallbacksProducingOutputsAndExpectedOutputRegExsDataProvider();
	}

	/**
	 * Test if the throwable handler will be registered correctly.
	 * @param ThrowableHandler $throwableHandler The inititated throwable handler.
	 * @param string $expectedThrowableHandlerOutputRegEx The expected output regular expression.
	 * @dataProvider initiatedThrowableHandlersWithCallbacksProducingOutputsAndExpectedOutputRegExsDataProvider
	 */
	public function testRegister( ThrowableHandler $throwableHandler, string $expectedThrowableHandlerOutputRegEx ): void
	{
		$previousThrowableHandlerOutput   = "output of the previous throwable handler\n";
		$previousThrowableHandlerCallback = static function () use ( $previousThrowableHandlerOutput ): void
		{
			echo $previousThrowableHandlerOutput;
		};
		set_exception_handler( $previousThrowableHandlerCallback );

		$throwableHandler->register();

		$registeredThrowableHandler = set_exception_handler(
			static function ( Throwable $throwable ): void
			{
			}
		);

		$registeredThrowableHandler( new LogicException() );

		static::assertSame( $throwableHandler, $registeredThrowableHandler );

		$this->expectOutputRegex( '~' . $previousThrowableHandlerOutput . $expectedThrowableHandlerOutputRegEx . '~' );
	}

	/**
	 * Tests if the throwable handler will be invoked correctly.
	 * @param ThrowableHandler $throwableHandler The initiated throwable handler.
	 * @param string $expectedThrowableHandlerOutputRegEx The expected output regular expression.
	 * @dataProvider initiatedThrowableHandlersWithCallbacksProducingOutputsAndExpectedOutputRegExsDataProvider
	 */
	public function testInvoke( ThrowableHandler $throwableHandler, string $expectedThrowableHandlerOutputRegEx ): void
	{
		set_exception_handler(
			static function ( Throwable $throwable ): void
			{
			}
		);

		$throwableHandler->register();

		$registeredThrowableHandler = set_exception_handler(
			static function ( Throwable $throwable ): void
			{
			}
		);

		$registeredThrowableHandler( new LogicException() );

		static::assertSame( $throwableHandler, $registeredThrowableHandler );

		$this->expectOutputRegex( '~' . $expectedThrowableHandlerOutputRegEx . '~' );
	}
}
