<?php
namespace MPAPI\Endpoints\Products;

use MPAPI\Endpoints\AbstractEndpoints;

/**
 * Supply delay endpoints
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class SupplyDelayEndpoints extends AbstractEndpoints
{
	/**
	 *
	 * @var string
	 */
	const ENDPOINT_PATH_PRODUCT = 'products/%s/supply-delay';

	/**
	 * @var string
	 */
	const ENDPOINT_PATH_VARIANT = 'products/%s/variants/%s/supply-delay';

	/**
	 *
	 * @var string
	 */
	const KEY_VALID_FROM = 'valid_from';

	/**
	 *
	 * @var string
	 */
	const KEY_VALID_TO = 'valid_to';

	/**
	 *
	 * @var string
	 */
	const DEFAULT_DATE_FORMAT = 'Y-m-d H:i:s';

	/**
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 *
	 * @var string $productId
	 */
	private $productId;

	/**
	 *
	 * @var string $variantId
	 */
	private $variantId;

	/**
	 *
	 * @param \MPAPI\Services\Client $client
	 * @param string $productId
	 * @param string $variantId
	 */
	public function __construct(\MPAPI\Services\Client $client, $productId, $variantId = null)
	{
		parent::__construct($client);
		$this->productId = $productId;
		$this->variantId = $variantId;
	}

	/**
	 * Get supply delay
	 *
	 * @return array
	 */
	public function get()
	{
		$response = $this->client->sendRequest($this->buildRequestUrl(), 'GET');
		return json_decode($response->getBody(), true)['data'];
	}

	/**
	 * Create new supply delay
	 *
	 * @param \DateTime $validTo
	 * @param \DateTime $validFrom = null
	 * @return boolean
	 */
	public function post(\DateTime $validTo, \DateTime $validFrom = null)
	{
		$requestData = [
			self::KEY_VALID_TO => $validTo->format(self::DEFAULT_DATE_FORMAT)
		];

		if ($validFrom !== null) {
			$requestData[self::KEY_VALID_FROM] = $validFrom->format(self::DEFAULT_DATE_FORMAT);
		}

		$response = $this->client->sendRequest($this->buildRequestUrl(), 'POST', $requestData);
		return $response->getStatusCode() == 200 || $response->getStatusCode() == 201;
	}

	/**
	 * Update supply delay
	 *
	 * @param \DateTime $validTo
	 * @param \DateTime $validFrom = null
	 * @return array
	 */
	public function put(\DateTime $validTo, \DateTime $validFrom = null)
	{
		$requestData = [
			self::KEY_VALID_TO => $validTo->format(self::DEFAULT_DATE_FORMAT)
		];

		if ($validFrom !== null) {
			$requestData[self::KEY_VALID_FROM] = $validFrom->format(self::DEFAULT_DATE_FORMAT);
		}

		$response = $this->client->sendRequest($this->buildRequestUrl(), 'PUT', $requestData);
		return $response->getStatusCode() == 200;
	}

	/**
	 * Delete supply delay
	 *
	 * @return array
	 */
	public function delete()
	{
		$response = $this->client->sendRequest($this->buildRequestUrl(), 'DELETE');
		return $response->getStatusCode() == 200 || $response->getStatusCode() == 204;
	}

	/**
	 * Build request URL
	 *
	 * @return string
	 */
	private function buildRequestUrl()
	{
		if (!empty($this->variantId)) {
			$requestPath = sprintf(self::ENDPOINT_PATH_VARIANT, $this->productId, $this->variantId);
		} else {
			$requestPath = sprintf(self::ENDPOINT_PATH_PRODUCT, $this->productId);
		}
		return $requestPath;
	}
}
