<?php
namespace MPAPI\Entity\Products;

/**
 * Variant entity
 *
 * @author Jonas Habr <jonas.habr@mall.cz>
 */
class Variant extends AbstractArticleEntity
{
	/**
	 *
	 * @var string
	 */
	protected $data;

	/**
	 * Get variant data
	 *
	 * @return array
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * Set variant data
	 *
	 * @param array $data
	 */
	public function setData($data)
	{
		$this->data = $data;
	}
}
