<?php
namespace MPAPI\Services;

use GuzzleHttp\Psr7\Response;
use MPAPI\Endpoints\ProductsEndpoints;

/**
 * Marketplace API client
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class Products extends AbstractService
{
	/**
	 *
	 * @var Client
	 */
	private $client;

	/**
	 *
	 * @var ProductsEndpoints
	 */
	private $productsEndpoints;

	/**
	 * Labels constructor.
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
		$this->productsEndpoints = new ProductsEndpoints($this->client);
	}

	/**
	 * Get Data
	 *
	 * @param integer $productId
	 * @return Response
	 */
	public function get($productId = null)
	{
		if (is_null($productId)) {
			$response = $this->productsEndpoints->getProducts();
		} else {
			$response = $this->productsEndpoints->getDetail($productId);
		}
		return json_decode($response->getBody(), true)['data'];
	}

	/**
	 * Delete data
	 *
	 * @param integer $productId
	 */
	public function delete($productId = null)
	{
		$response = $this->productsEndpoints->deleteProduct($productId);
		return json_decode($response->getBody(), true);
	}

	/**
	 * Post data
	 *
	 * @param array $data
	 * @return Response
	 */
	public function post(array $data = [])
	{
		$response = $this->productsEndpoints->postProduct($data);
		return json_decode($response->getBody(), true);
	}

	/**
	 * Put data
	 *
	 * @param array $data
	 * @return Response
	 */
	public function put(array $data = [])
	{
		$response = $this->productsEndpoints->putProduct($data);
		return json_decode($response->getBody(), true);
	}
}
