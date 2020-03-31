<?php

namespace MPAPI\Entity\Products;

/**
 * Basic product entity
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class BasicProduct extends AbstractArticleEntity
{

	/**
	 *
	 * @var string
	 */
	const KEY_PRODUCT_ID = 'product_id';

	/**
	 *
	 * @var string
	 */
	const KEY_CATEGORY_ID = 'category_id';

	/**
	 *
	 * @var string
	 */
	const KEY_HAS_VARIANTS = 'has_variants';

	/**
	 *
	 * @var string
	 */
	const KEY_VARIANTS_COUNT = 'variants_count';

	/**
	 * Get product ID
	 *
	 * @return integer
	 */
	public function getProductId()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_PRODUCT_ID])) {
			$retval = $this->data[self::KEY_PRODUCT_ID];
		}
		return (int) $retval;
	}

	/**
	 * Get category ID
	 *
	 * @return string
	 */
	public function getCategoryId()
	{
		$retval = '';
		if (isset($this->data[self::KEY_CATEGORY_ID])) {
			$retval = $this->data[self::KEY_CATEGORY_ID];
		}
		return $retval;
	}

	/**
	 * Product has variant
	 *
	 * @return boolean
	 */
	public function hasVariants()
	{
		$retval = false;
		if (isset($this->data[self::KEY_HAS_VARIANTS])) {
			$retval = (boolean) $this->data[self::KEY_HAS_VARIANTS];
		}
		return (bool) $retval;
	}

	/**
	 * Get variants count
	 *
	 * @return integer
	 */
	public function getVariantsCount()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_VARIANTS_COUNT])) {
			$retval = $this->data[self::KEY_VARIANTS_COUNT];
		}
		return (int) $retval;
	}

	/**
	 * Get status
	 *
	 * @return string
	 */
	public function getStatus()
	{
		$retval = '';
		if (isset($this->data[self::KEY_STATUS])) {
			$retval = $this->data[self::KEY_STATUS];
		}
		return $retval;
	}

	/**
	 * Get in stock
	 *
	 * @return integer
	 */
	public function getInStock()
	{
		$retval = '';
		if (isset($this->data[self::KEY_IN_STOCK])) {
			$retval = $this->data[self::KEY_IN_STOCK];
		}
		return (int) $retval;
	}

	/**
	 * @return string
	 */
	public function getStage()
	{
		if (isset($this->data[self::KEY_STAGE])) {
			return $this->data[self::KEY_STAGE];
		}

		return self::STAGE_DRAFT;
	}

	/**
	 * @see \MPAPI\Entity\AbstractEntity::getData()
	 */
	public function getData()
	{
		return [
			self::KEY_ID => $this->getId(),
			self::KEY_PRODUCT_ID => $this->getProductId(),
			self::KEY_TITLE => $this->getTitle(),
			self::KEY_CATEGORY_ID => $this->getCategoryId(),
			self::KEY_HAS_VARIANTS => $this->hasVariants(),
			self::KEY_VARIANTS_COUNT => $this->getVariantsCount(),
			self::KEY_STATUS => $this->getStatus(),
			self::KEY_IN_STOCK => $this->getInStock(),
			self::KEY_STAGE => $this->getStage(),
		];
	}

	/**
	 * Set product data
	 *
	 * @param array $data
	 * @return self
	 */
	public function setData(array $data)
	{
		$this->data = $data;
		return $this;
	}

}
