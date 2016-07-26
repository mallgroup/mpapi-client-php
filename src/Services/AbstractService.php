<?php
namespace MPAPI\Services;

use MPAPI\Entity\Product;
use MPAPI\Interfaces\ServiceInterface;
use MPAPI\Entity\AbstractEntity;

/**
 * Abstract service
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
abstract class AbstractService implements ServiceInterface
{

	/**
	 *
	 * @var string
	 */
	const MSG_NOT_IMPLEMENTED = 'Method %s not implemented!';

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
}
