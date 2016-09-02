<?php
namespace MPAPI\Endpoints\Deliveries;

use MPAPI\Endpoints\AbstractEndpoints;
use MPAPI\Services\Client;
use MPAPI\Services\AbstractService;
use MPAPI\Lib\DataCollector;
use MPAPI\Entity\PartnerDelivery;

/**
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
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
	 * @param $code null
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
	 * @return PartnerPostEndpoints
	 */
	public function post()
	{
		return new PartnerPostEndpoints($this->client, $this->service);
	}

	/**
	 * Get all the endpoints that use PUT
	 *
	 * @return PartnerPutEndpoints
	 */
	public function put()
	{
		return new PartnerPutEndpoints($this->client, $this->service);
	}

	/**
	 * Get all the endpoints that use DELETE
	 *
	 * @return PartnerDeleteEndpoints
	 */
	public function delete()
	{
		return new PartnerDeleteEndpoints($this->client, $this->service);
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
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, '/', $code), Client::METHOD_GET);
		$responseData = json_decode($response->getBody(), true);
		if (isset($responseData['data']) && !empty($responseData['data'])) {
			$retval = new PartnerDelivery($responseData['data']);
		}
		return $retval;
	}
}
