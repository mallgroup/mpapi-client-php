<?php
namespace MPAPI\Services;

use GuzzleHttp\Psr7\Response;
use MPAPI\Endpoints\ProductsEndpoints;
use MPAPI\Endpoints\VariantsEndpoints;
use MPAPI\Endpoints\Products\SupplyDelayEndpoints;
use MPAPI\Entity\Products\BasicProductIterator;
use MPAPI\Entity\Products\Product;
use MPAPI\Entity\AbstractEntity;
use MPAPI\Exceptions\ApplicationException;
use MPAPI\Exceptions\EndpointNotfoundException;
use MPAPI\Exceptions\EndpointNotContainMethod;
use MPAPI\Lib\DataCollector;

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
	 * @var ProductsEndpoints
	 */
	private $productsEndpoints;

	/**
	 *
	 * @var Product[]
	 */
	protected $entities = [];

	/**
	 *
	 * @var array
	 */
	private $requestHash = [];

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
	 * @return Product|BasicProductIterator|array|null
	 */
	public function get($productId = null)
	{
		$retval = null;
		if (is_null($productId)) {
			$response = $this->productsEndpoints->getProducts();
			// collect data from response
			$dataCollector = new DataCollector($this->client, $response, false);
			switch ($this->getFilter()) {
				case self::FILTER_TYPE_BASIC:
					$retval = new BasicProductIterator($dataCollector->getData());
				break;
				default:
					$retval = $dataCollector->setDataSection('ids')->getData();
			}
		} else {
			$response = $this->productsEndpoints->getDetail($productId);
			$responseData = json_decode($response->getBody(), true);
			if (isset($responseData['data'])) {
				$retval = new Product($responseData['data']);
			}
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
	 * @return boolean
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
			if (json_decode($response->getBody(), true) == null || $response->getStatusCode() !== 201) {
				$errors[] = [
					'entity' => $data,
					'response' => (string) $response->getBody()
				];
			} elseif (
				$response->getStatusCode() == 202
				&& $this->client->getArgument(self::ASYNCHRONOUS_PARAMETER) === true
			) {
				$response = json_decode($response->getBody(), true);
				$this->requestHash[] = $response['data']['hash'];
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
	 * @return boolean
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
				} elseif (
					$response->getStatusCode() == 202
					&& $this->client->getArgument(self::ASYNCHRONOUS_PARAMETER) === true
				) {
					$response = json_decode($response->getBody(), true);
					$this->requestHash[] = $response['data']['hash'];
				}
			}
		} else {
			$response = $endpoint->$method($productId, $entity->getData(), $variantId);
			if ($response->getStatusCode() !== 200) {
				$errors[$index] = [
					'entity' => $entity->getData(),
					'response' => json_decode($response->getBody(), true)
				];
			} elseif (
					$response->getStatusCode() == 202
					&& $this->client->getArgument(self::ASYNCHRONOUS_PARAMETER) === true
			) {
				$response = json_decode($response->getBody(), true);
				$this->requestHash[] = $response['data']['hash'];
			}
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
	 * Get list of asynchronous request identification hash
	 *
	 * @return array
	 */
	public function getRequestHash()
	{
		return $this->requestHash;
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
