<?php
namespace MPAPI\Endpoints\Variants;

use GuzzleHttp\Psr7\Response;
use MPAPI\Services\Client;
use MPAPI\Entity\Variant;

/**
 * Variants GET endpoints
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class VariantsGetEndpoints
{
	/**
	 * @var string
	 */
	const ENDPOINT_VARIANTS = 'products/%s/variants';

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
	 * Get list of all variants.
	 *
	 * @return Response
	 */
	public function variantsList($productId)
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_VARIANTS, $productId), 'GET');
		return json_decode($response->getBody(), true)['data'];
	}

	/**
	 * Get variant detail
	 *
	 * @param string $productId
	 * @param string $variantId
	 * @return Response
	 */
	public function detail($productId, $variantId)
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_VARIANTS, $productId) . "/" . $variantId, 'GET');
		return new Variant(json_decode($response->getBody(), true)['data']);
	}
}
