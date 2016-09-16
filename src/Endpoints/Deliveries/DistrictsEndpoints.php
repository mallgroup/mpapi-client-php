<?php
namespace MPAPI\Endpoints\Deliveries;

use MPAPI\Endpoints\AbstractEndpoints;
use MPAPI\Services\Client;
use MPAPI\Services\AbstractService;
use MPAPI\Lib\DataCollector;
use MPAPI\Entity\District;

/**
 *
 * @author Martin Drlik <martin.drlik@mall.cz>
 */
class DistrictsEndpoints extends AbstractEndpoints
{

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_PATH = 'deliveries/districts%s%s';

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
	 * @return null|array|District
	 */
	public function get()
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, null, null), Client::METHOD_GET);
		$dataCollector = new DataCollector($this->client, $response);
		return $dataCollector->getData();
	}
}
