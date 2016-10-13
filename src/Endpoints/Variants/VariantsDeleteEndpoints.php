<?php
namespace MPAPI\Endpoints\Variants;

use GuzzleHttp\Psr7\Response;
use MPAPI\Services\Client;

/**
 * Variants PUT endpoints
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class VariantsDeleteEndpoints
{
	/**
	 * @var string
	 */
	const ENDPOINT_VARIANTS = 'products/%s/variants/%s';

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
	 * Delete variant
	 *
	 * @param string $productId
	 * @param string $variantId
	 * @return Response
	 */
	public function variant($productId, $variantId)
	{
		$error = [];
		// call API
		$response = $this->client->sendRequest(
			sprintf(self::ENDPOINT_VARIANTS, $productId, $variantId),
			'DELETE'
		);

		if ($response->getStatusCode() !== 200) {
			$error = [
				'productId' => $productId,
				'variantId' => $variantId,
				'response' => json_decode($response->getBody(), true)
			];
		}

		if (!empty($errors)) {
			$this->client->getLogger()->error('Error during deleting variants', $errors);
			$exception = new ApplicationException();
			$exception->setData($errors);
			throw $exception;
		}

		return true;
	}
}
