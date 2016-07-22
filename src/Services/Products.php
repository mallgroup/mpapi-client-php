<?php
namespace MPAPI\Services;

use GuzzleHttp\Psr7\Response;
use MPAPI\Endpoints\ProductsEndpoints;

/**
 * Products service
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
	 * Products constructor.
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
		$this->productsEndpoints = new ProductsEndpoints($this->client);
	}

	/**
	 * Get data
	 *
	 * @param string $productId
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
	 * @param string $productId
	 * @return Response
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
		return !is_null($response)? json_decode($response->getBody(), true) : null;
	}
}
