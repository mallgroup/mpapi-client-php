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
class PartnerPutEndpoints extends AbstractDeliveriesEndpoints
{
	/**
	 * Update partner delivery
	 *
	 * @param string $code
	 * @param array $data
	 * @return Response
	 */
	public function update($code, array $data)
	{
		return $this->client->sendRequest(sprintf(self::ENDPOINT_PATH_WITH_CODE, $code), 'PUT', $data);
	}
}
