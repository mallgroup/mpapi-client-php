<?php
namespace MPAPI\Services;

use MPAPI\Endpoints\PartnerEndpoints;

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
	private $client;

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
	 * @return \GuzzleHttp\Psr7\Response
	 */
	public function postSupplyDelay(\DateTime $validTo, \DateTime $validFrom = null)
	{
		$requestData = [
			self::KEY_VALID_TO => $validTo->format(self::DEFAULT_DATE_FORMAT)
		];

		if ($validFrom !== null) {
			$requestData[self::KEY_VALID_FROM] = $validFrom->format(self::DEFAULT_DATE_FORMAT);
		}

		return $this->endpoints->postSupplyDelay($requestData);
	}

	/**
	 * Update partner supply delay
	 *
	 * @param \DateTime $validTo
	 * @param \DateTime $validFrom = null
	 * @return \GuzzleHttp\Psr7\Response
	 */
	public function putSupplyDelay(\DateTime $validTo, \DateTime $validFrom = null)
	{
		$requestData = [
			self::KEY_VALID_TO => $validTo->format(self::DEFAULT_DATE_FORMAT)
		];

		if ($validFrom !== null) {
			$requestData[self::KEY_VALID_FROM] = $validFrom->format(self::DEFAULT_DATE_FORMAT);
		}

		return $this->endpoints->putSupplyDelay($requestData);
	}

	/**
	 * Delete partner supply delay
	 *
	 * @return \GuzzleHttp\Psr7\Response
	 */
	public function deleteSupplyDelay()
	{
		return $this->endpoints->deleteSupplyDelay();
	}


}
