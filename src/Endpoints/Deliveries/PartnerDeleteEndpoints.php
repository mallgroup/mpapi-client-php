<?php
/**
 * Created by PhpStorm.
 * User: mhrdlicka
 * Date: 1.9.2016
 * Time: 14:20
 */

namespace MPAPI\Endpoints\Deliveries;

use GuzzleHttp\Psr7\Response;

/**
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class PartnerDeleteEndpoints extends AbstractDeliveriesEndpoints
{
	/**
	 * Delete partner deliveries
	 * 
	 * @return Response
	 */
	public function deliveries()
	{
		return $this->client->sendRequest(self::ENDPOINT_PATH, 'DELETE');
	}

	/**
	 * Delete partner delivery by code
	 *
	 * @param string $code
	 * @return Response
	 */
	public function deliveriesByCode($code)
	{
		return $this->client->sendRequest(sprintf(self::ENDPOINT_PATH_WITH_CODE, $code), 'DELETE');
	}
}
