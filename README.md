# codekandis/sentry-client

[![Version][xtlink-version-badge]][srclink-changelog]
[![License][xtlink-license-badge]][srclink-license]
[![Minimum PHP Version][xtlink-php-version-badge]][xtlink-php-net]
![Code Coverage][xtlink-code-coverage-badge]

`codekandis/sentry-client` is a wrapper library for the Sentry SDK package [`getsentry/sentry-php`][xtlink-github-getsentry-sentry-php], currently supporting the Sentry SDK version `2.x`. It provides the functionality of the wrapped package by an object-oriented API.

## Index

* [Installation](#installation)
* [How to use](#how-to-use)
  * [Create a configuration](#create-a-configuration)
    * [Use the default configuration](#use-the-default-configuration)
    * [Implement the configuration interface on your own](#implement-the-configuration-interface-on-your-own)
  * [Instantiate the Sentry Client](#instantiate-the-sentry-client)
  * [Capturing events](#capturing-events)
    * [Manual capturing](#manual-capturing)
      * [Messages](#messages)
      * [Errors](#errors)
      * [Exceptions](#exceptions)
    * [Automatic Capturing](#automatic-capturing)
    * [Using custom error and exception handlers](#using-custom-error-and-exception-handlers)
  * [Testing](#testing)

## Installation

Install the latest version with

```bash
$ composer require codekandis/sentry-client
```

## How to use

### Create a configuration

There's two possibilites.

#### Use the default configuration

For convenience the default configuration [`SentryClientConfiguration`][srclink-sentry-client-configuration] implements the fluent interface.

```php
<?php declare( strict_types = 1 );
namespace Vendor\Project;

use CodeKandis\SentryClient\Configurations\SentryClientConfiguration;

$sentryClientConfiguration = ( new SentryClientConfiguration() )
	->setDsn( 'dsn' )
	->setErrorTypes( E_ALL )
	->setDisplayErrors( true );
```

#### Implement the configuration interface on your own

The [`SentryClient`][srclink-sentry-client] comes with the configuration interface [`SentryClientConfigurationInterface`][srclink-sentry-client-configuration-interface]. So you are enabled to implement a configuration on your own.

```php
<?php declare( strict_types = 1 );
namespace Vendor\Project;

use CodeKandis\SentryClient\Configurations\SentryClientConfigurationInterface;

class SentryClientConfiguration implements SentryClientConfigurationInterface
{
	public function getDsn(): string
	{
		return 'dsn';
	}
	
	/**
	 * ...
	 */
}

$sentryClientConfiguration = new SentryClientConfiguration();
```

### Instantiate the Sentry Client

```php
<?php declare( strict_types = 1 );
namespace Vendor\Project;

use CodeKandis\SentryClient\Configurations\SentryClientConfiguration;
use CodeKandis\SentryClient\SentryClient;
use const E_ALL;

$sentryClient = new SentryClient(
	( new SentryClientConfiguration() )
	    ->setDsn( 'dsn' )
		->setErrorTypes( E_ALL )
		->setDisplayErrors( true )
);
```

As soon as the [`SentryClient`][srclink-sentry-client] is instantiated the PHP directives [`error_reporting`][xtlink-php-net-error-reporting] and [`display_errors`][xtlink-php-net-display-errors] will be set immediately. Be aware that [`display_errors`][xtlink-php-net-display-errors], once set to `true`, will take effect in displaying all captured events. So besides errors and exceptions manually captured messages are displayed as well.

### Capturing events

There are two methods of capturing messages, errors and exceptions - so-called events in terms of [Sentry][xtlink-sentry-io].

#### Manual capturing

##### Messages

```php
<?php declare( strict_types = 1 );
namespace Vendor\Project;

use CodeKandis\SentryClient\Configurations\SentryClientConfiguration;
use CodeKandis\SentryClient\SentryClient;
use CodeKandis\SentryClient\Severities;

( new SentryClient( new SentryClientConfiguration() ) )
	->captureMessage(
		'This is a message.',
		Severities::INFO,
		[
			'some' => 'context'
		],
		[
			'some tag',
			'another tag'
		],
		[
			'id'         => 'some username',
			'ip_address' => '42.42.42.42'
		]
	);
```

##### Errors

Only the last occured error can be captured.

```php
<?php declare( strict_types = 1 );
namespace Vendor\Project;

use CodeKandis\SentryClient\Configurations\SentryClientConfiguration;
use CodeKandis\SentryClient\SentryClient;
use CodeKandis\SentryClient\Severities;

( new SentryClient( new SentryClientConfiguration() ) )
	->captureLastError(
		Severities::ERROR,
		[
			'some' => 'context'
		],
		[
			'some tag',
			'another tag'
		],
		[
			'id'         => 'some username',
			'ip_address' => '42.42.42.42'
		]
	);
```

##### Exceptions

```php
<?php declare( strict_types = 1 );
namespace Vendor\Project;

use CodeKandis\SentryClient\Configurations\SentryClientConfiguration;
use CodeKandis\SentryClient\SentryClient;
use CodeKandis\SentryClient\Severities;
use Exception;

( new SentryClient( new SentryClientConfiguration() ) )
	->captureThrowable(
		new Exception( 'This is an exception' ),
		Severities::FATAL,
		[
			'some' => 'context'
		],
		[
			'some tag',
			'another tag'
		],
		[
			'id'         => 'some username',
			'ip_address' => '42.42.42.42'
		]
	);
```

#### Automatic Capturing

The [`SentryClient`][srclink-sentry-client] comes with built-in error and exception handlers. Once the automatic capturing of events is enabled the occured events will be captured by that handlers and sent to your configured Sentry instance.

To enable the automatic capturing you just have to call [`SentryClient::register()`][srclink-sentry-client].

```php
<?php declare( strict_types = 1 );
namespace Vendor\Project;

use CodeKandis\SentryClient\Configurations\SentryClientConfiguration;
use CodeKandis\SentryClient\SentryClient;

( new SentryClient( new SentryClientConfiguration() ) )
	->register();
```

### Using custom error and exception handlers

In case you have already set your own error or exception handlers, registering the [`SentryClient`][srclink-sentry-client] for automatic capturing won't affect them being executed.

```php
<?php declare( strict_types = 1 );
namespace Vendor\Project;

use CodeKandis\SentryClient\Configurations\SentryClientConfiguration;
use CodeKandis\SentryClient\SentryClient;
use Exception;
use Throwable;
use function set_error_handler;
use function set_exception_handler;
use function trigger_error;

set_error_handler(
	function ( int $level, string $message )
	{
		echo 'Error handler: ' . $message . "\n";
	}
);

set_exception_handler(
	function ( Throwable $exception )
	{
		echo 'Exception handler: ' . $exception->getMessage() . "\n";
	}
);

( new SentryClient( new SentryClientConfiguration() ) )
	->register();

trigger_error( 'An error occured.' );            // outputs `Error handler: An error occured.`
throw new Exception( 'An exception occured.' );  // outputs `Exception handler: An exception occured.`
```

The Sentry Client pushes its own handlers on top of its internal managed stack of handlers. So the error and exception handlers are executed in the following order:

1. the [`SentryClient`][srclink-sentry-client] handler
2. the wrapped [Sentry SDK][xtlink-github-getsentry-sentry-php] handler
3. your custom handler

So it's guaranteed all events will be sent to your Sentry instance and your handlers are executed as well.

## Testing

To get the integration tests running some settings must be made in the [`TestConstants`][testlink-helpers-constants-test-constants]. All necessary information can be found in your Sentry instance.

Depending on the workload of your Sentry instance your events may not be fetchable immediately by the API. So a proper [`TestConstants::EVENT_PROCESSING_THRESHOLD`][testlink-helpers-constants-test-constants] in seconds must be set.

Due to the nature of the wrapped [Sentry SDK][xtlink-github-getsentry-sentry-php] executing all test cases at once causes some integration tests to fail. Some necessary test outputs mess up with the following tests. It's recommended to run all single tests in the test case [`SentryClientInterfaceTest`][testlink-integration-tests-sentry-client-interface] manually one by one.



[xtlink-version-badge]: https://img.shields.io/badge/version-1.0.0-blue.svg
[xtlink-license-badge]: https://img.shields.io/badge/license-MIT-yellow.svg
[xtlink-php-version-badge]: https://img.shields.io/badge/php-%3E%3D%207.4-8892BF.svg
[xtlink-code-coverage-badge]: https://img.shields.io/badge/coverage-100%25-green.svg
[xtlink-php-net]: https://php.net
[xtlink-php-net-error-reporting]: https://www.php.net/manual/en/function.error-reporting.php
[xtlink-php-net-display-errors]: https://www.php.net/manual/en/errorfunc.configuration.php#ini.display-errors
[xtlink-github-getsentry-sentry-php]: https://github.com/getsentry/sentry-php
[xtlink-sentry-io]: https://sentry.io

[srclink-changelog]: ./CHANGELOG.md
[srclink-license]: ./LICENSE
[srclink-sentry-client-configuration-interface]: ./src/Configurations/SentryClientConfigurationInterface.php
[srclink-sentry-client-configuration]: ./src/Configurations/SentryClientConfiguration.php
[srclink-sentry-client]: ./src/SentryClient.php
[testlink-integration-tests-sentry-client-interface]: ./tests/IntegrationTests/SentryClientInterfaceTest.php
[testlink-helpers-constants-test-constants]: ./tests/Helpers/Constants/TestConstants.php
