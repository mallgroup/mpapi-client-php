<?php
namespace MPAPI\Endpoints\Deliveries;

use MPAPI\Endpoints\AbstractEndpoints;
use MPAPI\Services\Client;
use MPAPI\Services\AbstractService;
use MPAPI\Lib\DataCollector;
use MPAPI\Entity\PartnerDelivery;
use MPAPI\Entity\AbstractDelivery;

/**
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class PartnerEndpoints extends AbstractEndpoints
{

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_PATH = 'deliveries/partner%s%s';

	/**
	 *
	 * @var string
	 */
	const PATH_DELIMITER = '/';

	/**
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 *
	 * @var AbstractService
	 */
	protected $service;

	/**
	 *
	 * @var array
	 */
	protected $errors;

	/**
	 *
	 * @param Client $client
	 * @param AbstractService $service
	 */
	public function __construct(Client $client, AbstractService $service)
	{
		parent::__construct($client);
		$this->service = $service;
	}

	/**
	 * Get all the endpoints that use GET
	 *
	 * @param string $code null
	 * @return null|array|PartnerDelivery
	 */
	public function get($code = null)
	{
		$retval = null;
		if (empty($code)) {
			$retval = $this->getList();
		} else {
			$retval = $this->getDetail($code);
		}
		return $retval;
	}

	/**
	 * Get all the endpoints that use POST
	 *
	 * @param AbstractDelivery $deliveryEntity
	 * @return boolean
	 */
	public function post(AbstractDelivery $deliveryEntity = null)
	{
		$entitiesQueue = $this->service->getEntities();

		if (!empty($entitiesQueue)) {
			foreach ($entitiesQueue as $entity) {
				if ($entity instanceof AbstractDelivery) {
					$this->postDelivery($entity);
				}
			}
		} else {
			$this->postDelivery($deliveryEntity);
		}

		return empty($this->getErrors());
	}

	/**
	 * Get all the endpoints that use PUT
	 *
	 * @param AbstractDelivery $deliveryEntity
	 * @return boolean
	 */
	public function put(AbstractDelivery $deliveryEntity = null)
	{
		$entitiesQueue = $this->service->getEntities();

		if (!empty($entitiesQueue)) {
			foreach ($entitiesQueue as $entity) {
				if ($entity instanceof AbstractDelivery) {
					$this->putDelivery($entity);
				}
			}
		} else {
			$this->putDelivery($deliveryEntity);
		}

		return empty($this->getErrors());
	}

	/**
	 * Get all the endpoints that use DELETE
	 *
	 * @param AbstractDelivery $deliveryEntity
	 * @return boolean
	 */
	public function delete(AbstractDelivery $deliveryEntity = null)
	{
		$entitiesQueue = $this->service->getEntities();

		if (!empty($entitiesQueue)) {
			// batch delete of delivery
			foreach ($entitiesQueue as $entity) {
				if ($entity instanceof AbstractDelivery) {
					$this->deleteDelivery($entity);
				}
			}
		} elseif ($deliveryEntity instanceof  AbstractDelivery) {
			// delete one delivery
			$this->deleteDelivery($deliveryEntity);
		} else {
			// delete all partner deliveries
			$this->deleteDelivery();
		}

		return empty($this->getErrors());
	}

	/**
	 * Get list of partner deliveries
	 *
	 * @return array
	 */
	private function getList()
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, null, null), Client::METHOD_GET);
		$dataCollector = new DataCollector($this->client, $response);
		return $dataCollector->getData();
	}

	/**
	 * Get detail of partner delivery
	 *
	 * @param string $code
	 * @return null|\MPAPI\Endpoints\Deliveries\PartnerDelivery
	 */
	private function getDetail($code)
	{
		$retval = null;
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, self::PATH_DELIMITER, $code), Client::METHOD_GET);
		$responseData = json_decode($response->getBody(), true);
		if (isset($responseData['data']) && !empty($responseData['data'])) {
			$retval = new PartnerDelivery($responseData['data']);
		}
		return $retval;
	}

	/**
	 * Post delivery to API
	 *
	 * @param AbstractDelivery $entity
	 * @return boolean
	 */
	private function postDelivery(AbstractDelivery $entity)
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, null, null), Client::METHOD_POST, $entity->getData());
		if ($response->getStatusCode() !== 201 || $response->getStatusCode() !== 200) {
			$this->addError($entity->getCode(), json_decode($response->getBody(), true));
		}
		return true;
	}

	/**
	 * Put delivery to API
	 *
	 * @param AbstractDelivery $data
	 * @return boolean
	 */
	private function putDelivery(AbstractDelivery $entity)
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, self::PATH_DELIMITER, $entity->getCode()), Client::METHOD_PUT, $entity->getData());
		if ($response->getStatusCode() !== 200) {
			$this->addError($entity->getCode(), json_decode($response->getBody(), true));
		}
		return true;
	}

	/**
	 * Delete delivery by API
	 *
	 * @param AbstractDelivery $data
	 * @return boolean
	 */
	private function deleteDelivery(AbstractDelivery $entity = null)
	{
		$code = null;
		$delimiter = null;
		if ($entity instanceof AbstractDelivery) {
			$code = $entity->getCode();
			$delimiter = self::PATH_DELIMITER;
		}
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, $delimiter, $code), Client::METHOD_DELETE);
		if ($response->getStatusCode() !== 200) {
			$this->addError($entity->getCode(), json_decode($response->getBody(), true));
		}
		return true;
	}
}
