<?php
namespace MPAPI\Interfaces;

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
	 * Put data
	 */
	public function put();

	/**
	 * Post data
	 */
	public function post();

	/**
	 * Search data
	 */
	public function search();

	/**
	 * Delete data
	 */
	public function delete();
}
