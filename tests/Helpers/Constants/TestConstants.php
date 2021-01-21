<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\Helpers\Constants;

/**
 * Represents the constants used by the tests.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class TestConstants
{
	/**
	 * Stores the DSN of the sentry.io project to push events to.
	 * @var string
	 */
	public const DSN = '';

	/**
	 * Stores the sentry.io API base URI.
	 * @var string
	 */
	public const API_URI = 'https://sentry.io/api/0';

	/**
	 * Stores the sentry.io API auth token.
	 * @var string
	 */
	public const AUTH_TOKEN = '';

	/**
	 * Stores the company name.
	 * @var string
	 */
	public const COMPANY_NAME = '';

	/**
	 * Stores the project name.
	 * @var string
	 */
	public const PROJECT_NAME = '';

	/**
	 * Stores the threshold what the test should wait for while sentry.io is processing a new event.
	 * @var int
	 */
	public const EVENT_PROCESSING_THRESHOLD = 10;
}
