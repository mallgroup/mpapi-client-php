<?php
namespace MPAPI\Services;

use MPAPI\Endpoints\CategoriesEndpoints;

/**
 * Category service
 *
 * @author Jonas Habr <jonas.habr@mall.cz>
 */
class Categories extends AbstractService
{

	/**
	 *
	 * @var Client
	 */
	private $client;

	/**
	 * Category constructor
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * Get list of categories endpoints
	 *
	 * @return CategoriesEndpoints
	 */
	public function get()
	{
		return new CategoriesEndpoints($this->client);
	}
}
