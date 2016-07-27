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
	 *
	 * @var CategoriesEndpoints
	 */
	private $categoriesEndpoints;

	/**
	 *
	 * @var string
	 */
	const PATH = 'category';

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
		return new CategoriesEndpoints($this->client);
	}
}
