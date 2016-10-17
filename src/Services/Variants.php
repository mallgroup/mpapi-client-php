<?php
namespace MPAPI\Services;

use GuzzleHttp\Psr7\Response;
use MPAPI\Endpoints\VariantsEndpoints;
use MPAPI\Entity\Variant;
use MPAPI\Exceptions\ApplicationException;

/**
 * Variants service
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class Variants extends AbstractVariantsService
{
	/**
	 *
	 * @var string
	 */
	const ENDPOINT_NAME_PATTERN = 'MPAPI\Endpoints\Variants\%sEndpoints';

	/**
	 *
	 * @var Client
	 */
	private $client;

	/**
	 *
	 * @var VariantsEndpoints
	 */
	private $endpoints;

	/**
	 * Variants constructor.
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
		$this->endpoints = new VariantsEndpoints($this->client);
	}

	/**
	 * Get variant list or variant detail
	 *
	 * @param string $productId
	 * @param string $variantId
	 * @return array|Variant
	 */
	public function get($productId, $variantId = '')
	{
		$retval = [];
		if (empty($variantId)) {
			$retval = $this->endpoints->variantsList($productId);
		} else {
			$retval = $this->endpoints->detail($productId, $variantId);
		}
		return $retval;
	}

	/**
	 * Delete data
	 * @param string $productId
	 * @param string $variantId
	 * @return boolean
	 */
	public function delete($productId, $variantId)
	{
		return $this->endpoints->delete($productId, $variantId);
	}

	/**
	 * Post data
	 *
	 * @param string $productId
	 * @param Variant $variant
	 * @return boolean
	 */
	public function post($productId, Variant $variant)
	{
		$errors = [];
		// call API
		$response = $this->endpoints->create($productId, $variant->getData());

		if ($response->getStatusCode() !== 201) {
			$errors = [
				'entity' => $variant->getData(),
				'response' => json_decode($response->getBody(), true)
			];
		}

		if (!empty($errors)) {
			$this->client->getLogger()->error('Error during post variants', $errors);
			$exception = new ApplicationException('Error during post variants ' . implode(', ', $errors));
			throw $exception;
		}

		return true;
	}

	/**
	 * Put data
	 *
	 * @param string $productId
	 * @param Variant $variant
	 * @return boolean
	 */
	public function put($productId, Variant $variant)
	{
		return $this->endpoints->update($productId, $variant);
	}
}
