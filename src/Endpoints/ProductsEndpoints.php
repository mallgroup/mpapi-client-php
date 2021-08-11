<?php
namespace MPAPI\Endpoints;

use GuzzleHttp\Psr7\Response;
use MPAPI\Entity\Paging;
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
	 * @var string
	 */
	const ENDPOINT_ACTIVATE = 'activate';

    /**
     * @var string
     */
    const ENDPOINT_AVAILABILITY = 'availability';

	/**
	 * @var Client
	 */
	private $client;

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
	 * @param int $page
	 * @param int $size
	 * @return Response
	 */
	public function getPaginated($page = 1, $size = 100)
	{
		$args = [
			'page' => (int)$page,
			'page_size' => (int)$size
		];
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
	 * Activate product
	 *
	 * @param $productId
	 *
	 * @return Response|null
	 *
	 * @throws \MPAPI\Exceptions\ClientIdException
	 * @throws \MPAPI\Exceptions\ForceTokenException
	 */
	public function activateProduct($productId)
	{
		return $this->client->sendRequest(self::ENDPOINT_PRODUCTS . "/" . $productId . "/" . self::ENDPOINT_ACTIVATE, 'POST');

	}

    /**
     * POST product
     *
     * @param array $data
     * @return Response
     */
    public function availabilityBatchProducts(array $data)
    {
        return $this->client->sendRequest(self::ENDPOINT_AVAILABILITY, 'POST', $data);
    }

	/**
	 * @return Paging
	 */
	public function getPaging()
	{
		return $this->client->getPaging();
	}
}
