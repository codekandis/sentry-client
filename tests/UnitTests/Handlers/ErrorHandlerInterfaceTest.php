<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\UnitTests\Handlers;

use ArrayIterator;
use Closure;
use CodeKandis\PhpUnit\TestCase;
use CodeKandis\SentryClient\Handlers\ErrorHandler;
use CodeKandis\SentryClient\Tests\DataProviders\Handlers\ErrorHandlerInterfaceTest\InitiatedErrorHandlersWithCallbacksProducingOutputsAndExpectedOutputRegExsDataProvider;
use CodeKandis\SentryClient\Tests\DataProviders\Handlers\ErrorHandlerInterfaceTest\InitiatedErrorHandlersWithExpectedCallbacksDataProvider;
use function set_error_handler;

/**
 * Represents the test case of the `ErrorHandlerInterface`.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class ErrorHandlerInterfaceTest extends TestCase
{
	/**
	 * Provides initiated exception handlers with expected callbacks.
	 * @return ArrayIterator The initiated exception handlers with expected callbacks.
	 */
	public function initiatedErrorHandlersWithExpectedCallbacksDataProvider(): ArrayIterator
	{
		return new InitiatedErrorHandlersWithExpectedCallbacksDataProvider();
	}

	/**
	 * Tests if the error handler callback is returned correctly.
	 * @param ErrorHandler $errorHandler The initiated error handler.
	 * @param Closure $expectedErrorHandlerCallback The expected error handler callback.
	 * @dataProvider initiatedErrorHandlersWithExpectedCallbacksDataProvider
	 */
	public function testGetErrorHandlerCallback( ErrorHandler $errorHandler, Closure $expectedErrorHandlerCallback ): void
	{
		$resultedExpectedErrorHandlerCallback = $errorHandler->getErrorHandlerCallback();

		static::assertSame( $expectedErrorHandlerCallback, $resultedExpectedErrorHandlerCallback );
	}

	/**
	 * Provides initiated error handlers with callbacks producing outputs and expected output regular expressions.
	 * @return ArrayIterator The initiated error handlers with callbacks producing outputs and expected output regular expressions.
	 */
	public function initiatedErrorHandlersWithCallbacksProducingOutputsAndExpectedOutputRegExsDataProvider(): ArrayIterator
	{
		return new InitiatedErrorHandlersWithCallbacksProducingOutputsAndExpectedOutputRegExsDataProvider();
	}

	/**
	 * Test if the error handler will be registered correctly.
	 * @param ErrorHandler $errorHandler The inititated error handler.
	 * @param string $expectedErrorHandlerOutputRegEx The expected output regular expression.
	 * @dataProvider initiatedErrorHandlersWithCallbacksProducingOutputsAndExpectedOutputRegExsDataProvider
	 */
	public function testRegister( ErrorHandler $errorHandler, string $expectedErrorHandlerOutputRegEx ): void
	{
		$previousErrorHandlerOutput   = "output of the previous error handler\n";
		$previousErrorHandlerCallback = static function () use ( $previousErrorHandlerOutput ): void
		{
			echo $previousErrorHandlerOutput;
		};
		set_error_handler( $previousErrorHandlerCallback );

		$errorHandler->register();

		$registeredErrorHandler = set_error_handler(
			static function ( int $level, string $message, string $file, int $line ): void
			{
			}
		);

		$registeredErrorHandler( 0, 'an errror message', '/path/to/a/file', 42 );

		static::assertSame( $errorHandler, $registeredErrorHandler );

		$this->expectOutputRegex( '~' . $previousErrorHandlerOutput . $expectedErrorHandlerOutputRegEx . '~' );
	}

	/**
	 * Tests if the error handler will be invoked correctly.
	 * @param ErrorHandler $errorHandler The initiated error handler.
	 * @param string $expectedErrorHandlerOutputRegEx The expected error handler output regular expression.
	 * @dataProvider initiatedErrorHandlersWithCallbacksProducingOutputsAndExpectedOutputRegExsDataProvider
	 */
	public function testInvoke( ErrorHandler $errorHandler, string $expectedErrorHandlerOutputRegEx ): void
	{
		set_error_handler(
			static function ( int $level, string $message, string $file, int $line ): void
			{
			}
		);

		$errorHandler->register();

		$registeredErrorHandler = set_error_handler(
			static function ( int $level, string $message, string $file, int $line ): void
			{
			}
		);

		$registeredErrorHandler( 0, 'an errror message', '/path/to/a/file', 42 );

		static::assertSame( $errorHandler, $registeredErrorHandler );

		$this->expectOutputRegex( '~' . $expectedErrorHandlerOutputRegEx . '~' );
	}
}
