<?php

namespace MPAPI\Services;

use MPAPI\Endpoints\Checks\CheckDeliveriesEndpoints;
use MPAPI\Endpoints\Checks\CheckMediaEndpoints;

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

	/**
	 * @return CheckMediaEndpoints
	 */
	public function media()
	{
		return new CheckMediaEndpoints($this->client);
	}
}
