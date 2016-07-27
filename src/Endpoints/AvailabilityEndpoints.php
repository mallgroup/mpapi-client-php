<?php
namespace MPAPI\Endpoints;

use GuzzleHttp\Psr7\Response;
use MPAPI\Services\Client;
use MPAPI\Entity\Availability;

/**
 * Availability endpoints
 *
 * @author Jonas Habr <jonas.habr@mall.cz>
 */
class AvailabilityEndpoints
{

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_PATH = 'products/%s/availability';

	const ENDPOINT_PATH_VARIANT = 'products/%s/variants/%s/availability';

	/**
	 *
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
	 * Put availability
	 *
	 * @param string $productId
	 * @param Availability $availability
	 * @param string $variantId
	 * @return Response
	 */
	public function putAvailability($productId, Availability $availability, $variantId = null)
	{
		if (variantId == null) {
			return $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, $productId), 'PUT', $availability->getData());
		} else {
			return $this->client->sendRequest(sprintf(self::ENDPOINT_PATH_VARIANT, $productId, $variantId), 'PUT', $availability->getData());
		}
	}
}
