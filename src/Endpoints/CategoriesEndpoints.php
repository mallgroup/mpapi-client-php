<?php
namespace MPAPI\Endpoints;

use MPAPI\Services\Client;

/**
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class CategoriesEndpoints extends AbstractEndpoints
{
	/**
	 *
	 * @var string
	 */
	const ENDPOINT_PATH = 'categories';

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_SEARCH = '%s/search/%s';

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_PREFIX = '%s/prefix/%s';

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_PARAMETERS = '%s/%s/params';

	/**
	 *
	 * @var Client
	 */
	protected $client;


	/**
	 * Get list of categories
	 *
	 * @return \GuzzleHttp\Psr7\Response|NULL
	 */
	public function getCategories()
	{
		return $this->client->sendRequest(self::ENDPOINT_PATH, 'GET');
	}

	/**
	 * Search categories
	 *
	 * @param string $phrase
	 * @return \GuzzleHttp\Psr7\Response|NULL
	 */
	public function getSearchCategories($phrase)
	{
		return $this->client->sendRequest(sprintf(self::ENDPOINT_SEARCH,  self::ENDPOINT_PATH, $phrase), 'GET');
	}

	/**
	 * Search categories by prefix
	 *
	 * @param string $prefix
	 * @return \GuzzleHttp\Psr7\Response|NULL
	 */
	public function getCategoriesByPrefix($prefix)
	{
		return $this->client->sendRequest(sprintf(self::ENDPOINT_PREFIX,  self::ENDPOINT_PATH, $prefix), 'GET');
	}

	/**
	 * Get list of parameters for specific category
	 *
	 * @param string $categoryId
	 * @return \GuzzleHttp\Psr7\Response|NULL
	 */
	public function getCategoryParameters($categoryId)
	{
		return $this->client->sendRequest(sprintf(self::ENDPOINT_PARAMETERS,  self::ENDPOINT_PATH, $categoryId), 'GET');
	}
}
