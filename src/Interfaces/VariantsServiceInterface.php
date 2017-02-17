<?php
namespace MPAPI\Interfaces;

use MPAPI\Entity\Products\Variant;

/**
 * Variants service interface
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
interface VariantsServiceInterface
{

	/**
	 * Get data
	 *
	 * @param string $productId
	 * @param string $variantId
	 * @return array|Variant
	 */
	public function get($productId, $variantId = '');

	/**
	 * Put entity
	 *
	 * @param string $productId
	 * @param MPAPI\Entity\Variant $variant
	 * @return boolean
	 */
	public function put($productId, Variant $variant);

	/**
	 * Post entity
	 *
	 * @param string $productId
	 * @param array|MPAPI\Entity\Variant $variant
	 * @return boolean
	 */
	public function post($productId, Variant $variant);

	/**
	 * Search data
	 *
	 * @param string $phrase
	 * @return array
	 */
	public function search($phrase);

	/**
	 * Delete entity
	 *
	 * @param string $productId
	 * @param string $variantId
	 * @return boolean
	 */
	public function delete($productId, $variantId);

	/**
	 * Add entity for batch operation
	 *
	 * @param string $productId
	 * @param MPAPI\Entity\Variant $variant
	 * @return VariantsServiceInterface
	 */
	public function add($productId, Variant $variant);
}
