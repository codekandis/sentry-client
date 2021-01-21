<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\DataProviders\Outputs\UserOutputInterfaceTest;

use ArrayIterator;
use CodeKandis\SentryClient\Outputs\UserOutput;
use CodeKandis\SentryClient\Outputs\UserOutputInterface;

/**
 * Represents a data provider providing initiated user outputs with user and expected output regular expressions.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class InitiatedUserOutputsWithUserAndExpectedOutputRegExsDataProvider extends ArrayIterator
{
	/**
	 * Constructor method.
	 */
	public function __construct()
	{
		parent::__construct(
			[
				0 => [
					'userOutput'          => new class() implements UserOutputInterface {
						public function print( array $user ): void
						{
							echo 'user output';
						}
					},
					'user'                => [],
					'expectedOutputRegEx' => <<<END
^user output$
END
				],
				1 => [
					'userOutput'          => new UserOutput(),
					'user'                => [
						'id'         => 'codekandis',
						'ip_address' => '42.42.42.42'
					],
					'expectedOutputRegEx' => <<<END
^\[user\]
Array
\(
    \[id\] => codekandis
    \[ip_address\] => 42\.42\.42\.42
\)
$
END
				]
			]
		);
	}
}
