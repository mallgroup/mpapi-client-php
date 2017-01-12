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
	 * @param array $data
	 * @return \GuzzleHttp\Psr7\Response
	 */
	public function postSupplyDelay(array $data)
	{
		return $this->endpoints->postSupplyDelay($data);
	}

	/**
	 * Update partner supply delay
	 *
	 * @param array $data
	 * @return \GuzzleHttp\Psr7\Response
	 */
	public function putSupplyDelay(array $data)
	{
		return $this->endpoints->putSupplyDelay($data);
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
