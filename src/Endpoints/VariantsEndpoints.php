<?php
namespace MPAPI\Endpoints;

use GuzzleHttp\Psr7\Response;
use MPAPI\Services\Client;

/**
 * Products endpoints
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class VariantsEndpoints
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
	public function getVariants()
	{
		return $this->client->sendRequest(self::ENDPOINT_VARIANTS, 'GET');
	}

	/**
	 * Get variant detail
	 *
	 * @param string $productId
	 * @param string $variantId
	 * @return Response
	 */
	public function getDetail($productId, $variantId)
	{
		return $this->client->sendRequest(sprintf(self::ENDPOINT_VARIANTS, $productId) . "/" . $variantId, 'GET');
	}

	/**
	 * Delete variant
	 *
	 * @param string $productId
	 * @param string $variantId
	 * @return Response
	 */
	public function deleteVariant($productId, $variantId)
	{
		return $this->client->sendRequest(sprintf(self::ENDPOINT_VARIANTS, $productId) . "/" . $variantId, 'DELETE');
	}

	/**
	 * POST variant
	 *
	 * @param array $data
	 * @return Response
	 */
	public function postVariant(array $data)
	{
		return $this->client->sendRequest(self::ENDPOINT_VARIANTS, 'POST', $data);
	}

	/**
	 * Put variant
	 *
	 * @param string $productId
	 * @param array $data
	 * @return Response
	 */
	public function putVariant($productId, array $data)
	{
		return $this->client->sendRequest(sprintf(self::ENDPOINT_VARIANTS, $productId) . "/" . $data['id'], 'PUT', $data);
	}
}
