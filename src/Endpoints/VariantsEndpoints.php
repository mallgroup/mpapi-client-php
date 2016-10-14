<?php
namespace MPAPI\Endpoints;

use GuzzleHttp\Psr7\Response;
use MPAPI\Services\Client;
use MPAPI\Entity\Variant;
use MPAPI\Exceptions\ApplicationException;

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
	 * @return array
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
	 * @return Variant
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
	 * @return boolean
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

		if (!empty($errors)) {
			$this->client->getLogger()->error('Error during updating variants', $errors);
			$exception = new ApplicationException();
			$exception->setData($errors);
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
	 * @return boolean
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
}
