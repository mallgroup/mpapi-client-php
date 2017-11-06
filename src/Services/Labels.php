<?php
namespace MPAPI\Services;

use MPAPI\Lib\DataCollector;

/**
 * Labels service
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class Labels extends AbstractService
{

	/**
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 *
	 * @var string
	 */
	const PATH = 'labels';

	/**
	 * Labels constructor.
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
		$response = $this->client->sendRequest(self::PATH, 'GET');
		$dataCollector = new DataCollector($this->client, $response);
		return $dataCollector->getData();
	}
}
