<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Tests\Helpers\SentryApi;

use function curl_close;
use function curl_exec;
use function curl_init;
use function curl_setopt;
use function json_decode;
use function sprintf;
use const CURLOPT_CUSTOMREQUEST;
use const CURLOPT_FORBID_REUSE;
use const CURLOPT_HTTPHEADER;
use const CURLOPT_RETURNTRANSFER;
use const CURLOPT_TCP_KEEPALIVE;
use const JSON_THROW_ON_ERROR;

/**
 * Represents a sentry.io API request.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class ApiRequests
{
	/**
	 * Stores the sentry.io API base URI.
	 * @var string
	 */
	private string $baseUri;

	/**
	 * Stores the sentry.io API auth token.
	 * @var string
	 */
	private string $authToken;

	/**
	 * Stores the company name.
	 * @var string
	 */
	private string $companyName;

	/**
	 * Stores the project name.
	 * @var string
	 */
	private string $projectName;

	/**
	 * Constructor method.
	 * @param string $baseUri
	 * @param string $authToken
	 * @param string $companyName
	 * @param string $projectName
	 */
	public function __construct( string $baseUri, string $authToken, string $companyName, string $projectName )
	{
		$this->baseUri     = $baseUri;
		$this->authToken   = $authToken;
		$this->companyName = $companyName;
		$this->projectName = $projectName;
	}

	/**
	 * Invokes the request.
	 * @param string $uri The URI of the API endpoint.
	 * @param string $method The method of the request.
	 * @return string The response of the request.
	 */
	private function invokeRequest( string $uri, string $method ): string
	{
		$authorizationHeader = sprintf(
			'Authorization: Bearer %s',
			$this->authToken
		);

		$curlHandler = curl_init( $uri );
		curl_setopt( $curlHandler, CURLOPT_HTTPHEADER, [ $authorizationHeader ] );
		curl_setopt( $curlHandler, CURLOPT_CUSTOMREQUEST, $method );
		curl_setopt( $curlHandler, CURLOPT_FORBID_REUSE, true );
		curl_setopt( $curlHandler, CURLOPT_TCP_KEEPALIVE, false );
		curl_setopt( $curlHandler, CURLOPT_RETURNTRANSFER, 1 );

		$response = curl_exec( $curlHandler );
		curl_close( $curlHandler );

		return $response;
	}

	/**
	 * Gets an event specified by its ID.
	 * @param string $eventId The ID of the event.
	 * @return array The event.
	 */
	public function getEvent( string $eventId ): array
	{
		$apiUri = sprintf(
			'%s/projects/%s/%s/events/%s/',
			$this->baseUri,
			$this->companyName,
			$this->projectName,
			$eventId
		);

		return json_decode(
			$this->invokeRequest( $apiUri, 'GET' ),
			true,
			512,
			JSON_THROW_ON_ERROR
		);
	}
}
