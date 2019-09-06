<?php

namespace MPAPI\Endpoints;

use MPAPI\Entity\Pricing;
use MPAPI\Services\Client;

/**
 * Class PricingEndpoints
 *
 * @package MPAPI\Endpoints
 * @author  Michal Saloň <michal.salon@mallgroup.com>
 */
class PricingEndpoints
{
	/** @var string */
	const ENDPOINT_PATH = 'products/%s/pricing';

	/** @var string */
	const ENDPOINT_PATH_VARIANT = 'products/%s/variants/%s/pricing';

	/** @var Client */
	private $client;

	/**
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * @param string      $productId
	 * @param array       $data result of Pricing->getData()
	 * @param string|null $variantId
	 *
	 * @return \GuzzleHttp\Psr7\Response|null
	 * @throws \MPAPI\Exceptions\ClientIdException
	 * @throws \MPAPI\Exceptions\ForceTokenException
	 */
	public function putPricing($productId, array $data, $variantId = null)
	{
		if ($variantId == null) {
			return $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, $productId), 'PUT', $data);
		} else {
			return $this->client->sendRequest(sprintf(self::ENDPOINT_PATH_VARIANT, $productId, $variantId), 'PUT', $data);
		}
	}
}
