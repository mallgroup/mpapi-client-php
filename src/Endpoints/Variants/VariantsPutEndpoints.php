<?php
namespace MPAPI\Endpoints\Variants;

use GuzzleHttp\Psr7\Response;
use MPAPI\Services\Client;
use MPAPI\Entity\Variant;

/**
 * Variants PUT endpoints
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class VariantsPutEndpoints
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
	 * Update variant
	 *
	 * @param string $productId
	 * @param Variant $variant
	 * @return Response
	 */
	public function update($productId, Variant $variant)
	{
		$error = [];
		// call API
		$response = $this->client->sendRequest(
			sprintf(self::ENDPOINT_VARIANTS, $productId, $variant->getId()),
			'PUT',
			$variant->getData()
		);

		if ($response->getStatusCode() !== 200) {
			$error = [
				'entity' => $variant->getData(),
				'response' => json_decode($response->getBody(), true)
			];
		}

		if (!empty($errors)) {
			$this->client->getLogger()->error('Error during updating variants', $errors);
			$exception = new ApplicationException();
			$exception->setData($errors);
			throw $exception;
		}

		return true;
	}
}
