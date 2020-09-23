<?php
namespace MPAPI\Endpoints;

use MPAPI\Services\Client;
use MPAPI\Lib\DataCollector;

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
    const ENDPOINT_TREE = '%s/tree/%s';

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
	 * @var string
	 */
	const ENDPOINT_PARAMETER_VALUES = '%s/%s/params/%s';

	/**
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 * Get list of categories
	 *
	 * @return array
	 */
	public function categories()
	{
		$response = $this->client->sendRequest(self::ENDPOINT_PATH, 'GET');
		$dataCollector = new DataCollector($this->client, $response);
		return $dataCollector->getData();
	}

    /**
     * Get menu of categories
     *
     * @param string $shopId
     *
     * @return array
     */
    public function tree($shopId)
    {
        $response      = $this->client->sendRequest(sprintf(self::ENDPOINT_TREE, self::ENDPOINT_PATH, $shopId), 'GET');
        $dataCollector = new DataCollector($this->client, $response);
        return $dataCollector->getData();
    }

	/**
	 * Search categories
	 *
	 * @param string $phrase
	 * @return array
	 */
	public function searchCategories($phrase)
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_SEARCH, self::ENDPOINT_PATH, urlencode($phrase)), 'GET');
		$dataCollector = new DataCollector($this->client, $response);
		return $dataCollector->getData();
	}

	/**
	 * Search categories by prefix
	 *
	 * @param string $prefix
	 * @return array
	 */
	public function categoriesByPrefix($prefix)
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PREFIX, self::ENDPOINT_PATH, $prefix), 'GET');
		$dataCollector = new DataCollector($this->client, $response);
		return $dataCollector->getData();
	}

	/**
	 * Get list of parameters for specific category
	 *
	 * @param string $categoryId
	 * @return array
	 */
	public function categoryParameters($categoryId)
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PARAMETERS, self::ENDPOINT_PATH, $categoryId), 'GET');
		$dataCollector = new DataCollector($this->client, $response);
		return $dataCollector->getData();
	}

	/**
	 * Get list of parameter values by parameter id
	 *
	 * @param string $categoryId
	 * @param string $paramId
	 * @return array
	 */
	public function parameterValues($categoryId, $paramId)
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PARAMETER_VALUES, self::ENDPOINT_PATH, $categoryId, $paramId), 'GET');
		$dataCollector = new DataCollector($this->client, $response);
		return $dataCollector->getData();
	}
}
