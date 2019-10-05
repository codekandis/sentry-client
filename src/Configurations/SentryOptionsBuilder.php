<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Configurations;

/**
 * Represents a builder to create Sentry options.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class SentryOptionsBuilder
{
	/**
	 * Creates an array of Sentry options from a `SentryClient` configuration.
	 * @param SentryClientConfigurationInterface $clientConfiguration The configuration of the `SentryClient`.
	 * @return array The array of Sentry options.
	 */
	public function buildFromClientConfiguration( SentryClientConfigurationInterface $clientConfiguration ): array
	{
		$sentryOptions = [
			'dsn' => $clientConfiguration->getDsn()
		];

		$clientConfiguration->getErrorTypes() && $sentryOptions[ 'error_types' ] = $clientConfiguration->getErrorTypes();
		$clientConfiguration->getRelease() && $sentryOptions[ 'release' ] = $clientConfiguration->getRelease();
		$clientConfiguration->getEnvironment() && $sentryOptions[ 'environment' ] = $clientConfiguration->getEnvironment();
		$clientConfiguration->getSampleRate() && $sentryOptions[ 'sample_rate' ] = $clientConfiguration->getSampleRate();
		$clientConfiguration->getMaxBreadcrumbs() && $sentryOptions[ 'max_breadcrumbs' ] = $clientConfiguration->getMaxBreadcrumbs();
		$clientConfiguration->getAttachStacktrace() && $sentryOptions[ 'attach_stacktrace' ] = $clientConfiguration->getAttachStacktrace();
		$clientConfiguration->getSendDefaultPii() && $sentryOptions[ 'send_default_pii' ] = $clientConfiguration->getSendDefaultPii();
		$clientConfiguration->getServerName() && $sentryOptions[ 'server_name' ] = $clientConfiguration->getServerName();
		$clientConfiguration->getInAppExclude() && $sentryOptions[ 'in_app_exclude' ] = $clientConfiguration->getInAppExclude();
		$clientConfiguration->getRequestBodies() && $sentryOptions[ 'request_bodies' ] = $clientConfiguration->getRequestBodies();
		$clientConfiguration->getIntegrations() && $sentryOptions[ 'integrations' ] = $clientConfiguration->getIntegrations();
		$clientConfiguration->getDefaultIntegrations() && $sentryOptions[ 'default_integrations' ] = $clientConfiguration->getDefaultIntegrations();
		$clientConfiguration->getBeforeSend() && $sentryOptions[ 'before_send' ] = $clientConfiguration->getBeforeSend();
		$clientConfiguration->getBeforeBreadcrumb() && $sentryOptions[ 'before_breadcrumb' ] = $clientConfiguration->getBeforeBreadcrumb();
		$clientConfiguration->getHttpProxy() && $sentryOptions[ 'http_proxy' ] = $clientConfiguration->getHttpProxy();
		$clientConfiguration->getCaptureSilencedErrors() && $sentryOptions[ 'capture_silenced_errors' ] = $clientConfiguration->getCaptureSilencedErrors();
		$clientConfiguration->getContextLines() && $sentryOptions[ 'context_lines' ] = $clientConfiguration->getContextLines();
		$clientConfiguration->getEnableCompression() && $sentryOptions[ 'enable_compression' ] = $clientConfiguration->getEnableCompression();
		$clientConfiguration->getExcludedAppPaths() && $sentryOptions[ 'excluded_app_paths' ] = $clientConfiguration->getExcludedAppPaths();
		$clientConfiguration->getExcludedExceptions() && $sentryOptions[ 'excluded_exceptions' ] = $clientConfiguration->getExcludedExceptions();
		$clientConfiguration->getPrefixes() && $sentryOptions[ 'prefixes' ] = $clientConfiguration->getPrefixes();
		$clientConfiguration->getProjectRoot() && $sentryOptions[ 'project_root' ] = $clientConfiguration->getProjectRoot();
		$clientConfiguration->getSendAttempts() && $sentryOptions[ 'send_attempts' ] = $clientConfiguration->getSendAttempts();

		return $sentryOptions;
	}
}
