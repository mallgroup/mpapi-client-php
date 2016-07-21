<?php
namespace MPAPI\Endpoints;

use GuzzleHttp\Psr7\Response;
use MPAPI\Services\Client;

/**
 * Products endpoints
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class ProductsEndpoints
{
	/**
	 * @var string
	 */
	const ENDPOINT_PRODUCTS = 'products';

	/**
	 * @var Client
	 */
	private $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * Get list of all products.
	 *
	 * @return Response
	 */
	public function getProducts()
	{
		return $this->client->sendRequest(self::ENDPOINT_PRODUCTS, 'GET');
	}

	/**
	 * Get product detail
	 *
	 * @param integer $productId
	 * @return Response
	 */
	public function getDetail($productId)
	{
		return $this->client->sendRequest(self::ENDPOINT_PRODUCTS . "/" . $productId, 'GET');
	}

	/**
	 * Delete product
	 *
	 * @param $productId
	 * @return Response
	 */
	public function deleteProduct($productId)
	{
		return $this->client->sendRequest(self::ENDPOINT_PRODUCTS . "/" . $productId, 'DELETE');
	}
}
