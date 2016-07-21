<?php
namespace MPAPI\Services;

use MPAPI\Interfaces\ServiceInterface;

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
	 * @see ServiceInterface::post()
	 */
	public function post()
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
}
