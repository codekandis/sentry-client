<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\DataProviders\SentryClientInterfaceTest;

use ArrayIterator;
use CodeKandis\SentryClient\Configurations\SentryClientConfiguration;
use CodeKandis\SentryClient\ErrorLevelValues;
use CodeKandis\SentryClient\Severities;
use CodeKandis\SentryClient\Tests\Helpers\Constants\TestConstants;
use LogicException;

/**
 * Represents a data provider providing initiated Sentry clients with throwables, severities, contexts, tags, users, expected event titles, tags, users and output regular expressions.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class InitiatedSentryClientConfigurationsWithThrowablesSeveritiesContextsTagsUsersExpectedEventTitlesTagsUsersAndOutputRegExsDataProvider extends ArrayIterator
{
	/**
	 * Constructor method.
	 */
	public function __construct()
	{
		parent::__construct(
			[
				0 => [
					'sentryClientConfiguration' => ( new SentryClientConfiguration() )
						->setDsn( TestConstants::DSN )
						->setErrorTypes( ErrorLevelValues::E_ALL )
						->setDisplayErrors( false )
						->setRelease( 'none' )
						->setEnvironment( 'development' ),
					'throwable'                 => new LogicException( 'Manually captured throwable without `displayErrors`, with context, with tags, with user.' ),
					'severity'                  => Severities::WARNING,
					'context'                   => [
						'context_key_1' => 'context_value_1',
						'context_key_2' => 'context_value_2',
						'context_key_3' => [
							'context_key_3_1' => 'context_value_3_1',
							'context_key_3_2' => 'context_value_3_2',
							'context_key_3_3' => 'context_value_3_3'
						]
					],
					'tags'                      => [
						'tag_key_1' => 'tag_value_1',
						'tag_key_2' => 'tag_value_2'
					],
					'user'                      => [
						'id'         => 'codekandis',
						'ip_address' => '42.42.42.42'
					],
					'expectedEventTitle'        => 'LogicException: Manually captured throwable without `displayErrors`, with context, with tags, with user.',
					'expectedContext'           => [
						'context_key_1' => 'context_value_1',
						'context_key_2' => 'context_value_2',
						'context_key_3' => [
							'context_key_3_1' => 'context_value_3_1',
							'context_key_3_2' => 'context_value_3_2',
							'context_key_3_3' => 'context_value_3_3'
						]
					],
					'expectedTags'              => [
						'tag_key_1' => 'tag_value_1',
						'tag_key_2' => 'tag_value_2'
					],
					'expectedUser'              => [
						'id'         => 'codekandis',
						'ip_address' => '42.42.42.42'
					],
					'expectedOutputRegEx'       => <<<END
^$
END
				],
				1 => [
					'sentryClientConfiguration' => ( new SentryClientConfiguration() )
						->setDsn( TestConstants::DSN )
						->setErrorTypes( ErrorLevelValues::E_ALL )
						->setDisplayErrors( false )
						->setRelease( 'none' )
						->setEnvironment( 'development' ),
					'throwable'                 => new LogicException( 'Manually captured throwable without `displayErrors`, without context, with tags, with user.' ),
					'severity'                  => Severities::WARNING,
					'context'                   => [],
					'tags'                      => [
						'tag_key_1' => 'tag_value_1',
						'tag_key_2' => 'tag_value_2'
					],
					'user'                      => [
						'id'         => 'codekandis',
						'ip_address' => '42.42.42.42'
					],
					'expectedEventTitle'        => 'LogicException: Manually captured throwable without `displayErrors`, without context, with tags, with user.',
					'expectedContext'           => [],
					'expectedTags'              => [
						'tag_key_1' => 'tag_value_1',
						'tag_key_2' => 'tag_value_2'
					],
					'expectedUser'              => [
						'id'         => 'codekandis',
						'ip_address' => '42.42.42.42'
					],
					'expectedOutputRegEx'       => <<<END
^$
END
				],
				2 => [
					'sentryClientConfiguration' => ( new SentryClientConfiguration() )
						->setDsn( TestConstants::DSN )
						->setErrorTypes( ErrorLevelValues::E_ALL )
						->setDisplayErrors( false )
						->setRelease( 'none' )
						->setEnvironment( 'development' ),
					'throwable'                 => new LogicException( 'Manually captured throwable without `displayErrors`, with context, without tags, without user.' ),
					'severity'                  => Severities::WARNING,
					'context'                   => [
						'context_key_1' => 'context_value_1',
						'context_key_2' => 'context_value_2',
						'context_key_3' => [
							'context_key_3_1' => 'context_value_3_1',
							'context_key_3_2' => 'context_value_3_2',
							'context_key_3_3' => 'context_value_3_3'
						]
					],
					'tags'                      => [],
					'user'                      => [],
					'expectedEventTitle'        => 'LogicException: Manually captured throwable without `displayErrors`, with context, without tags, without user.',
					'expectedContext'           => [
						'context_key_1' => 'context_value_1',
						'context_key_2' => 'context_value_2',
						'context_key_3' => [
							'context_key_3_1' => 'context_value_3_1',
							'context_key_3_2' => 'context_value_3_2',
							'context_key_3_3' => 'context_value_3_3'
						]
					],
					'expectedTags'              => [],
					'expectedUser'              => [],
					'expectedOutputRegEx'       => <<<END
^$
END
				],
				3 => [
					'sentryClientConfiguration' => ( new SentryClientConfiguration() )
						->setDsn( TestConstants::DSN )
						->setErrorTypes( ErrorLevelValues::E_ALL )
						->setDisplayErrors( false )
						->setRelease( 'none' )
						->setEnvironment( 'development' ),
					'throwable'                 => new LogicException( 'Manually captured throwable without `displayErrors`, without context, without tags, without user.' ),
					'severity'                  => Severities::WARNING,
					'context'                   => [],
					'tags'                      => [],
					'user'                      => [],
					'expectedEventTitle'        => 'LogicException: Manually captured throwable without `displayErrors`, without context, without tags, without user.',
					'expectedContext'           => [],
					'expectedTags'              => [],
					'expectedUser'              => [],
					'expectedOutputRegEx'       => <<<END
^$
END
				],
				4 => [
					'sentryClientConfiguration' => ( new SentryClientConfiguration() )
						->setDsn( TestConstants::DSN )
						->setErrorTypes( ErrorLevelValues::E_ALL )
						->setDisplayErrors( true )
						->setRelease( 'none' )
						->setEnvironment( 'development' ),
					'throwable'                 => new LogicException( 'Manually captured throwable with `displayErrors`, with context, with tags, with user.' ),
					'severity'                  => Severities::WARNING,
					'context'                   => [
						'context_key_1' => 'context_value_1',
						'context_key_2' => 'context_value_2',
						'context_key_3' => [
							'context_key_3_1' => 'context_value_3_1',
							'context_key_3_2' => 'context_value_3_2',
							'context_key_3_3' => 'context_value_3_3'
						]
					],
					'tags'                      => [
						'tag_key_1' => 'tag_value_1',
						'tag_key_2' => 'tag_value_2'
					],
					'user'                      => [
						'id'         => 'codekandis',
						'ip_address' => '42.42.42.42'
					],
					'expectedEventTitle'        => 'LogicException: Manually captured throwable with `displayErrors`, with context, with tags, with user.',
					'expectedContext'           => [
						'context_key_1' => 'context_value_1',
						'context_key_2' => 'context_value_2',
						'context_key_3' => [
							'context_key_3_1' => 'context_value_3_1',
							'context_key_3_2' => 'context_value_3_2',
							'context_key_3_3' => 'context_value_3_3'
						]
					],
					'expectedTags'              => [
						'tag_key_1' => 'tag_value_1',
						'tag_key_2' => 'tag_value_2'
					],
					'expectedUser'              => [
						'id'         => 'codekandis',
						'ip_address' => '42.42.42.42'
					],
					'expectedOutputRegEx'       => <<<END
^execution interrupted
\[type\]     throwable
\[class\]    LogicException
\[severity\] warning
\[code\]     \d+
\[message\]  Manually captured throwable with `displayErrors`, with context, with tags, with user.
\[line\]     \d+
\[file\]     .+
\[stacktrace\]
(#\d+ .+\n?)+
\[context\]
Array
\(
    \[context_key_1\] => context_value_1
    \[context_key_2\] => context_value_2
    \[context_key_3\] => Array
        \(
            \[context_key_3_1\] => context_value_3_1
            \[context_key_3_2\] => context_value_3_2
            \[context_key_3_3\] => context_value_3_3
        \)

\)
\[tags\]
Array
\(
    \[tag_key_1\] => tag_value_1
    \[tag_key_2\] => tag_value_2
\)
\[user\]
Array
\(
    \[id\] => codekandis
    \[ip_address\] => 42\.42\.42\.42
\)
$
END
				],
				5 => [
					'sentryClientConfiguration' => ( new SentryClientConfiguration() )
						->setDsn( TestConstants::DSN )
						->setErrorTypes( ErrorLevelValues::E_ALL )
						->setDisplayErrors( true )
						->setRelease( 'none' )
						->setEnvironment( 'development' ),
					'throwable'                 => new LogicException( 'Manually captured throwable with `displayErrors`, without context, with tags, with user.' ),
					'severity'                  => Severities::WARNING,
					'context'                   => [],
					'tags'                      => [
						'tag_key_1' => 'tag_value_1',
						'tag_key_2' => 'tag_value_2'
					],
					'user'                      => [
						'id'         => 'codekandis',
						'ip_address' => '42.42.42.42'
					],
					'expectedEventTitle'        => 'LogicException: Manually captured throwable with `displayErrors`, without context, with tags, with user.',
					'expectedContext'           => [],
					'expectedTags'              => [
						'tag_key_1' => 'tag_value_1',
						'tag_key_2' => 'tag_value_2'
					],
					'expectedUser'              => [
						'id'         => 'codekandis',
						'ip_address' => '42.42.42.42'
					],
					'expectedOutputRegEx'       => <<<END
^execution interrupted
\[type\]     throwable
\[class\]    LogicException
\[severity\] warning
\[code\]     \d+
\[message\]  Manually captured throwable with `displayErrors`, without context, with tags, with user.
\[line\]     \d+
\[file\]     .+
\[stacktrace\]
(#\d+ .+\n?)+
\[tags\]
Array
\(
    \[tag_key_1\] => tag_value_1
    \[tag_key_2\] => tag_value_2
\)
\[user\]
Array
\(
    \[id\] => codekandis
    \[ip_address\] => 42\.42\.42\.42
\)
$
END
				],
				6 => [
					'sentryClientConfiguration' => ( new SentryClientConfiguration() )
						->setDsn( TestConstants::DSN )
						->setErrorTypes( ErrorLevelValues::E_ALL )
						->setDisplayErrors( true )
						->setRelease( 'none' )
						->setEnvironment( 'development' ),
					'throwable'                 => new LogicException( 'Manually captured throwable with `displayErrors`, with context, without tags, without user.' ),
					'severity'                  => Severities::WARNING,
					'context'                   => [
						'context_key_1' => 'context_value_1',
						'context_key_2' => 'context_value_2',
						'context_key_3' => [
							'context_key_3_1' => 'context_value_3_1',
							'context_key_3_2' => 'context_value_3_2',
							'context_key_3_3' => 'context_value_3_3'
						]
					],
					'tags'                      => [],
					'user'                      => [],
					'expectedEventTitle'        => 'LogicException: Manually captured throwable with `displayErrors`, with context, without tags, without user.',
					'expectedContext'           => [
						'context_key_1' => 'context_value_1',
						'context_key_2' => 'context_value_2',
						'context_key_3' => [
							'context_key_3_1' => 'context_value_3_1',
							'context_key_3_2' => 'context_value_3_2',
							'context_key_3_3' => 'context_value_3_3'
						]
					],
					'expectedTags'              => [],
					'expectedUser'              => [],
					'expectedOutputRegEx'       => <<<END
^execution interrupted
\[type\]     throwable
\[class\]    LogicException
\[severity\] warning
\[code\]     0
\[message\]  Manually captured throwable with `displayErrors`, with context, without tags, without user.
\[line\]     \d+
\[file\]     .+
\[stacktrace\]
(#\d+ .+\n?)+
\[context\]
Array
\(
    \[context_key_1\] => context_value_1
    \[context_key_2\] => context_value_2
    \[context_key_3\] => Array
        \(
            \[context_key_3_1\] => context_value_3_1
            \[context_key_3_2\] => context_value_3_2
            \[context_key_3_3\] => context_value_3_3
        \)

\)
$
END
				],
				7 => [
					'sentryClientConfiguration' => ( new SentryClientConfiguration() )
						->setDsn( TestConstants::DSN )
						->setErrorTypes( ErrorLevelValues::E_ALL )
						->setDisplayErrors( true )
						->setRelease( 'none' )
						->setEnvironment( 'development' ),
					'throwable'                 => new LogicException( 'Manually captured throwable with `displayErrors`, without context, without tags, without user.' ),
					'severity'                  => Severities::WARNING,
					'context'                   => [],
					'tags'                      => [],
					'user'                      => [],
					'expectedEventTitle'        => 'LogicException: Manually captured throwable with `displayErrors`, without context, without tags, without user.',
					'expectedContext'           => [],
					'expectedTags'              => [],
					'expectedUser'              => [],
					'expectedOutputRegEx'       => <<<END
^execution interrupted
\[type\]     throwable
\[class\]    LogicException
\[severity\] warning
\[code\]     0
\[message\]  Manually captured throwable with `displayErrors`, without context, without tags, without user.
\[line\]     \d+
\[file\]     .+
\[stacktrace\]
(#\d+ .+\n?)+
$
END
				],
			]
		);
	}
}
