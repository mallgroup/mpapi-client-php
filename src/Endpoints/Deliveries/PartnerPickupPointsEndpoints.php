<?php
namespace MPAPI\Endpoints\Deliveries;

use MPAPI\Endpoints\AbstractEndpoints;
use MPAPI\Services\Client;
use MPAPI\Services\AbstractService;
use MPAPI\Lib\DataCollector;
use MPAPI\Entity\PickupPoint;

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
	const ENDPOINT_PATH = 'deliveries/partner/%s/pickup-points%s%s';

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
	 * @var string
	 */
	private $deliveryCode;

	/**
	 *
	 * @param Client $client
	 * @param AbstractService $service
	 */
	public function __construct(Client $client, AbstractService $service, $deliveryCode)
	{
		parent::__construct($client);
		$this->service = $service;
		$this->deliveryCode = $deliveryCode;
	}

	/**
	 * Get all the endpoints that use GET
	 *
	 * @param string $code null
	 * @return null|array|PartnerPickupPoint
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
	 * Create pickup points
	 *
	 * @param PickupPoint $pickupPointEntity
	 * @return boolean
	 */
	public function create(PickupPoint $pickupPointEntity = null)
	{
		$entitiesQueue = $this->service->getEntities();

		if (!empty($entitiesQueue)) {
			foreach ($entitiesQueue as $entity) {
				if ($entity instanceof PickupPoint) {
					$this->postPickupPoint($entity);
				}
			}
		} else {
			$this->postPickupPoint($pickupPointEntity);
		}

		return empty($this->getErrors());
	}

	/**
	 * Update pickup points
	 *
	 * @param PickupPoint $pickupPointEntity
	 * @return boolean
	 */
	public function update(PickupPoint $pickupPointEntity = null)
	{
		$entitiesQueue = $this->service->getEntities();

		if (!empty($entitiesQueue)) {
			foreach ($entitiesQueue as $entity) {
				if ($entity instanceof PickupPoint) {
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
	 * @param PickupPoint $pickupPointEntity
	 * @return boolean
	 */
	public function delete(PickupPoint $pickupPointEntity = null)
	{
		$entitiesQueue = $this->service->getEntities();

		if (!empty($entitiesQueue)) {
			// batch delete of pickup points
			foreach ($entitiesQueue as $entity) {
				if ($entity instanceof PickupPoint) {
					$this->deletePickupPoint($entity);
				}
			}
		} elseif ($pickupPointEntity instanceof PickupPoint) {
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
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, $this->deliveryCode, null, null), Client::METHOD_GET);
		$dataCollector = new DataCollector($this->client, $response);
		$data = $dataCollector->getData();
		return $data['ids'];
	}

	/**
	 * Get detail of pickup point
	 *
	 * @param string $code
	 * @return null|\MPAPI\Entity\PartnerPickupPoint
	 */
	private function getDetail($code)
	{
		$retval = null;
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, $this->deliveryCode, self::PATH_DELIMITER, $code), Client::METHOD_GET);
		$responseData = json_decode($response->getBody(), true);
		if (isset($responseData['data']) && !empty($responseData['data'])) {
			$retval = new PickupPoint($responseData['data']);
		}
		return $retval;
	}

	/**
	 * Post pickup point to API
	 *
	 * @param PickupPoint $entity
	 * @return boolean
	 */
	private function postPickupPoint(PickupPoint $entity)
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, $this->deliveryCode, null, null), Client::METHOD_POST, $entity->getData());
		if ($response->getStatusCode() !== 201 && $response->getStatusCode() !== 200) {
			$this->addError($entity->getCode(), json_decode($response->getBody(), true));
		}
		return true;
	}

	/**
	 * Put pickup point to API
	 *
	 * @param PickupPoint $data
	 * @return boolean
	 */
	private function putPickupPoint(PickupPoint $entity)
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, $this->deliveryCode, self::PATH_DELIMITER, $entity->getCode()), Client::METHOD_PUT, $entity->getData());
		if ($response->getStatusCode() !== 200) {
			$this->addError($entity->getCode(), json_decode($response->getBody(), true));
		}
		return true;
	}

	/**
	 * Delete pickup point by API
	 *
	 * @param PickupPoint $data
	 * @return boolean
	 */
	private function deletePickupPoint(PickupPoint $entity = null)
	{
		$code = null;
		$delimiter = null;
		if ($entity instanceof PickupPoint) {
			$code = $entity->getCode();
			$delimiter = self::PATH_DELIMITER;
		}
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, $this->deliveryCode, $delimiter, $code), Client::METHOD_DELETE);
		if ($response->getStatusCode() !== 204) {
			$this->addError($entity->getCode(), json_decode($response->getBody(), true));
		}
		return true;
	}
}
