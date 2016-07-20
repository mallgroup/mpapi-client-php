<?php
namespace MPAPI\Services;

use GuzzleHttp\Psr7\Response;

/**
 * Marketplace API client
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class Labels extends AbstractService
{
	/**
	 *
	 * @var Client
	 */
	private $client;

	/**
	 *
	 * @var string
	 */
	const PATH = 'labels';


	/**
	 * Labels constructor.
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * Get Data
	 *
	 * @return Response
	 */
	public function get()
	{
		$response = $this->client->sendRequest(self::PATH, 'GET');
		$responseBody = json_decode($response->getBody(), true);
		return $responseBody['data'];
	}
}
