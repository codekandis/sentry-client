# Changelog

All notable changes to this project will be documented in this file.

The format is based on [keep a changelog][xtlink-keep-a-changelog]
and this project adheres to [Semantic Versioning 2.0.0][xtlink-semantic-versioning].

## [1.0.0] - 2021-01-21

### Added

* `SentryClientConfigurationInterface` representing the interface for all configurations
* `SentryClientConfiguration` representing the default configuration
* `ErrorLevelValues` representing an enumeration of all known PHP 7.4 error levels constants
* `ErrorLevelNames` representing an enumeration of all known PHP 7.4 error levels constants names
* `RequestBodies` representing an enumeration of possible values for the sentry client configuration `requestBodies`
* `Severities` representing an enumeration of severities for messages, errors and exceptions
* `SentryClient` representing the Sentry SDK wrapper
* `PHPUnit` tests
* `README.md`
* `CHANGELOG.md`

[1.0.0]: https://github.com/codekandis/sentry-client/tree/1.0.0



[xtlink-keep-a-changelog]: http://keepachangelog.com/en/1.0.0/
[xtlink-semantic-versioning]: http://semver.org/spec/v2.0.0.html
