<?php
namespace MPAPI\Entity;

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
}
