<?php
namespace MPAPI\Endpoints\Deliveries;

use MPAPI\Endpoints\AbstractEndpoints;
use MPAPI\Services\Client;
use MPAPI\Services\AbstractService;
use MPAPI\Lib\DataCollector;
use MPAPI\Entity\AbstractDelivery;
use MPAPI\Entity\PartnerPickupPoint;

/**
 *
 * @author Martin Drlik <martin.drlik@mall.cz>
 */
class PartnerPickupPointsEndpoints extends AbstractEndpoints
{

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_PATH = 'deliveries/partner/pickup-points%s%s';

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
	 * @param AbstractDelivery $pickupPointEntity
	 * @return boolean
	 */
	public function post(AbstractDelivery $pickupPointEntity = null)
	{
		$entitiesQueue = $this->service->getEntities();

		if (!empty($entitiesQueue)) {
			foreach ($entitiesQueue as $entity) {
				if ($entity instanceof AbstractDelivery) {
					$this->postPickupPoint($entity);
				}
			}
		} else {
			$this->postPickupPoint($pickupPointEntity);
		}

		return empty($this->getErrors());
	}

	/**
	 * Get all the endpoints that use PUT
	 *
	 * @param AbstractDelivery $pickupPointEntity
	 * @return boolean
	 */
	public function put(AbstractDelivery $pickupPointEntity = null)
	{
		$entitiesQueue = $this->service->getEntities();

		if (!empty($entitiesQueue)) {
			foreach ($entitiesQueue as $entity) {
				if ($entity instanceof AbstractDelivery) {
					$this->putPickupPoint($entity);
				}
			}
		} else {
			$this->putPickupPoint($pickupPointEntity);
		}

		return empty($this->getErrors());
	}

	/**
	 * Get all the endpoints that use DELETE
	 *
	 * @param AbstractDelivery $pickupPointEntity
	 * @return boolean
	 */
	public function delete(AbstractDelivery $pickupPointEntity = null)
	{
		$entitiesQueue = $this->service->getEntities();

		if (!empty($entitiesQueue)) {
			// batch delete of pickup points
			foreach ($entitiesQueue as $entity) {
				if ($entity instanceof AbstractDelivery) {
					$this->deletePickupPoint($entity);
				}
			}
		} elseif ($pickupPointEntity instanceof AbstractDelivery) {
			// delete one pickup point
			$this->deletePickupPoint($pickupPointEntity);
		} else {
			// delete all pickup points
			$this->deletePickupPoint();
		}

		return empty($this->getErrors());
	}

	/**
	 * Get list of pickup points
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
	 * Get detail of pickup point
	 *
	 * @param string $code
	 * @return null|\MPAPI\Entity\PickupPoint
	 */
	private function getDetail($code)
	{
		$retval = null;
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, self::PATH_DELIMITER, $code), Client::METHOD_GET);
		$responseData = json_decode($response->getBody(), true);
		if (isset($responseData['data']) && !empty($responseData['data'])) {
			$retval = new PickupPoint($responseData['data']);
		}
		return $retval;
	}

	/**
	 * Post pickup point to API
	 *
	 * @param AbstractDelivery $entity
	 * @return boolean
	 */
	private function postPickupPoint(AbstractDelivery $entity)
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, null, null), Client::METHOD_POST, $entity->getData());
		if ($response->getStatusCode() !== 201 && $response->getStatusCode() !== 200) {
			$this->addError($entity->getCode(), json_decode($response->getBody(), true));
		}
		return true;
	}

	/**
	 * Put pickup point to API
	 *
	 * @param AbstractDelivery $data
	 * @return boolean
	 */
	private function putPickupPoint(AbstractDelivery $entity)
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, self::PATH_DELIMITER, $entity->getCode()), Client::METHOD_PUT, $entity->getData());
		if ($response->getStatusCode() !== 200) {
			$this->addError($entity->getCode(), json_decode($response->getBody(), true));
		}
		return true;
	}

	/**
	 * Delete pickup point by API
	 *
	 * @param AbstractDelivery $data
	 * @return boolean
	 */
	private function deletePickupPoint(AbstractDelivery $entity = null)
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
