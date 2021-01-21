<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient;

use CodeKandis\SentryClient\Configurations\SentryClientConfigurationInterface;
use CodeKandis\SentryClient\Configurations\SentryOptionsBuilder;
use CodeKandis\SentryClient\Handlers\ErrorHandler;
use CodeKandis\SentryClient\Handlers\ErrorHandlerInterface;
use CodeKandis\SentryClient\Handlers\ThrowableHandler;
use CodeKandis\SentryClient\Handlers\ThrowableHandlerInterface;
use CodeKandis\SentryClient\Outputs\ContextOutput;
use CodeKandis\SentryClient\Outputs\ErrorOutput;
use CodeKandis\SentryClient\Outputs\MessageOutput;
use CodeKandis\SentryClient\Outputs\TagsOutput;
use CodeKandis\SentryClient\Outputs\ThrowableOutput;
use CodeKandis\SentryClient\Outputs\UserOutput;
use Sentry\ClientBuilder;
use Sentry\FlushableClientInterface;
use Sentry\SentrySdk;
use Sentry\Severity as SentrySeverity;
use Sentry\State\Hub;
use Sentry\State\HubInterface;
use Sentry\State\Scope;
use Throwable;
use function error_get_last;
use function error_reporting;
use function ini_set;

/**
 * Represents a `SentryClient` implementation.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class SentryClient implements SentryClientInterface
{
	/**
	 * Stores the configuration of the `SentryClient`.
	 * @var SentryClientConfigurationInterface
	 */
	private SentryClientConfigurationInterface $configuration;

	/**
	 * Stores the initiated `Hub`.
	 * @var HubInterface
	 */
	private HubInterface $hub;

	/**
	 * Stores the error handler.
	 * @var ?ErrorHandlerInterface
	 */
	private ?ErrorHandlerInterface $errorHandler;

	/**
	 * Stores the throwable handler.
	 * @var ?ThrowableHandlerInterface
	 */
	private ?ThrowableHandlerInterface $throwableHandler;

	/**
	 * Constructor method.
	 * @param SentryClientConfigurationInterface $configuration The configuration of the `SentryClient`.
	 */
	public function __construct( SentryClientConfigurationInterface $configuration )
	{
		$this->configuration = $configuration;

		$this->setupHub();
		$this->setupRuntimeErrorHandling();
	}

	/**
	 * Setup the `Sentry SDK` hub managing the error and exception handlers.
	 */
	private function setupHub(): void
	{
		$this->hub = new Hub(
			ClientBuilder::create(
				( new SentryOptionsBuilder() )
					->buildFromClientConfiguration( $this->configuration )
			)->getClient(),
			new Scope()
		);
	}

	/**
	 * Setup the runtime error handling.
	 */
	private function setupRuntimeErrorHandling(): void
	{
		error_reporting( $this->configuration->getErrorTypes() );
		ini_set(
			'display_errors',
			true === $this->configuration->getDisplayErrors()
				? 'On'
				: 'Off'
		);
	}

	/**
	 * Registers the error handler to print informations about the error.
	 */
	private function registerErrorHandler(): void
	{
		$this->errorHandler = new ErrorHandler(
			function ( int $code, string $message, string $file, int $line ): void
			{
				$this->flushOriginClient();

				if ( true === $this->configuration->getDisplayErrors() )
				{
					( new ErrorOutput() )
						->print( Severities::INFO, $code, $message, $file, $line );
				}
			}
		);
		$this->errorHandler->register();
	}

	/**
	 * Registers the throwable handler to print informations about the throwable.
	 */
	private function registerThrowableHandler(): void
	{
		$this->throwableHandler = new ThrowableHandler(
			function ( Throwable $throwable ): void
			{
				$this->flushOriginClient();

				if ( true === $this->configuration->getDisplayErrors() )
				{
					( new ThrowableOutput() )
						->print( Severities::ERROR, $throwable );
				}
			}
		);
		$this->throwableHandler->register();
	}

	/**
	 * Sets the scope of the event to capture.
	 * @param string $severity The severity of the event.
	 * @param array $context The context of the event.
	 * @param array $tags The additional tags of the event.
	 * @param array $user The user causing the event.
	 */
	private function setScope( string $severity, array $context, array $tags, array $user ): void
	{
		$this->hub->configureScope(
			static function ( Scope $scope ) use ( $severity, $context, $tags, $user )
			{
				$scope->setLevel( new SentrySeverity( $severity ) );
				$scope->setExtras( $context );
				$scope->setTags( $tags );
				$scope->setUser( $user, true );
			}
		);
	}

	/**
	 * Flushes the origin client.
	 */
	private function flushOriginClient(): void
	{
		$client = $this->hub->getClient();
		if ( $client instanceof FlushableClientInterface )
		{
			$client->flush();
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function register(): void
	{
		SentrySdk::setCurrentHub( $this->hub );

		$this->registerErrorHandler();
		$this->registerThrowableHandler();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getErrorHandler(): ?ErrorHandlerInterface
	{
		return $this->errorHandler;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getThrowableHandler(): ?ThrowableHandlerInterface
	{
		return $this->throwableHandler;
	}

	/**
	 * {@inheritdoc}
	 */
	public function captureMessage( string $message, string $severity = Severities::INFO, array $context = [], array $tags = [], array $user = [] ): ?string
	{
		$this->setScope( $severity, $context, $tags, $user );
		$sentryEventId = $this->hub->captureMessage( $message, new SentrySeverity( $severity ) );
		$this->flushOriginClient();

		if ( true === $this->configuration->getDisplayErrors() )
		{
			( new MessageOutput() )
				->print( $severity, $message );
			( new ContextOutput() )
				->print( $context );
			( new TagsOutput() )
				->print( $tags );
			( new UserOutput() )
				->print( $user );
		}

		return $sentryEventId;
	}

	/**
	 * {@inheritdoc}
	 */
	public function captureLastError( string $severity = Severities::ERROR, array $context = [], array $tags = [], array $user = [] ): ?string
	{
		$this->setScope( $severity, $context, $tags, $user );
		$sentryEventId = $this->hub->captureLastError();
		$this->flushOriginClient();

		$lastError = error_get_last();
		if ( true === $this->configuration->getDisplayErrors() && null !== $lastError )
		{
			( new ErrorOutput() )
				->print(
					$severity,
					$lastError[ 'type' ],
					$lastError[ 'message' ],
					$lastError[ 'file' ],
					$lastError[ 'line' ]
				);
			( new ContextOutput() )
				->print( $context );
			( new TagsOutput() )
				->print( $tags );
			( new UserOutput() )
				->print( $user );
		}

		return $sentryEventId;
	}

	/**
	 * {@inheritdoc}
	 */
	public function captureThrowable( Throwable $throwable, string $severity = Severities::ERROR, array $context = [], array $tags = [], array $user = [] ): ?string
	{
		$this->setScope( $severity, $context, $tags, $user );
		$sentryEventId = $this->hub->captureException( $throwable );
		$this->flushOriginClient();

		if ( true === $this->configuration->getDisplayErrors() )
		{
			( new ThrowableOutput() )
				->print( $severity, $throwable );
			( new ContextOutput() )
				->print( $context );
			( new TagsOutput() )
				->print( $tags );
			( new UserOutput() )
				->print( $user );
		}

		return $sentryEventId;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getLastEventId(): ?string
	{
		return $this->hub->getLastEventId();
	}
}
