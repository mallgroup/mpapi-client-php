<?php
namespace MPAPI\Endpoints;

use GuzzleHttp\Psr7\Response;
use MPAPI\Services\Client;

/**
 * Partner endpoints
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class PartnerEndpoints
{
	/**
	 * @var string
	 */
	const ENDPOINT_PARTNERS = 'partners';

	/**
	 * @var string
	 */
	const ENDPOINT_SUPPLY_DELAY = 'supply-delay';

	/**
	 * @var Client
	 */
	private $client;

	/**
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * Get partner supply delay
	 *
	 * @return Response
	 */
	public function getSupplyDelay()
	{
		$response = $this->client->sendRequest($this->buildRequestUrl(), 'GET');
		$responseBody = json_decode($response->getBody(), true);
		return $responseBody['data'];
	}

	/**
	 * Create partner supply delay
	 *
	 * @param array $data
	 * @return Response
	 */
	public function postSupplyDelay(array $data)
	{
		/* @var GuzzleHttp\Psr7\Response $response*/
		$response = $this->client->sendRequest($this->buildRequestUrl(), 'POST', $data);
		return ($response->getStatusCode() === 201 || $response->getStatusCode() === 200);
	}

	/**
	 * Update partner supply delay
	 *
	 * @param array $data
	 * @return Response
	 */
	public function putSupplyDelay(array $data)
	{
		/* @var GuzzleHttp\Psr7\Response $response*/
		$response = $this->client->sendRequest($this->buildRequestUrl(), 'PUT', $data);
		return ($response->getStatusCode() === 200);
	}

	/**
	 * Delete partner supply delay
	 *
	 * @return Response
	 */
	public function deleteSupplyDelay()
	{
		$response = $this->client->sendRequest($this->buildRequestUrl(), 'DELETE');
		return ($response->getStatusCode() === 404 || $response->getStatusCode() === 204);
	}

	/**
	 * Build request URL
	 *
	 * @return string
	 */
	private function buildRequestUrl()
	{
		return  self::ENDPOINT_PARTNERS . DIRECTORY_SEPARATOR . self::ENDPOINT_SUPPLY_DELAY;
	}
}
