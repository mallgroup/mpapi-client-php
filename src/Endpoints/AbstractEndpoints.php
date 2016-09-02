<?php
namespace MPAPI\Endpoints;

use MPAPI\Services\Client;

/**
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
abstract class AbstractEndpoints
{
	/**
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 *
	 * @var array
	 */
	protected $errors = [];

	/**
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * Get synchronization error
	 *
	 * @return array
	 */
	public function getErrors()
	{
		return $this->errors;
	}

	/**
	 * Add error
	 *
	 * @param integer|string $identifier
	 * @param array $errorData
	 * @return AbstractEndpoints
	 */
	public function addError($identifier, array $errorData)
	{
		$this->errors[$identifier] = $errorData;
		return $this;
	}

	/**
	 * Get last client response
	 *
	 * @return \GuzzleHttp\Psr7\Response
	 */
	public function getLastResponse()
	{
		return $this->client->getLastResponse();
	}
}