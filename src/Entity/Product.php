<?php
namespace MPAPI\Entity;

/**
 * Product entity
 *
 * @author Jonas Habr <jonas.habr@mall.cz>
 */
class Product extends AbstractEntity
{

	/**
	 *
	 * @var string
	 */
	const KEY_ID = 'id';

	/**
	 *
	 * @var string
	 */
	const KEY_CATEGORY_ID = 'category_id';

	/**
	 *
	 * @var string
	 */
	const KEY_TITLE = 'title';

	/**
	 *
	 * @var string
	 */
	const KEY_SHORTDESC = 'shortdesc';

	/**
	 *
	 * @var string
	 */
	const KEY_LONGDESC = 'longdesc';

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
	const KEY_PARAMETERS = 'parameters';

	/**
	 *
	 * @var string
	 */
	const KEY_PRIORITY = 'priority';

	/**
	 *
	 * @var string
	 */
	const KEY_BARCODE = 'barcode';

	/**
	 *
	 * @var string
	 */
	const KEY_LABELS = 'labels';

	/**
	 *
	 * @var string
	 */
	const KEY_MEDIA = 'media';

	/**
	 *
	 * @var string
	 */
	const KEY_MAIN = 'main';

	/**
	 *
	 * @var string
	 */
	const KEY_LABEL = 'label';

	/**
	 *
	 * @var string
	 */
	const KEY_URL = 'url';

	/**
	 *
	 * @var string
	 */
	const KEY_FROM = 'from';

	/**
	 *
	 * @var string
	 */
	const KEY_TO = 'to';

	/**
	 *
	 * @var string
	 */
	const KEY_PRICE = 'price';

	/**
	 *
	 * @var string
	 */
	const KEY_VAT = 'vat';

	/**
	 *
	 * @var string
	 */
	const KEY_RRP_PRICE = 'rrp';

	/**
	 *
	 * @var string
	 */
	const KEY_DELIVERY_SETUP = 'delivery_setup';

	/**
	 *
	 * @var string
	 */
	const KEY_STATUS = 'status';

	/**
	 *
	 * @var string
	 */
	const KEY_AVAILABILITY = 'availability';

	/**
	 *
	 * @var string
	 */
	const KEY_IN_STOCK = 'in_stock';

	/**
	 *
	 * @var string
	 */
	const KEY_VARIANTS = 'variants';

	/**
	 *
	 * @var string
	 */
	const KEY_PROMOTIONS = 'promotions';

	/**
	 *
	 * @var string
	 */
	const KEY_RECOMMENDED = 'recommended';

	/**
	 *
	 * @var integer
	 */
	const ROUND_DECIMAL = 2;

	/**
	 *
	 * @var integer
	 */
	const PRICE_PERCENTAGE_LIMIT = 30;

	/**
	 *
	 * @var string
	 */
	const KEY_VARIABLE_PARAMETERS = 'variable_parameters';

	/**
	 *
	 * @var string
	 */
	const STATUS_ACTIVE = 'A';

	/**
	 *
	 * @var string
	 */
	const STATUS_INACTIVE = 'N';

	/**
	 *
	 * @var integer
	 */
	const PRICE_PRECISION = 3;

	/**
	 *
	 * @var string
	 */
	protected $data;


	/**
	 * Get partner product ID
	 *
	 * @return string
	 */
	public function getId()
	{
		return $this->data[self::KEY_ID];
	}

	/**
	 * Set partner product ID
	 *
	 * @param string $value
	 * @return Product
	 */
	public function setId($value)
	{
		if ($value !== $this->getId()) {
			$this->data[self::KEY_ID] = $value;
		}
		return $this;
	}

	/**
	 * Get category ID
	 *
	 * @return integer
	 */
	public function getCategoryId()
	{
		return $this->data[self::KEY_CATEGORY_ID];
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
	 * Get product title
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->data[self::KEY_TITLE];
	}

	/**
	 * Set product title
	 *
	 * @param string $value
	 * @return Product
	 */
	public function setTitle($value)
	{
		if ($value !== $this->getTitle()) {
			$this->data[self::KEY_TITLE] = $value;
		}
		return $this;
	}

	/**
	 * Get short description of product
	 *
	 * @return string
	 */
	public function getShortdesc()
	{
		return $this->data[self::KEY_SHORTDESC];
	}

	/**
	 * Set short description of product
	 *
	 * @param string $value
	 * @return Product
	 */
	public function setShortdesc($value)
	{
		if ($value !== $this->getShortdesc()) {
			$this->data[self::KEY_SHORTDESC] = $value;
		}
		return $this;
	}

	/**
	 * Get long description of product
	 *
	 * @return string
	 */
	public function getLongdesc()
	{
		return $this->data[self::KEY_LONGDESC];
	}

	/**
	 * Set long description of product
	 *
	 * @param string $value
	 * @return Product
	 */
	public function setLongdesc($value)
	{
		if ($value !== $this->getLongdesc()) {
			$this->data[self::KEY_LONGDESC] = $value;
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
		return $this->data[self::KEY_BRAND_ID];
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
	 * Get product priority
	 *
	 * @return integer
	 */
	public function getPriority()
	{
		return (int) $this->data[self::KEY_PRIORITY];
	}

	/**
	 * Set product priority
	 *
	 * @param integer $value
	 * @return Product
	 */
	public function setPriority($value)
	{
		if ((int) $value !== $this->getPriority()) {
			$this->data[self::KEY_PRIORITY] = $value;
		}
		return $this;
	}

	/**
	 * Get barcode
	 *
	 * @return string
	 */
	public function getBarcode()
	{
		return $this->data[self::KEY_BARCODE];
	}

	/**
	 * Set barcode
	 *
	 * @param string $value
	 * @return Product
	 */
	public function setBarcode($value)
	{
		if ($value !== $this->getBarcode()) {
			$this->data[self::KEY_BARCODE] = $value;
		}
		return $this;
	}

	/**
	 * Get price
	 *
	 * @return float
	 */
	public function getPrice()
	{
		return (float) $this->data[self::KEY_PRICE];
	}

	/**
	 * Set price
	 *
	 * @param float $value
	 * @return Product
	 */
	public function setPrice($value)
	{
		if (bccomp($value, $this->getPrice(), self::PRICE_PRECISION) !== 0) {
			$this->data[self::KEY_PRICE] = $value;
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
		return (float) $this->data[self::KEY_VAT];
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
	 * Get RRP price
	 *
	 * @return float
	 */
	public function getRrpPrice()
	{
		return (float) $this->data[self::KEY_RRP_PRICE];
	}

	/**
	 * Set rrp price
	 *
	 * @param float $value
	 * @return Product
	 */
	public function setRrpPrice($value)
	{
		if (bccomp($value, $this->getRrpPrice(), self::PRICE_PRECISION) !== 0) {
			$this->data[self::KEY_RRP_PRICE] = $value;
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
		return $this->data[self::KEY_DELIVERY_SETUP];
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
	 * Get availability
	 *
	 * @return array
	 */
	public function getAvailability()
	{
		return $this->data[self::KEY_AVAILABILITY];
	}

	/**
	 * Set availability
	 *
	 * @param array $value
	 * @return Product
	 */
	public function setAvailability($value)
	{
		if ($value !== $this->getAvailability()) {
			$this->data[self::KEY_AVAILABILITY] = $value;
		}
		return $this;
	}

	/**
	 * Get availability status
	 *
	 * @return string
	 * @todo this will go to Availability entity
	 */
	public function getStatus()
	{
		return $this->data[self::KEY_STATUS];
	}

	/**
	 * Set availability status
	 *
	 * @param string $value
	 * @return Product
	 * @todo this will go to Availability entity
	 */
	public function setStatus($value)
	{
		if ($value !== $this->getStatus()) {
			$this->data[self::KEY_STATUS] = $value;
		}
		return $this;
	}

	/**
	 * Get in stock quantity
	 *
	 * @return integer
	 * @todo this will go to Availability entity
	 */
	public function getInStock()
	{
		return (int) $this->data[self::KEY_IN_STOCK];
	}

	/**
	 * Set in stock quantity
	 *
	 * @param double $value
	 * @return Product
	 * @todo this will go to Availability entity
	 */
	public function setInStock($value)
	{
		if ((int) $value !== $this->getInStock()) {
			$this->data[self::KEY_IN_STOCK] = $value;
		}
		return $this;
	}

	/**
	 * Get recommended products
	 *
	 * @return array
	 */
	public function getRecommended()
	{
		return $this->data[self::KEY_RECOMMENDED];
	}

	/**
	 * Set recommended products
	 *
	 * @param array $value
	 * @return Product
	 */
	public function setRecommended($value)
	{
		if ((int) $value !== $this->getRecommended()) {
			$this->data[self::KEY_RECOMMENDED] = $value;
		}
		return $this;
	}

	/**
	 * Get parameters
	 *
	 * @return array
	 */
	public function getParameters()
	{
		return $this->data[self::KEY_PARAMETERS];
	}

	/**
	 * Set parameters
	 *
	 * @param array $value
	 * @return Product
	 */
	public function setParameters($value)
	{
		if ((int) $value !== $this->getParameters()) {
			$this->data[self::KEY_PARAMETERS] = $value;
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
		return $this->data[self::KEY_VARIABLE_PARAMETERS];
	}

	/**
	 * Set variable parameters
	 *
	 * @param array $value
	 * @return Product
	 */
	public function setVariableParameters($value)
	{
		if ((int) $value !== $this->getVariableParameters()) {
			$this->data[self::KEY_VARIABLE_PARAMETERS] = $value;
		}
		return $this;
	}

	/**
	 * Get labels
	 *
	 * @return array
	 */
	public function getLabels()
	{
		return $this->data[self::KEY_LABELS];
	}

	/**
	 * Set labels
	 *
	 * @param array $value
	 * @return Product
	 */
	public function setLabels($value)
	{
		if ((int) $value !== $this->getLabels()) {
			$this->data[self::KEY_LABELS] = $value;
		}
		return $this;
	}

	/**
	 * Get promotions
	 *
	 * @return array
	 */
	public function getPromotions()
	{
		return $this->data[self::KEY_PROMOTIONS];
	}

	/**
	 * Set promotions
	 *
	 * @param array $value
	 * @return Product
	 */
	public function setPromotions($value)
	{
		if ((int) $value !== $this->getPromotions()) {
			$this->data[self::KEY_PROMOTIONS] = $value;
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
}
