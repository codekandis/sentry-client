<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\DataProviders\Outputs\UserOutputInterfaceTest;

use ArrayIterator;
use CodeKandis\SentryClient\Outputs\UserOutput;

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
