<?php
namespace MPAPI\Endpoints\Deliveries;

use MPAPI\Endpoints\AbstractEndpoints;
use MPAPI\Services\Client;
use MPAPI\Services\AbstractService;
use MPAPI\Lib\DataCollector;
use MPAPI\Entity\District;

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
	 * @return null|array
	 */
	public function get($deliveryCode)
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, $deliveryCode), Client::METHOD_GET);
		return $response->getData();
	}

	/**
	 * Create or update pricings
	 *
	 * @param string $deliveryCode
	 * @param \MPAPI\Endpoints\Deliveries\PricingsEntity $entity
	 * @return array
	 */
	public function put($deliveryCode, PricingsEntity $entity)
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, $deliveryCode), Client::METHOD_PUT, $entity->getData());
		return $response->getData();
	}
}
