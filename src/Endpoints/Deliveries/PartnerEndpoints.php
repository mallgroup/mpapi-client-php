<?php
namespace MPAPI\Endpoints\Deliveries;

use MPAPI\Endpoints\AbstractEndpoints;
use MPAPI\Services\Client;
use MPAPI\Services\AbstractService;

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
}