<?php
namespace MPAPI\Endpoints\Deliveries;

use MPAPI\Endpoints\AbstractEndpoints;
use MPAPI\Services\Client;
use MPAPI\Entity\PartnerDelivery;

/**
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class PartnerGetEndpoints extends AbstractEndpoints
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
		$retval = [];
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, null, null), Client::METHOD_GET);
		$responseData = json_decode($response->getBody(), true);
		if (isset($responseData['data']['ids'])) {
			$retval = $responseData['data']['ids'];
		}
		return $retval;
	}

	/**
	 * Get detail for specific delivery code
	 *
	 * @param string $code
	 * @return PartnerDelivery|null
	 */
	public function detail($code)
	{
		$retval = null;
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, '/', $code), Client::METHOD_GET);
		$responseData = json_decode($response->getBody(), true);

		if (isset($responseData['data'])) {
			$retval = new PartnerDelivery($responseData['data']);
		}
		return $retval;
	}
}
