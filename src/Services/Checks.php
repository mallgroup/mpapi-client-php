<?php

namespace MPAPI\Services;

use MPAPI\Endpoints\Checks\CheckDeliveriesEndpoints;

class Checks extends AbstractService
{
	/**
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 * Deliveries constructor.
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * @return CheckDeliveriesEndpoints
	 */
	public function deliveries()
	{
		return new CheckDeliveriesEndpoints($this->client);
	}
}
