<?php
/**
 * Created by PhpStorm.
 * User: mhrdlicka
 * Date: 1.9.2016
 * Time: 14:20
 */

namespace MPAPI\Endpoints\Deliveries;

use MPAPI\Entity\PartnerDelivery;
use MPAPI\Lib\DataCollector;

/**
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class PartnerGetEndpoints extends AbstractDeliveriesEndpoints
{
	/**
	 * Get partner deliveries
	 *
	 * @return array
	 */
	public function deliveries()
	{
		$response = $this->client->sendRequest(self::ENDPOINT_PATH, 'GET');
		$dataCollector = new DataCollector($this->client, $response);
		return $dataCollector->getData();
	}

	/**
	 * Get partner delivery detail
	 *
	 * @param string $code
	 * @return array|PartnerDelivery
	 */
	public function detail($code)
	{
		$retval = [];
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH_WITH_CODE, $code), 'GET');
		$responseData = json_decode($response->getBody(), true);
		if (isset($responseData['data']) && !empty($responseData['data'])) {
			$retval = new PartnerDelivery($responseData['data']);
		}
		return $retval;
	}
}
