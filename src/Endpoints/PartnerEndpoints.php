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
	const ENDPOINT_SUPPLY_DELAY = '%s/supply-delay';

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
		return $this->client->sendRequest(sprintf(self::ENDPOINT_SUPPLY_DELAY, self::ENDPOINT_PARTNERS), 'GET');
	}

	/**
	 * Create partner supply delay
	 *
	 * @param array $data
	 * @return Response
	 */
	public function postSupplyDelay(array $data)
	{
		return $this->client->sendRequest(sprintf(self::ENDPOINT_SUPPLY_DELAY, self::ENDPOINT_PARTNERS), 'POST', $data);
	}

	/**
	 * Update partner supply delay
	 *
	 * @param array $data
	 * @return Response
	 */
	public function putSupplyDelay(array $data)
	{
		return $this->client->sendRequest(sprintf(self::ENDPOINT_SUPPLY_DELAY, self::ENDPOINT_PARTNERS), 'PUT', $data);
	}

	/**
	 * Delete partner supply delay
	 *
	 * @return Response
	 */
	public function deleteSupplyDelay()
	{
		return $this->client->sendRequest(sprintf(self::ENDPOINT_SUPPLY_DELAY, self::ENDPOINT_PARTNERS), 'DELETE');
	}
}
