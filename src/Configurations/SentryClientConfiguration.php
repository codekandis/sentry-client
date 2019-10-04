<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Configurations;

/**
 * Represents a `SentryClient` configuration.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class SentryClientConfiguration implements SentryClientConfigurationInterface
{
	/**
	 * Stores the DSN of the sentry client account.
	 * @var string
	 */
	private string $dsn = '';

	/**
	 * Stores the error types that should be catched.
	 * @var ?int
	 */
	private ?int $errorTypes = null;

	/**
	 * Stores if the errors should be displayed or not.
	 * @var bool
	 */
	private bool $displayErrors = false;

	/**
	 * Stores the release the events are attached to.
	 * @var ?string
	 */
	private ?string $release = null;

	/**
	 * Stores the environment of the release the events are attached to.
	 * @var ?string
	 */
	private ?string $environment = null;

	/**
	 * Stores the sample rate from 0.0 to 1.0 of how much events should be captured.
	 * @var ?float
	 */
	private ?float $sampleRate = null;

	/**
	 * Stores the amount of breadcrumbs that should be captured.
	 * @var ?int
	 */
	private ?int $maxBreadcrumbs = null;

	/**
	 * Stores if a stack trace should be attached to the events.
	 * @var ?bool
	 */
	private ?bool $attachStacktrace = null;

	/**
	 * Stores if the personally identifiable information should be attached to the events.
	 * @var ?bool
	 */
	private ?bool $sendDefaultPii = null;

	/**
	 * Stores the server name that will be attached to the events.
	 * @var ?string
	 */
	private ?string $serverName = null;

	/**
	 * Stores the prefixes of the modules that should be excluded from the event capturing.
	 * @var ?string[]
	 */
	private ?array $inAppExclude = null;

	/**
	 * Stores the type of how request bodies will be attached to the events.
	 * @var ?string
	 */
	private ?string $requestBodies = null;

	/**
	 * Stores the integrations to configure.
	 * @var ?string
	 */
	private ?string $integrations = null;

	/**
	 * Stores if the default integrations are enabled.
	 * @var ?bool
	 */
	private ?bool $defaultIntegrations = null;

	/**
	 * Stores the callback that will be invoked before sending the event.
	 * @var ?callable
	 */
	private $beforeSend = null;

	/**
	 * Stores the callback that will be invoked before adding a breadcrumb to the event.
	 * @var ?callable
	 */
	private $beforeBreadcrumb = null;

	/**
	 * Stores the proxy used for outgoing HTTP requests.
	 * @var ?string
	 */
	private ?string $httpProxy = null;

	/**
	 * Stores if silenced errors will be captured.
	 * @var ?bool
	 */
	private ?bool $captureSilencedErrors = null;

	/**
	 * Stores the amount of code lines in the context of the captured events.
	 * @var ?int
	 */
	private ?int $contextLines = null;

	/**
	 * Stores if GZIP compression is enabled.
	 * @var ?bool
	 */
	private ?bool $enableCompression = null;

	/**
	 * Stores the paths to exclude from the app path detection.
	 * @var ?string[]
	 */
	private ?array $excludedAppPaths = null;

	/**
	 * Stores the FQCNs of the exceptions that should be excluded from capturing.
	 * @var ?string[]
	 */
	private ?array $excludedExceptions = null;

	/**
	 * Stores the prefixes of paths which should be stripped from filenames.
	 * @var ?string[]
	 */
	private ?array $prefixes = null;

	/**
	 * Stores the root of the project source code.
	 * @var ?string
	 */
	private ?string $projectRoot = null;

	/**
	 * Stores the number of attempts to send an event before erroring dropping it from the queue.
	 * @var ?int
	 */
	private ?int $sendAttempts = null;

	/**
	 * {@inheritdoc}
	 */
	public function getDsn(): string
	{
		return $this->dsn;
	}

	/**
	 * Sets the DSN of the sentry client account.
	 * @param string $dsn The DSN of the sentry client account.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setDsn( string $dsn ): self
	{
		$this->dsn = $dsn;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getErrorTypes(): ?int
	{
		return $this->errorTypes;
	}

	/**
	 * Sets the error types which should be catched.
	 * @param ?int $errorTypes The error types which should be catched.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setErrorTypes( ?int $errorTypes ): self
	{
		$this->errorTypes = $errorTypes;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getDisplayErrors(): bool
	{
		return $this->displayErrors;
	}

	/**
	 * Sets if the errors should be displayed or not.
	 * @param bool $displayErrors True if the errors should be displayed, false otherwise.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setDisplayErrors( bool $displayErrors ): self
	{
		$this->displayErrors = $displayErrors;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getRelease(): ?string
	{
		return $this->release;
	}

	/**
	 * Sets the release the events are attached to.
	 * @param ?string $release The release the events are attached to.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setRelease( ?string $release ): self
	{
		$this->release = $release;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getEnvironment(): ?string
	{
		return $this->environment;
	}

	/**
	 * Sets the environment of the release the events are attached to.
	 * @param ?string $environment The environment of the release the events are attached to.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setEnvironment( ?string $environment ): self
	{
		$this->environment = $environment;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getSampleRate(): ?float
	{
		return $this->sampleRate;
	}

	/**
	 * Sets the sample rate from 0.0 to 1.0 of how much events should be captured.
	 * @param ?float $sampleRate The sample rate from 0.0 to 1.0 of how much events should be captured.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setSampleRate( ?float $sampleRate ): self
	{
		$this->sampleRate = $sampleRate;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getMaxBreadcrumbs(): ?int
	{
		return $this->maxBreadcrumbs;
	}

	/**
	 * Sets the amount of breadcrumbs that should be captured.
	 * @param ?int $maxBreadcrumbs The amount of breadcrumbs that should be captured.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setMaxBreadcrumbs( ?int $maxBreadcrumbs ): self
	{
		$this->maxBreadcrumbs = $maxBreadcrumbs;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAttachStacktrace(): ?bool
	{
		return $this->attachStacktrace;
	}

	/**
	 * Sets if a stack trace should be attached to the events.
	 * @param ?bool $attachStacktrace True if a stack trace should be attached to the events, false otherwise.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setAttachStacktrace( ?bool $attachStacktrace ): self
	{
		$this->attachStacktrace = $attachStacktrace;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getSendDefaultPii(): ?bool
	{
		return $this->sendDefaultPii;
	}

	/**
	 * Sets if the personally identifiable information should be attached to the events.
	 * @param ?bool $sendDefaultPii True if the personally identifiable information should be attached to the events, false otherwise.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setSendDefaultPii( ?bool $sendDefaultPii ): self
	{
		$this->sendDefaultPii = $sendDefaultPii;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getServerName(): ?string
	{
		return $this->serverName;
	}

	/**
	 * Sets the server name that will be attached to the events.
	 * @param ?string $serverName The server name that will be attached to the events.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setServerName( ?string $serverName ): self
	{
		$this->serverName = $serverName;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getInAppExclude(): ?array
	{
		return $this->inAppExclude;
	}

	/**
	 * Sets the prefixes of the modules that should be excluded from the event capturing.
	 * @param ?string[] $inAppExclude The prefixes of the modules that should be excluded from the event capturing.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setInAppExclude( ?array $inAppExclude ): self
	{
		$this->inAppExclude = $inAppExclude;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getRequestBodies(): ?string
	{
		return $this->requestBodies;
	}

	/**
	 * Sets the type of how request bodies will be attached to the events.
	 * @param ?string $requestBodies The type of how request bodies will be attached to the events.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setRequestBodies( ?string $requestBodies ): self
	{
		$this->requestBodies = $requestBodies;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getIntegrations(): ?string
	{
		return $this->integrations;
	}

	/**
	 * Sets the integrations to configure.
	 * @param ?string $integrations The integrations to configure.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setIntegrations( ?string $integrations ): self
	{
		$this->integrations = $integrations;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getDefaultIntegrations(): ?bool
	{
		return $this->defaultIntegrations;
	}

	/**
	 * Sets if the default integrations are enabled.
	 * @param ?bool $defaultIntegrations True if the default integrations are enabled, false otherwise.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setDefaultIntegrations( ?bool $defaultIntegrations ): self
	{
		$this->defaultIntegrations = $defaultIntegrations;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getBeforeSend(): ?callable
	{
		return $this->beforeSend;
	}

	/**
	 * Sets the callback that will be invoked before sending the event.
	 * @param ?callable $beforeSend The callback that will be invoked before sending the event.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setBeforeSend( ?callable $beforeSend ): self
	{
		$this->beforeSend = $beforeSend;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getBeforeBreadcrumb(): ?callable
	{
		return $this->beforeBreadcrumb;
	}

	/**
	 * Sets the callback that will be invoked before adding a breadcrumb to the event.
	 * @param ?callable $beforeBreadcrumb The callback that will be invoked before adding a breadcrumb to the event.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setBeforeBreadcrumb( ?callable $beforeBreadcrumb ): self
	{
		$this->beforeBreadcrumb = $beforeBreadcrumb;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getHttpProxy(): ?string
	{
		return $this->httpProxy;
	}

	/**
	 * Sets the proxy used for outgoing HTTP requests.
	 * @param ?string $httpProxy The proxy used for outgoing HTTP requests.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setHttpProxy( ?string $httpProxy ): self
	{
		$this->httpProxy = $httpProxy;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getCaptureSilencedErrors(): ?bool
	{
		return $this->captureSilencedErrors;
	}

	/**
	 * Sets if silenced error will be captured.
	 * @param ?bool $captureSilencedErrors True if silenced error will be captured, false otherwise.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setCaptureSilencedErrors( ?bool $captureSilencedErrors ): self
	{
		$this->captureSilencedErrors = $captureSilencedErrors;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getContextLines(): ?int
	{
		return $this->contextLines;
	}

	/**
	 * Sets the amount of code lines in the context of the captured events.
	 * @param ?int $contextLines The amount of code lines in the context of the captured events.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setContextLines( ?int $contextLines ): self
	{
		$this->contextLines = $contextLines;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getEnableCompression(): ?bool
	{
		return $this->enableCompression;
	}

	/**
	 * Sets if GZIP compression is enabled.
	 * @param ?bool $enableCompression True if GZIP compression is enabled, false otherwise.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setEnableCompression( ?bool $enableCompression ): self
	{
		$this->enableCompression = $enableCompression;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getExcludedAppPaths(): ?array
	{
		return $this->excludedAppPaths;
	}

	/**
	 * Sets the paths to exclude from the app path detection.
	 * @param ?string[] $excludedAppPaths The paths to exclude from the app path detection.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setExcludedAppPaths( ?array $excludedAppPaths ): self
	{
		$this->excludedAppPaths = $excludedAppPaths;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getExcludedExceptions(): ?array
	{
		return $this->excludedExceptions;
	}

	/**
	 * Sets the FQCNs of the exceptions that should be excluded from capturing.
	 * @param ?string[] $excludedExceptions The FQCNs of the exceptions that should be excluded from capturing.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setExcludedExceptions( ?array $excludedExceptions ): self
	{
		$this->excludedExceptions = $excludedExceptions;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getPrefixes(): ?array
	{
		return $this->prefixes;
	}

	/**
	 * Sets the prefixes of paths which should be stripped from filenames.
	 * @param ?string[] $prefixes The prefixes of paths which should be stripped from filenames.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setPrefixes( ?array $prefixes ): self
	{
		$this->prefixes = $prefixes;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getProjectRoot(): ?string
	{
		return $this->projectRoot;
	}

	/**
	 * Sets the root of the project source code.
	 * @param ?string $projectRoot The root of the project source code.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setProjectRoot( ?string $projectRoot ): self
	{
		$this->projectRoot = $projectRoot;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getSendAttempts(): ?int
	{
		return $this->sendAttempts;
	}

	/**
	 * Sets the number of attempts to send an event before erroring dropping it from the queue.
	 * @param ?int $sendAttempts The number of attempts to send an event before erroring dropping it from the queue.
	 * @return SentryClientConfiguration The `SentryClient` configuration.
	 */
	public function setSendAttempts( ?int $sendAttempts ): self
	{
		$this->sendAttempts = $sendAttempts;

		return $this;
	}
}
