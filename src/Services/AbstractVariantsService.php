<?php
namespace MPAPI\Services;

use MPAPI\Entity\Products\Variant;
use MPAPI\Interfaces\VariantsServiceInterface;

/**
 * Abstract variants service
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
abstract class AbstractVariantsService extends AbstractServiceFilter implements VariantsServiceInterface
{
	/**
	 *
	 * @var Variant[]
	 */
	protected $entities;

	/**
	 *
	 * @var string
	 */
	const MSG_NOT_IMPLEMENTED = 'Method %s not implemented!';

	/**
	 * Get data
	 *
	 * @see VariantsServiceInterface::get()
	 */
	public function get($productId, $variantId = '')
	{
		user_error(sprintf(self::MSG_NOT_IMPLEMENTED, __METHOD__), E_USER_WARNING);
	}

	/**
	 * Put data
	 *
	 * @see VariantsServiceInterface::put()
	 */
	public function put($productId, Variant $variant)
	{
		user_error(sprintf(self::MSG_NOT_IMPLEMENTED, __METHOD__), E_USER_WARNING);
	}

	/**
	 * Post data
	 *
	 * @see VariantsServiceInterface::post()
	 * @SuppressWarnings("PMD")
	 */
	public function post($data, Variant $variant)
	{
		user_error(sprintf(self::MSG_NOT_IMPLEMENTED, __METHOD__), E_USER_WARNING);
	}

	/**
	 * Search data
	 *
	 * @see VariantsServiceInterface::search()
	 */
	public function search($phrase)
	{
		user_error(sprintf(self::MSG_NOT_IMPLEMENTED, __METHOD__), E_USER_WARNING);
	}

	/**
	 * Delete data
	 *
	 * @see VariantsServiceInterface::delete()
	 */
	public function delete($productId, $variantId)
	{
		user_error(sprintf(self::MSG_NOT_IMPLEMENTED, __METHOD__), E_USER_WARNING);
	}

	/**
	 * Add data for batch operation
	 *
	 * @see VariantsServiceInterface::add()
	 * @SuppressWarnings("PMD")
	 */
	public function add($productId, Variant $variant)
	{
		user_error(sprintf(self::MSG_NOT_IMPLEMENTED, __METHOD__), E_USER_WARNING);
	}

	/**
	 *
	 * @return \MPAPI\Entity\Variant[]
	 */
	public function getEntities()
	{
		return $this->entities;
	}
}
