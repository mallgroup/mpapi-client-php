<?php
namespace MPAPI\Services;

use GuzzleHttp\Psr7\Response;
use MPAPI\Endpoints\ProductsEndpoints;
use MPAPI\Endpoints\VariantsEndpoints;
use MPAPI\Endpoints\Products\SupplyDelayEndpoints;
use MPAPI\Entity\Product;
use MPAPI\Entity\AbstractEntity;
use MPAPI\Exceptions\ApplicationException;
use MPAPI\Exceptions\EndpointNotfoundException;
use MPAPI\Exceptions\EndpointNotContainMethod;

/**
 * Products service
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class Products extends AbstractService
{

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_NAME_PATTERN = 'MPAPI\Endpoints\%sEndpoints';

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
	protected $entities = [];

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
	 * @return Product|array|null
	 */
	public function get($productId = null)
	{
		$retval = null;
		if (is_null($productId)) {
			$response = $this->productsEndpoints->getProducts();
			$retval = json_decode($response->getBody(), true)['data'];
		} else {
			$response = $this->productsEndpoints->getDetail($productId);
			$retval = new Product(json_decode($response->getBody(), true)['data']);
		}

		return $retval;
	}

	/**
	 * Delete data
	 *
	 * @param string $productId
	 * @throws ApplicationException
	 * @return boolean
	 */
	public function delete($productId = null)
	{
		$errors = [];
		if (empty($productId) && !empty($this->entities)) {
			foreach ($this->entities as $index => $productEntity) {
				$response = $this->productsEndpoints->deleteProduct($productEntity->getId());
				unset($this->entities[$index]);
				if ($response->getStatusCode() !== 204) {
					$errors[$index] = [
						'entity' => $productEntity->getData(),
						'response' => json_decode($response->getBody(), true)
					];
				}
			}
		} else {
			$response = $this->productsEndpoints->deleteProduct($productId);
			if ($response->getStatusCode() !== 204) {
				$errors[] = [
					'response' => json_decode($response->getBody(), true)
				];
			}
		}

		if (!empty($errors)) {
			$this->client->getLogger()->error('Failed to delete products', $errors);
			$exception = new ApplicationException();
			$exception->setData($errors);
			throw $exception;
		}

		return true;
	}

	/**
	 * Post data
	 *
	 * @param array|Product $data
	 * @throws ApplicationException
	 * @return Response
	 */
	public function post($data = null)
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
			if ($data instanceof Product) {
				$data = $data->getData();
			}
			$response = $this->productsEndpoints->postProduct($data);
			if (json_decode($response->getBody(), true) == null) {
				$errors[] = (string) $response->getBody();
			}
		}

		if (!empty($errors)) {
			$this->client->getLogger()->error('Failed to post products', $errors);
			$exception = new ApplicationException('Failed to post products: ' . implode(', ', $errors));
			throw $exception;
		}

		return true;
	}

	/**
	 * Put data
	 *
	 * @param string $productId
	 * @param AbstractEntity $entity
	 * @param string $variantId
	 * @throws ApplicationException
	 * @return Response
	 */
	public function put($productId = null, AbstractEntity $entity = null, $variantId = null)
	{
		if ($entity !== null) {
			list ($endpoint, $method) = $this->getEndpoint($entity, __METHOD__);
		}

		$errors = [];
		if (empty($entity) && !empty($this->entities)) {
			foreach ($this->entities as $index => $productEntity) {
				list ($endpoint, $method) = $this->getEndpoint($productEntity, __METHOD__);
				$response = $endpoint->$method($productEntity->getId(), $productEntity->getData());
				unset($this->entities[$index]);
				if ($response->getStatusCode() !== 200) {
					$errors[$index] = [
						'entity' => $productEntity->getData(),
						'response' => json_decode($response->getBody(), true)
					];
				}
			}
		} else {
			$response = $endpoint->$method($productId, $entity->getData(), $variantId);
		}

		if (!empty($errors)) {
			$this->client->getLogger()->error('Failed to update products', $errors);
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

	/**
	 * Get variants endpoints
	 *
	 * @return VariantsEndpoints
	 */
	public function variants()
	{
		return new VariantsEndpoints($this->client, $this);
	}

	/**
	 * Get endpoint for supply delay
	 *
	 * @param string $productId
	 * @return MPAPI\Endpoints\Products\SupplayDelayEndpoints
	 */
	public function supplyDelay($productId)
	{
		return new SupplyDelayEndpoints($this->client, $productId);
	}

	/**
	 * Get base class name
	 *
	 * @param object $object
	 * @return string
	 */
	private function getClassBasename($object)
	{
		$className = get_class($object);
		return (substr($className, strrpos($className, '\\') + 1));
	}

	/**
	 * Get base method name
	 *
	 * @param string $methodName
	 * @return string
	 */
	private function getMethodBasename($methodName)
	{
		return (substr($methodName, strrpos($methodName, ':') + 1));
	}

	/**
	 * Get endpoint for specific entity
	 *
	 * @param AbstractEntity $entity
	 * @throws \Exception
	 * @return Object
	 */
	private function getEndpoint(AbstractEntity $entity, $method)
	{
		$classBasename = $this->getClassBasename($entity);
		$endpointClass = sprintf(self::ENDPOINT_NAME_PATTERN, $classBasename);
		$methodName = $this->getMethodBasename($method) . $classBasename;
		if (!class_exists($endpointClass)) {
			throw new EndpointNotfoundException($classBasename);
		}

		$endpoint = new $endpointClass($this->client);
		if (!method_exists($endpoint, $methodName)) {
			throw new EndpointNotContainMethod($classBasename, $methodName);
		}
		return [
			$endpoint,
			$methodName
		];
	}
}
