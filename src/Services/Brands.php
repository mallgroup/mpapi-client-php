<?php
namespace MPAPI\Services;

use MPAPI\Endpoints\BrandsEndpoints;

/**
 * Brands service
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class Brands extends AbstractService
{

	/**
	 *
	 * @var Client
	 */
	private $client;

	/**
	 * Brands constructor
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * Get list of brands endpoints
	 *
	 * @return BrandsEndpoints
	 */
	public function get()
	{
		return new BrandsEndpoints($this->client);
	}
}
