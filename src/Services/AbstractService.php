<?php
namespace MPAPI\Services;

use MPAPI\Entity\Products\Product;
use MPAPI\Interfaces\ServiceInterface;
use MPAPI\Entity\AbstractEntity;

/**
 * Abstract service
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
abstract class AbstractService extends AbstractServiceFilter implements ServiceInterface
{
	/**
	 *
	 * @var string
	 */
	const MSG_NOT_IMPLEMENTED = 'Method %s not implemented!';

	/**
	 *
	 * @var string
	 */
	const ASYNCHRONOUS_PARAMETER = 'async';

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_STATUS = 'status/%s';

	/**
	 *
	 * @var AbstractEntity[]
	 */
	protected $entities;

	/**
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 * Get data
	 *
	 * @see ServiceInterface::get()
	 */
	public function get()
	{
		user_error(sprintf(self::MSG_NOT_IMPLEMENTED, __METHOD__), E_USER_WARNING);
	}

	/**
	 * Put data
	 *
	 * @see ServiceInterface::put()
	 */
	public function put()
	{
		user_error(sprintf(self::MSG_NOT_IMPLEMENTED, __METHOD__), E_USER_WARNING);
	}

	/**
	 * Post data
	 *
	 * @param array|Product $data
	 * @see ServiceInterface::post()
	 * @SuppressWarnings("PMD")
	 */
	public function post($data)
	{
		user_error(sprintf(self::MSG_NOT_IMPLEMENTED, __METHOD__), E_USER_WARNING);
	}

	/**
	 * Search data
	 *
	 * @see ServiceInterface::search()
	 */
	public function search()
	{
		user_error(sprintf(self::MSG_NOT_IMPLEMENTED, __METHOD__), E_USER_WARNING);
	}

	/**
	 * Delete data
	 *
	 * @see ServiceInterface::delete()
	 */
	public function delete()
	{
		user_error(sprintf(self::MSG_NOT_IMPLEMENTED, __METHOD__), E_USER_WARNING);
	}

	/**
	 * Add data for batch operation
	 *
	 * @param AbstractEntity $entity
	 * @see \MPAPI\Interfaces\ServiceInterface::add()
	 * @SuppressWarnings("PMD")
	 */
	public function add(AbstractEntity $entity)
	{
		user_error(sprintf(self::MSG_NOT_IMPLEMENTED, __METHOD__), E_USER_WARNING);
	}

	/**
	 *
	 * @return \MPAPI\Services\AbstractEntity[]
	 */
	public function getEntities()
	{
		return $this->entities;
	}

	/**
	 * Enable or disable asynchronous request processing
	 *
	 * @param bool $status
	 * @return AbstractService
	 */
	public function asynchronous($status = true)
	{
		$this->client->setArgument(self::ASYNCHRONOUS_PARAMETER, $status);
		return $this;
	}

	/**
	 * Get asynchronous request status
	 *
	 * @param string $hash
	 * @return array
	 */
	public function getAsynchronouseStatus($hash)
	{
		$retval = [];
		// call API
		/* @var GuzzleHttp\Psr7\Response $response */
		$response = $this->client->sendRequest(
			sprintf(self::ENDPOINT_STATUS, $hash),
			'GET'
		);

		if ($response->getStatusCode() == 200) {
			$retval = json_decode((string)$response->getBody(), true);
		}
		return $retval;
	}
}
