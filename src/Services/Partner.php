<?php
namespace MPAPI\Services;

use MPAPI\Endpoints\PartnerEndpoints;
use MPAPI\Exceptions\ApplicationException;

/**
 * Partner service
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class Partner extends AbstractService
{

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
	 * @var PartnerEndpoints
	 */
	private $endpoints;

	/**
	 * Partner constructor
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
		$this->endpoints = new PartnerEndpoints($this->client);
	}

	/**
	 * Get partner supply delay
	 *
	 * @return \GuzzleHttp\Psr7\Response
	 */
	public function getSupplyDelay()
	{
		return $this->endpoints->getSupplyDelay();
	}

	/**
	 * Create partner supply delay
	 *
	 * @param \DateTime $validTo
	 * @param \DateTime $validFrom = null
	 * @throws ApplicationException
	 * @return boolean
	 */
	public function postSupplyDelay(\DateTime $validTo, \DateTime $validFrom = null)
	{
		$requestData = [
			self::KEY_VALID_TO => $validTo->format(self::DEFAULT_DATE_FORMAT)
		];
		if ($validFrom !== null) {
			$requestData[self::KEY_VALID_FROM] = $validFrom->format(self::DEFAULT_DATE_FORMAT);
		}

		$response = $this->endpoints->postSupplyDelay($requestData);
		if ($response->getStatusCode() !== 201) {
			$error = [
				'response' => json_decode($response->getBody(), true)
			];
		}

		if (!empty($error)) {
			$this->client->getLogger()->error('Failed to set partner supply delay', $error);
			$exception = new ApplicationException();
			$exception->setData($error);
			throw $exception;
		}

		return true;
	}

	/**
	 * Update partner supply delay
	 *
	 * @param \DateTime $validTo
	 * @param \DateTime $validFrom = null
	 * @throws ApplicationException
	 * @return boolean
	 */
	public function putSupplyDelay(\DateTime $validTo, \DateTime $validFrom = null)
	{
		$requestData = [
			self::KEY_VALID_TO => $validTo->format(self::DEFAULT_DATE_FORMAT)
		];

		if ($validFrom !== null) {
			$requestData[self::KEY_VALID_FROM] = $validFrom->format(self::DEFAULT_DATE_FORMAT);
		}

		$response = $this->endpoints->putSupplyDelay($requestData);
		if ($response->getStatusCode() !== 200) {
			$error = [
				'response' => json_decode($response->getBody(), true)
			];
		}

		if (!empty($error)) {
			$this->client->getLogger()->error('Failed to update partner supply delay', $error);
			$exception = new ApplicationException();
			$exception->setData($error);
			throw $exception;
		}

		return true;
	}

	/**
	 * Delete partner supply delay
	 *
	 * @throws ApplicationException
	 * @return boolean
	 */
	public function deleteSupplyDelay()
	{
		$response = $this->endpoints->deleteSupplyDelay();
		if ($response->getStatusCode() !== 204) {
			$error = [
				'response' => json_decode($response->getBody(), true)
			];
		}

		if (!empty($error)) {
			$this->client->getLogger()->error('Failed to delete partner supply delay', $error);
			$exception = new ApplicationException();
			$exception->setData($error);
			throw $exception;
		}

		return true;
	}
}
