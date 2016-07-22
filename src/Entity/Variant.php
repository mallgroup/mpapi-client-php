<?php
namespace MPAPI\Entity;

/**
 * Variant entity
 *
 * @author Jonas Habr <jonas.habr@mall.cz>
 */
class Variant
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
	const KEY_AVAILABILITY = 'availability';

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
	const KEY_MEDIA = 'media';

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
	const KEY_RRP_PRICE = 'rrp';

	/**
	 *
	 * @var string
	 */
	const KEY_RECOMMENDED = 'recommended';

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
	const KEY_IN_STOCK = 'in_stock';

	/**
	 *
	 * @var string
	 */
	const KEY_PROMOTIONS = 'promotions';

	/**
	 *
	 * @var string
	 */
	const KEY_LABELS = 'labels';

	/**
	 *
	 * @var integer
	 */
	const PRICE_PRECISION = 3;

	/**
	 *
	 * @var string
	 */
	private $data;

	/**
	 *
	 * @param array $variantData
	 */
	public function __construct($variantData)
	{
		$this->data = $variantData;
	}

	/**
	 * Get variant ID
	 *
	 * @return string
	 */
	public function getId()
	{
		return $this->data[self::KEY_ID];
	}

	/**
	 * Set variant ID
	 *
	 * @param string $value
	 * @return Variant
	 */
	public function setId($value)
	{
		if ($value !== $this->getId()) {
			$this->data[self::KEY_ID] = $value;
		}
		return $this;
	}

	/**
	 * Get variant title
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->data[self::KEY_TITLE];
	}

	/**
	 * Set variant title
	 *
	 * @param string $value
	 * @return Variant
	 */
	public function setTitle($value)
	{
		if ($value !== $this->getTitle()) {
			$this->data[self::KEY_TITLE] = $value;
		}
		return $this;
	}

	/**
	 * Get short description of variant
	 *
	 * @return string
	 */
	public function getShortdesc()
	{
		return $this->data[self::KEY_SHORTDESC];
	}

	/**
	 * Set short description of variant
	 *
	 * @param string $value
	 * @return Variant
	 */
	public function setShortdesc($value)
	{
		if ($value !== $this->getShortdesc()) {
			$this->data[self::KEY_SHORTDESC] = $value;
		}
		return $this;
	}

	/**
	 * Get long description of variant
	 *
	 * @return string
	 */
	public function getLongdesc()
	{
		return $this->data[self::KEY_LONGDESC];
	}

	/**
	 * Set long description of variant
	 *
	 * @param string $value
	 * @return Variant
	 */
	public function setLongdesc($value)
	{
		if ($value !== $this->getLongdesc()) {
			$this->data[self::KEY_LONGDESC] = $value;
		}
		return $this;
	}

	/**
	 * Get variant priority
	 *
	 * @return integer
	 */
	public function getPriority()
	{
		return (int) $this->data[self::KEY_PRIORITY];
	}

	/**
	 * Set variant priority
	 *
	 * @param integer $value
	 * @return Variant
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
	 * @return Variant
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
	 * @return Variant
	 */
	public function setPrice($value)
	{
		if (bccomp($value, $this->getPrice(), self::PRICE_PRECISION) !== 0) {
			$this->data[self::KEY_PRICE] = $value;
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
	 * @return Variant
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
	 * @return Variant
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
	 * @return Variant
	 */
	public function setAvailability($value)
	{
		if ($value !== $this->getAvailability()) {
			$this->data[self::KEY_AVAILABILITY] = $value;
		}
		return $this;
	}

	/**
	 * Get status
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
	 * @return Variant
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
	 * @return Variant
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
	 * Get recommended variants
	 *
	 * @return array
	 */
	public function getRecommended()
	{
		return $this->data[self::KEY_RECOMMENDED];
	}

	/**
	 * Set recommended variants
	 *
	 * @param array $value
	 * @return Variant
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
	 * @return Variant
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
	 * @return Variant
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
	 * @return Variant
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
	 * @return Variant
	 */
	public function setPromotions($value)
	{
		if ((int) $value !== $this->getPromotions()) {
			$this->data[self::KEY_PROMOTIONS] = $value;
		}
		return $this;
	}

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
