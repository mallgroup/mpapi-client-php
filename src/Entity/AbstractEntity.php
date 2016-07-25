<?php
namespace MPAPI\Entity;

/**
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
abstract class AbstractEntity
{
	/**
	 *
	 * @var array
	 */
	protected $data;

	/**
	 *
	 * @param array $variantData
	 */
	public function __construct(array $data = [])
	{
		$this->data = $data;
	}

	/**
	 * Get entity data in array
	 *
	 * @return array
	 */
	abstract public function getData();
}