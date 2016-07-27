<?php
namespace MPAPI\Endpoints;

use MPAPI\Services\Client;

abstract class AbstractEndpoints
{
	/**
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}
}