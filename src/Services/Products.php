<?php
namespace MPAPI\Services;

use GuzzleHttp\Psr7\Response;
use MPAPI\Endpoints\ProductsEndpoints;
use MPAPI\Entity\Product;
use MPAPI\Entity\AbstractEntity;
use MPAPI\Exceptions\ApplicationException;

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
	 *
	 * @var Product[]
	 */
	private $entities = [];

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
	 *ů
	 * @param array $data
	 * @return Response
	 */
	public function post(array $data = [])
	{
		$errors = [];
		if (empty($data) && !empty($this->entities)) {
			foreach ($this->entities as $index => $productEntity) {
				$response = $this->productsEndpoints->postProduct($productEntity->getData());
				unset($this->entities[$index]);
				if ($response->getStatusCode() !== 201) {
					$errors[$index] = [
						'entity' => $productEntity->getData(),
						'response' => json_decode($response->getBody(), true)
					];
				}
			}
		} else {
			$response = $this->productsEndpoints->postProduct($data);
		}

		if (!empty($errors)) {
			$this->client->getLogger()->error('Error during post products', $errors);
			$exception = new ApplicationException();
			$exception->setData($errors);
			throw $exception;
		}

		return true;
	}

	/**
	 * Put data
	 *
	 * @param string $productId
	 * @param array $data
	 * @return Response
	 */
	public function put($productId = null, array $data = [])
	{
		$errors = [];
		if (empty($data) && !empty($this->entities)) {
			foreach ($this->entities as $index => $productEntity) {
				$response = $this->productsEndpoints->putProduct($productEntity->getId(), $productEntity->getData());
				unset($this->entities[$index]);
				if ($response->getStatusCode() !== 201) {
					$errors[$index] = [
						'entity' => $productEntity->getData(),
						'response' => json_decode($response->getBody(), true)
					];
				}
			}
		} else {
			$response = $this->productsEndpoints->putProduct($productId, $data);
		}

		if (!empty($errors)) {
			$this->client->getLogger()->error('Error during post products', $errors);
			$exception = new ApplicationException();
			$exception->setData($errors);
			throw $exception;
		}

		return true;
	}

	/**
	 * Add product for batch operation
	 *
	 * @see \MPAPI\Services\AbstractService::add()
	 */
	public function add(AbstractEntity $entity)
	{
		$this->entities[] = $entity;
		return $this;
	}
}
