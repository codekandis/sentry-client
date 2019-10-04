<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Configurations;

/**
 * Represents the interface of all `SentryClient` configurations.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
interface SentryClientConfigurationInterface
{
	/**
	 * Gets the DSN of the sentry client account.
	 * @return string The DSN of the sentry client account.
	 */
	public function getDsn(): string;

	/**
	 * Gets the error types that should be catched.
	 * @return ?int The error types that should be catched.
	 */
	public function getErrorTypes(): ?int;

	/**
	 * Gets if the errors should be displayed or not.
	 * @return bool True if the errors should be displayed, false otherwise.
	 */
	public function getDisplayErrors(): bool;

	/**
	 * Gets the release the events are attached to.
	 * @return ?string The release the events are attached to.
	 */
	public function getRelease(): ?string;

	/**
	 * Gets the environment of the release the events are attached to.
	 * @return ?string The environment of the release the events are attached to.
	 */
	public function getEnvironment(): ?string;

	/**
	 * Gets the sample rate from 0.0 to 1.0 of how much events should be captured.
	 * @return ?float The sample rate from 0.0 to 1.0 of how much events should be captured.
	 */
	public function getSampleRate(): ?float;

	/**
	 * Gets the amount of breadcrumbs that should be captured.
	 * @return ?int The amount of breadcrumbs that should be captured.
	 */
	public function getMaxBreadcrumbs(): ?int;

	/**
	 * Gets if a stack trace should be attached to the events.
	 * @return ?bool True if a stack trace should be attached to the events, false otherwise.
	 */
	public function getAttachStacktrace(): ?bool;

	/**
	 * Gets if the personally identifiable information should be attached to the events.
	 * @return ?bool True if the personally identifiable information should be attached to the events, false otherwise.
	 */
	public function getSendDefaultPii(): ?bool;

	/**
	 * Gets the server name that will be attached to the events.
	 * @return ?string The server name that will be attached to the events.
	 */
	public function getServerName(): ?string;

	/**
	 * Gets the prefixes of the modules that should be excluded from the event capturing.
	 * @return ?string[] The prefixes of the modules that should be excluded from the event capturing.
	 */
	public function getInAppExclude(): ?array;

	/**
	 * Gets the type of how request bodies will be attached to the events.
	 * @return ?string The type of how request bodies will be attached to the events.
	 */
	public function getRequestBodies(): ?string;

	/**
	 * Gets the integrations to configure.
	 * @return ?string The integrations to configure.
	 */
	public function getIntegrations(): ?string;

	/**
	 * Gets if the default integrations are enabled.
	 * @return ?bool True if the default integrations are enabled, false otherwise.
	 */
	public function getDefaultIntegrations(): ?bool;

	/**
	 * Gets the callback that will be invoked before sending the event.
	 * @return ?callable The callback that will be invoked before sending the event.
	 */
	public function getBeforeSend(): ?callable;

	/**
	 * Gets the callback that will be invoked before adding a breadcrumb to the event.
	 * @return ?callable The callback that will be invoked before adding a breadcrumb to the event.
	 */
	public function getBeforeBreadcrumb(): ?callable;

	/**
	 * Gets the proxy used for outgoing HTTP requests.
	 * @return ?string The proxy used for outgoing HTTP requests.
	 */
	public function getHttpProxy(): ?string;

	/**
	 * Gets if silenced errors will be captured.
	 * @return ?bool True if silenced errors will be captured, false otherwise.
	 */
	public function getCaptureSilencedErrors(): ?bool;

	/**
	 * Gets the amount of code lines in the context of the captured events.
	 * @return ?int The amount of code lines in the context of the captured events.
	 */
	public function getContextLines(): ?int;

	/**
	 * Gets if GZIP compression is enabled.
	 * @return ?bool True if GZIP compression is enabled, false otherwise.
	 */
	public function getEnableCompression(): ?bool;

	/**
	 * Gets the paths to exclude from the app path detection.
	 * @return ?string[] The paths to exclude from the app path detection.
	 */
	public function getExcludedAppPaths(): ?array;

	/**
	 * Gets the FQCNs of the exceptions that should be excluded from capturing.
	 * @return ?string[] The FQCNs of the exceptions that should be excluded from capturing.
	 */
	public function getExcludedExceptions(): ?array;

	/**
	 * Gets the prefixes of paths which should be stripped from filenames.
	 * @return ?string[] The prefixes of paths which should be stripped from filenames.
	 */
	public function getPrefixes(): ?array;

	/**
	 * Gets the root of the project source code.
	 * @return ?string The root of the project source code.
	 */
	public function getProjectRoot(): ?string;

	/**
	 * Gets the number of attempts to send an event before erroring and dropping it from the queue.
	 * @return ?int The number of attempts to send an event before erroring dropping and it from the queue.
	 */
	public function getSendAttempts(): ?int;
}
