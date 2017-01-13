<?php
namespace MPAPI\Endpoints;

use GuzzleHttp\Psr7\Response;
use MPAPI\Endpoints\Products\SupplyDelayEndpoints;
use MPAPI\Entity\Variant;
use MPAPI\Exceptions\ApplicationException;
use MPAPI\Services\Client;

/**
 * Variants GET endpoints
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class VariantsEndpoints
{
	/**
	 * @var string
	 */
	const ENDPOINT_VARIANTS = 'products/%s/variants%s%s';

	/**
	 * @var string
	 */
	const ENDPOINT_DELIMITER = '/';

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
	 * Get list of all variants.
	 *
	 * @return Response
	 */
	public function variantsList($productId)
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_VARIANTS, $productId, null, null), 'GET');
		return json_decode($response->getBody(), true)['data'];
	}

	/**
	 * Get variant detail
	 *
	 * @param string $productId
	 * @param string $variantId
	 * @return Response
	 */
	public function detail($productId, $variantId)
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_VARIANTS, $productId, self::ENDPOINT_DELIMITER, $variantId), 'GET');
		return new Variant(json_decode($response->getBody(), true)['data']);
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
			sprintf(self::ENDPOINT_VARIANTS, $productId, self::ENDPOINT_DELIMITER, $variant->getId()),
			'PUT',
			$variant->getData()
		);

		if ($response->getStatusCode() !== 200) {
			$error = [
				'entity' => $variant->getData(),
				'response' => json_decode($response->getBody(), true)
			];
		}

		if (!empty($error)) {
			$this->client->getLogger()->error('Failed to update variants', $error);
			$exception = new ApplicationException();
			$exception->setData($error);
			throw $exception;
		}

		return true;
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
		return $this->client->sendRequest(sprintf(self::ENDPOINT_VARIANTS, $productId, null, null), 'POST', $data);
	}

	/**
	 * Delete variant
	 *
	 * @param string $productId
	 * @param string $variantId
	 * @return Response
	 */
	public function delete($productId, $variantId)
	{
		$error = [];
		// call API
		$response = $this->client->sendRequest(
			sprintf(self::ENDPOINT_VARIANTS, $productId, self::ENDPOINT_DELIMITER, $variantId),
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

	/**
	 * Get endpoint for supply delay
	 *
	 * @param string $productId
	 * @param string $variantId
	 * @return MPAPI\Endpoints\Products\SupplayDelayEndpoints
	 */
	public function supplyDelay($productId, $variantId)
	{
		return new SupplyDelayEndpoints($this->client, $productId, $variantId);
	}
}
