<?php
namespace MPAPI\Entity;

/**
 * Product entity
 *
 * @author Jonas Habr <jonas.habr@mall.cz>
 */
class Product extends AbstractArticleEntity
{
	/**
	 *
	 * @var string
	 */
	const KEY_CATEGORY_ID = 'category_id';

	/**
	 *
	 * @var string
	 */
	const KEY_ADULT_ONLY = 'adult_only';

	/**
	 *
	 * @var string
	 */
	const KEY_BRAND_ID = 'brand_id';

	/**
	 *
	 * @var string
	 */
	const KEY_VAT = 'vat';

	/**
	 *
	 * @var string
	 */
	const KEY_DELIVERY_SETUP = 'delivery_setup';

	/**
	 *
	 * @var string
	 */
	const KEY_VARIANTS = 'variants';

	/**
	 *
	 * @var string
	 */
	const KEY_VARIABLE_PARAMETERS = 'variable_parameters';

	/**
	 *
	 * @var string
	 */
	protected $data;

	/**
	 * Get category ID
	 *
	 * @return integer
	 */
	public function getCategoryId()
	{
		$retval = null;
		if (isset($this->data[self::KEY_CATEGORY_ID])) {
			$retval = (int) $this->data[self::KEY_CATEGORY_ID];
		}
		return $retval;
	}

	/**
	 * Set category ID
	 *
	 * @param string $value
	 * @return Product
	 */
	public function setCategoryId($value)
	{
		if ($value !== $this->getCategoryId()) {
			$this->data[self::KEY_CATEGORY_ID] = $value;
		}
		return $this;
	}

	/**
	 * Get adult only status
	 *
	 * @return boolean
	 */
	public function getAdultOnly()
	{
		return $this->data[self::KEY_ADULT_ONLY] == 'f' ? false : true;
	}

	/**
	 * Set adult only status
	 *
	 * @param boolean $value
	 * @return Product
	 */
	public function setAdultOnly($value)
	{
		if ($value !== $this->getAdultOnly()) {
			$this->data[self::KEY_ADULT_ONLY] = $value;
		}
		return $this;
	}

	/**
	 * Get product brand id
	 *
	 * @return string
	 */
	public function getBrandId()
	{
		$retval = null;
		if (isset($this->data[self::KEY_BRAND_ID])) {
			$retval = $this->data[self::KEY_BRAND_ID];
		}
		return $retval;
	}

	/**
	 * Set product brand id
	 *
	 * @param string $value
	 * @return Product
	 */
	public function setBrandId($value)
	{
		if ($value !== $this->getBrandId()) {
			$this->data[self::KEY_BRAND_ID] = $value;
		}
		return $this;
	}

	/**
	 * Get VAT
	 *
	 * @return float
	 */
	public function getVat()
	{
		$retval = null;
		if (isset($this->data[self::KEY_VAT])) {
			$retval = (float) $this->data[self::KEY_VAT];
		}
		return $retval;
	}

	/**
	 * Set VAT
	 *
	 * @param float $value
	 * @return Product
	 */
	public function setVat($value)
	{
		if (bccomp($value, $this->getVat(), self::PRICE_PRECISION) !== 0) {
			$this->data[self::KEY_VAT] = $value;
		}
		return $this;
	}

	/**
	 * Get delivery setup
	 *
	 * @return string
	 */
	public function getDeliverySetup()
	{
		$retval = null;
		if (isset($this->data[self::KEY_DELIVERY_SETUP])) {
			$retval = $this->data[self::KEY_DELIVERY_SETUP];
		}
		return $retval;
	}

	/**
	 * Set delivery setup
	 *
	 * @param string $value
	 * @return Product
	 */
	public function setDeliverySetup($value)
	{
		if ($value !== $this->getDeliverySetup()) {
			$this->data[self::KEY_DELIVERY_SETUP] = $value;
		}
		return $this;
	}

	/**
	 * Get variable parameters
	 *
	 * @return array
	 */
	public function getVariableParameters()
	{
		$retval = null;
		if (isset($this->data[self::KEY_VARIABLE_PARAMETERS])) {
			$retval = $this->data[self::KEY_VARIABLE_PARAMETERS];
		}
		return $retval;
	}

	/**
	 * Set variable parameters
	 *
	 * @param array $value
	 * @return Product
	 */
	public function setVariableParameters($value)
	{
		if ($value !== $this->getVariableParameters()) {
			$this->data[self::KEY_VARIABLE_PARAMETERS] = $value;
		}
		return $this;
	}

	/**
	 * Add variable parameters products
	 *
	 * @param array $value
	 * @return $this
	 */
	public function addVariableParameters(array $value)
	{
		if (!isset($this->data[self::KEY_VARIABLE_PARAMETERS])) {
			$this->data[self::KEY_VARIABLE_PARAMETERS] = $value;
		} else {
			$this->data[self::KEY_VARIABLE_PARAMETERS] = array_unique(array_merge($this->data[self::KEY_VARIABLE_PARAMETERS], $value));
		}
		return $this;
	}

	/**
	 * Get variants
	 *
	 * @return array
	 */
	public function getVariants()
	{
		$retval = null;
		if (isset($this->data[self::KEY_VARIANTS])) {
			$retval = $this->data[self::KEY_VARIANTS];
		}
		return $retval;
	}

	/**
	 * Set variants
	 *
	 * @param array $value
	 * @return Product
	 */
	public function setVariants(array $value)
	{
		if ($value !== $this->getVariants()) {
			$this->data[self::KEY_VARIANTS] = $value;
		}
		return $this;
	}

	/**
	 * Add variant
	 *
	 * @param Variant $variantCurrent
	 * @return Product
	 */
	public function addVariant(Variant $variantCurrent)
	{
		if (!isset($this->data[self::KEY_VARIANTS])) {
			$this->data[self::KEY_VARIANTS][] = $variantCurrent->getData();
		} else {
			$updated = false;
			foreach ($this->data[self::KEY_VARIANTS] as $key => $variant) {
				if ($variantCurrent->getId() === $variant[self::KEY_ID]) {
					$this->data[self::KEY_VARIANTS][$key] = $variantCurrent->getData();
					$updated = true;
				}
			}
			if ($updated === false) {
				$this->data[self::KEY_VARIANTS][] = $variantCurrent->getData();
			}
		}

		return $this;
	}

	/**
	 * Get product data
	 *
	 * @return array
	 */
	public function getData()
	{
		return $this->data;
	}

	public function setData($data)
	{
		$this->data = $data;
	}
}
