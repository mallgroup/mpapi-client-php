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
	 *
	 * @var string
	 */
	const PARAMETER_FILTER = 'filter';

	/**
	 *
	 * @var string
	 */
	const FILTER_TYPE_IDS = 'ids';

	/**
	 *
	 * @var string
	 */
	const FILTER_TYPE_BASIC = 'basic';

	/**
	 * @var Client
	 */
	private $client;

	/**
	 *
	 * @var array
	 */
	private $filterType = [
		self::FILTER_TYPE_IDS,
		self::FILTER_TYPE_BASIC
	];

	/**
	 *
	 * @var string
	 */
	private $filter;

	/**
	 *
	 * @param Client $client
	 */
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
		$args = [];
		if (!empty($this->filter)) {
			$args[self::PARAMETER_FILTER] = $this->filter;
		}
		return $this->client->sendRequest(self::ENDPOINT_PRODUCTS, 'GET', $args);
	}

	/**
	 * Get product detail
	 *
	 * @param string $productId
	 * @return Response
	 */
	public function getDetail($productId)
	{
		return $this->client->sendRequest(self::ENDPOINT_PRODUCTS . "/" . $productId, 'GET');
	}

	/**
	 * Delete product
	 *
	 * @param string $productId
	 * @return Response
	 */
	public function deleteProduct($productId)
	{
		return $this->client->sendRequest(self::ENDPOINT_PRODUCTS . "/" . $productId, 'DELETE');
	}

	/**
	 * POST product
	 *
	 * @param array $data
	 * @return Response
	 */
	public function postProduct(array $data)
	{
		return $this->client->sendRequest(self::ENDPOINT_PRODUCTS, 'POST', $data);
	}

	/**
	 * Put product
	 *
	 * @param string $productId
	 * @param array $data
	 * @return Response
	 */
	public function putProduct($productId, array $data)
	{
		return $this->client->sendRequest(self::ENDPOINT_PRODUCTS . "/" . $productId, 'PUT', $data);
	}

	/**
	 * Set filter
	 *
	 * @param string $filterType
	 * @return ProductsEndpoints
	 */
	public function setFilter($filterType)
	{
		if (in_array($filterType, $this->filterType) && $filterType !== $this->filter) {
			$this->filter = $filterType;
		}
		return $this;
	}
}
