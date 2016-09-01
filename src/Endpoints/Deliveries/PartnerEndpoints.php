<?php
/**
 * Created by PhpStorm.
 * User: mhrdlicka
 * Date: 1.9.2016
 * Time: 14:20
 */

namespace MPAPI\Endpoints\Deliveries;

use MPAPI\Endpoints\AbstractEndpoints;
use MPAPI\Services\Client;

/**
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class PartnerEndpoints extends AbstractEndpoints
{
	/**
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 * Get all the endpoints that use GET
	 * 
	 * @return PartnerGetEndpoints
	 */
	public function get()
	{
		return new PartnerGetEndpoints($this->client);
	}

	/**
	 * Get all the endpoints that use POST
	 * 
	 * @return PartnerPostEndpoints
	 */
	public function post()
	{
		return new PartnerPostEndpoints($this->client);
	}

	/**
	 * Get all the endpoints that use PUT
	 * 
	 * @return PartnerPutEndpoints
	 */
	public function put()
	{
		return new PartnerPutEndpoints($this->client);
	}

	/**
	 * Get all the endpoints that use DELETE
	 * 
	 * @return PartnerDeleteEndpoints
	 */
	public function delete()
	{
		return new PartnerDeleteEndpoints($this->client);
	}
}