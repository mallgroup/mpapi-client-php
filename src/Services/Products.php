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
	 * @return Response
	 */
	public function delete($productId = null)
	{
		$errors = [];
		if (empty($productId) && !empty($this->entities)) {
			foreach ($this->entities as $index => $productEntity) {
				$response = $this->productsEndpoints->deleteProduct($productEntity->getId());
				unset($this->entities[$index]);
				if ($response->getStatusCode() !== 200) {
					$errors[$index] = [
						'entity' => $productEntity->getData(),
						'response' => json_decode($response->getBody(), true)
					];
				}
			}
		} else {
			$response = $this->productsEndpoints->deleteProduct($productId);
			if ($response->getStatusCode() !== 200) {
				$errors[] = [
					'entity' => $productEntity->getData(),
					'response' => json_decode($response->getBody(), true)
				];
			}
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
	 * Post data
	 *
	 * @param array|Product $data
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
	public function put($productId = null, AbstractEntity $entity = null, $variantId = null)
	{
		if ($entity !== null) {
			list($endpoint, $method) = $this->getEndpoint($entity, __METHOD__);
		}

		$errors = [];
		if (empty($entity) && !empty($this->entities)) {
			foreach ($this->entities as $index => $productEntity) {
				$response = $this->productsEndpoints->putProduct($productEntity->getId(), $productEntity->getData());
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
	 * Get base class name
	 *
	 * @param object $object
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
		$baseClassName = $this->getClassBasename($entity);
		$endpointClass = sprintf(self::ENDPOINT_NAME_PATTERN, $baseClassName);
		$methodName = $this->getMethodBasename($method) . $baseClassName;
		if (!class_exists($endpointClass)) {
			throw new \Exception(sprintf('Endpoint %s not exist.', $baseClassName));
		}

		$endpoint = new $endpointClass($this->client);
		if (!method_exists($endpoint, $methodName)) {
			throw new \Exception(sprintf('Object %s does not contain method %s.', $baseClassName, $methodName));
		}
		return [
			$endpoint,
			$methodName
		];

	}
}
