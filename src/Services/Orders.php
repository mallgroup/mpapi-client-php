<?php
namespace MPAPI\Services;

use MPAPI\Endpoints\OrdersEndpoints;
use MPAPI\Endpoints\OrderUpdateEndpoints;
use MPAPI\Entity\Paging;

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
	protected $client;

	/**
	 * Orders constructor.
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
	 * @return OrdersEndpoints
	 */
	public function get()
	{
		return new OrdersEndpoints($this->client);
	}

	/**
	 * Put data
	 *
	 * @return OrderUpdateEndpoints
	 */
	public function put()
	{
		return new OrderUpdateEndpoints($this->client);
	}

	/**
	 * @return Paging
	 */
	public function getPaging()
	{
		return $this->client->getPaging();
	}

}
