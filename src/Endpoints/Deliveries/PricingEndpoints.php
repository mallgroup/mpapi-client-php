<?php
namespace MPAPI\Endpoints\Deliveries;

use MPAPI\Endpoints\AbstractEndpoints;
use MPAPI\Services\AbstractService;
use MPAPI\Services\Client;


/**
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class PricingEndpoints extends AbstractEndpoints
{

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_PATH = 'deliveries/partner/%s/pricing';

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
	 * Get all pricing levels
	 *
	 * @param string $deliveryCode
	 * @return array
	 */
	public function get($deliveryCode)
	{
		$retval = [];
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, $deliveryCode), Client::METHOD_GET);
		$responseData = json_decode($response->getBody(), true);
		if (!empty($responseData) && isset($responseData['data'])) {
			$retval = $responseData['data'];
		}
		return $retval;
	}

	/**
	 * Create or update pricings
	 *
	 * @param string $deliveryCode
	 * @param MPAPI\Endpoints\Deliveries\PricingsEntity $entity
	 * @return boolean
	 */
	public function post($deliveryCode, PricingsEntity $entity)
	{
		/* @var GuzzleHttp\Psr7\Response $response*/
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, $deliveryCode), Client::METHOD_PUT, $entity->getData());
		if ($response->getStatusCode() !== 200) {
			$this->addError($deliveryCode, json_decode($response->getBody(), true));
		}
		return true;
	}

	/**
	 * Delete delivery pricings
	 *
	 * @param string $deliveryCode
	 * @return boolean
	 */
	public function delete($deliveryCode)
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, $deliveryCode), Client::METHOD_DELETE);
		if ($response->getStatusCode() !== 204) {
			$this->addError($deliveryCode, json_decode($response->getBody(), true));
		}
		return true;
	}
}
