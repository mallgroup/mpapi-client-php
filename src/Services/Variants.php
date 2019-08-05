<?php
namespace MPAPI\Services;

use GuzzleHttp\Psr7\Response;
use MPAPI\Endpoints\VariantsEndpoints;
use MPAPI\Entity\Products\BasicVariantIterator;
use MPAPI\Entity\Products\Variant;
use MPAPI\Exceptions\ApplicationException;
use MPAPI\Lib\DataCollector;

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
	protected $client;

	/**
	 *
	 * @var VariantsEndpoints
	 */
	private $endpoints;

	/**
	 *
	 * @var array
	 */
	private $requestHash = [];

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
	 * @return array|Variant|BasicVariantIterator
	 */
	public function get($productId, $variantId = '')
	{
		$retval = [];
		if (empty($variantId)) {
			/** @var Response $response */
			$response = $this->endpoints->variantsList($productId);
			// collect data from response
			$dataCollector = new DataCollector($this->client, $response, false);
			switch ($this->getFilter()) {
				case self::FILTER_TYPE_BASIC:
					$retval = new BasicVariantIterator($dataCollector->getData());
				break;
				default:
					$retval = $dataCollector->setDataSection('ids')->getData();
			}
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
				'response' => json_decode($response->getBody(), true),
				'responseCode' => $response->getStatusCode()
			];
		} elseif (
			$response->getStatusCode() == 202
			&& $this->client->getArgument(self::ASYNCHRONOUS_PARAMETER) === true
		) {
			$response = json_decode($response->getBody(), true);
			$this->requestHash[] = $response['data']['hash'];
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
	 * @param string $forceToken
	 * @return bool
	 */
	public function put($productId, Variant $variant, $forceToken = null)
	{
		if ($forceToken !== null) {
			$this->client->setArgument(AbstractService::ARG_FORCE_TOKEN, $forceToken);
		} else {
			$this->client->removeArgument(AbstractService::ARG_FORCE_TOKEN);
		}
		$status = $this->endpoints->update($productId, $variant);
		$this->requestHash[] = $this->endpoints->getRequestHash();
		return $status;
	}

	/**
	 * Get list of asynchronous request identification hash
	 *
	 * @return array
	 */
	public function getRequestHash()
	{
		return $this->requestHash;
	}
}
