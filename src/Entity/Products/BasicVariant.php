<?php
namespace MPAPI\Entity\Products;

/**
 * Basic product entity
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class BasicVariant extends AbstractArticleEntity
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
	const KEY_VARIANT_ID = 'variant_id';

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
	 * Get variant ID
	 *
	 * @return string
	 */
	public function getVariantId()
	{
		$retval = '';
		if (isset($this->data[self::KEY_VARIANT_ID])) {
			$retval = $this->data[self::KEY_VARIANT_ID];
		}
		return $retval;
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
	 * @see \MPAPI\Entity\AbstractEntity::getData()
	 */
	public function getData()
	{
		return [
			self::KEY_ID => $this->getId(),
			self::KEY_PRODUCT_ID => $this->getProductId(),
			self::KEY_VARIANT_ID => $this->getVariantId(),
			self::KEY_TITLE => $this->getTitle(),
			self::KEY_STATUS => $this->getStatus(),
			self::KEY_IN_STOCK => $this->getInStock()
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
