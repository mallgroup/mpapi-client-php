<?php
namespace MPAPI\Endpoints\Variants;

use GuzzleHttp\Psr7\Response;
use MPAPI\Services\Client;

/**
 * Variants POST endpoints
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class VariantsPostEndpoints
{
	/**
	 * @var string
	 */
	const ENDPOINT_VARIANTS = 'products/%s/variants';

	/**
	 * @var Client
	 */
	private $client;

	/**
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * POST variant
	 *
	 * @param string $productId
	 * @param array $data
	 * @return Response
	 */
	public function create($productId, array $data)
	{
		return $this->client->sendRequest(sprintf(self::ENDPOINT_VARIANTS, $productId), 'POST', $data);
	}
}
