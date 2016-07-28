<?php
namespace MPAPI\Services;

use MPAPI\Endpoints\OrdersEndpoints;
use MPAPI\Endpoints\OrderUpdateEndpoints;

/**
 * Orders service
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class Orders extends AbstractService
{

	/**
	 *
	 * @var Client
	 */
	private $client;

	/**
	 * Category constructor.
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * Get Data
	 *
	 * @return array
	 */
	public function get()
	{
		return new OrdersEndpoints($this->client);
	}

	/**
	 *
	 * @see \MPAPI\Services\AbstractService::put()
	 */
	public function put()
	{
		return new OrderUpdateEndpoints($this->client);
	}
}
