<?php
namespace MPAPI\Interfaces;

use MPAPI\Entity\AbstractEntity;

/**
 * Service interface
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
interface ServiceInterface
{

	/**
	 * Get data
	 */
	public function get();

	/**
	 * Put entity
	 */
	public function put();

	/**
	 * Post entity
	 * @param array|AbstractEntity $data
	 */
	public function post($data);

	/**
	 * Search data
	 */
	public function search();

	/**
	 * Delete entity
	 */
	public function delete();

	/**
	 * Add entity for batch operation
	 */
	public function add(AbstractEntity $entity);
}
