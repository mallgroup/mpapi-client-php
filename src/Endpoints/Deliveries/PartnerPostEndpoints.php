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
class PartnerPostEndpoints extends AbstractDeliveriesEndpoints
{
	/**
	 * Create partner delivery
	 *
	 * @param array $data
	 * @return Response
	 */
	public function create(array $data)
	{
		return $this->client->sendRequest(self::ENDPOINT_PATH, 'POST', $data);
	}
}
