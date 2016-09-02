<?php
namespace MPAPI\Endpoints\Deliveries;

use MPAPI\Services\Client;
use MPAPI\Lib\DataCollector;
use MPAPI\Entity\PartnerDelivery;

/**
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class PartnerGetEndpoints extends AbstractDeliveriesEndpoints
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
	 * Get list of deliveries
	 *
	 * @return array
	 */
	public function deliveries()
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, null, null), Client::METHOD_GET);
		$dataCollector = new DataCollector($this->client, $response);
		return $dataCollector->getData();
	}

	/**
	 * Get partner delivery detail
	 *
	 * @param string $code
	 * @return PartnerDelivery|null
	 */
	public function detail($code)
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
