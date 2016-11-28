<?php
namespace MPAPI\Endpoints;

use MPAPI\Services\Client;
use MPAPI\Lib\DataCollector;

/**
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class BrandsEndpoints extends AbstractEndpoints
{
	/**
	 *
	 * @var string
	 */
	const ENDPOINT_PATH = 'brands';

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_SEARCH = '%s/search/%s';

	/**
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 * Get list of brands
	 *
	 * @return array|null
	 */
	public function categories()
	{
		$response = $this->client->sendRequest(self::ENDPOINT_PATH, 'GET');
		$dataCollector = new DataCollector($this->client, $response);
		return $dataCollector->getData();
	}

	/**
	 * Search brands
	 *
	 * @param string $phrase
	 * @return array|null
	 */
	public function searchBrands($phrase)
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_SEARCH, self::ENDPOINT_PATH, $phrase), 'GET');
		$dataCollector = new DataCollector($this->client, $response);
		return $dataCollector->getData();
	}
}
