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
		return (int)$this->data[self::KEY_PRIORITY];
	}

	/**
	 * Set product priority
	 *
	 * @param integer $value
	 * @return Product
	 */
	public function setPriority($value)
	{
		if ((int)$value !== $this->getPriority()) {
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
		return (float)$this->data[self::KEY_PRICE];
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
		return (float)$this->data[self::KEY_VAT];
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
		return (float)$this->data[self::KEY_RRP_PRICE];
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
	public function setAvailability(array $value)
	{
		if ($value !== $this->getAvailability()) {
			$this->data[self::KEY_AVAILABILITY] = $value;
		}
		return $this;
	}

	/**
	 * @param string $status
	 * @return Product
	 */
	public function setStatus($status = self::STATUS_ACTIVE)
	{
		$this->data[self::KEY_AVAILABILITY][self::KEY_STATUS] = $status;
		return $this;
	}

	/**
	 * @param integer $amount
	 * @return Product
	 */
	public function setInStock($amount)
	{
		$this->data[self::KEY_AVAILABILITY][self::KEY_IN_STOCK] = $amount;
		return $this;
	}

	/**
	 * Get availability status
	 *
	 * @return string
	 */
	public function getStatus()
	{
		return $this->data[self::KEY_STATUS];
	}

	/**
	 * Get in stock quantity
	 *
	 * @return integer
	 */
	public function getInStock()
	{
		return (int)$this->data[self::KEY_IN_STOCK];
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
	public function setRecommended(array $value)
	{
		if ($value !== $this->getRecommended()) {
			$this->data[self::KEY_RECOMMENDED] = $value;
		}
		return $this;
	}

	/**
	 * Add recommended products
	 * @param array $value
	 * @return $this
	 */
	public function addRecommended(array $value)
	{
		if (!isset($this->data[self::KEY_RECOMMENDED])) {
			$this->data[self::KEY_RECOMMENDED] = $value;
		} else {
			$this->data[self::KEY_RECOMMENDED] = array_unique(array_merge($this->data[self::KEY_RECOMMENDED], $value));
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
	 * Set parameter value(s)
	 *
	 * @param $paramId
	 * @param $values
	 * @return Product
	 */
	public function setParameter($paramId, $values)
	{
		$this->data[self::KEY_PARAMETERS][$paramId] = $values;
		return $this;
	}

	/**
	 * Add parameter
	 *
	 * @param string $paramId
	 * @param string|number $value
	 * @return Product
	 */
	public function addParameter($paramId, $value)
	{
		if (!isset($this->data[self::KEY_PARAMETERS][$paramId])) {
			$this->data[self::KEY_PARAMETERS][$paramId] = $value;
		} elseif (isset($this->data[self::KEY_PARAMETERS][$paramId]) &&
			!is_array($this->data[self::KEY_PARAMETERS][$paramId]) &&
			$this->data[self::KEY_PARAMETERS][$paramId] !== $value
		) {
			$this->data[self::KEY_PARAMETERS][$paramId] = [$this->data[self::KEY_PARAMETERS][$paramId], $value];
		} else {
			$this->data[self::KEY_PARAMETERS][$paramId][] = $value;
			$this->data[self::KEY_PARAMETERS][$paramId] = array_unique($this->data[self::KEY_PARAMETERS][$paramId]);
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
	public function setLabels(array $value)
	{
		if ($value !== $this->getLabels()) {
			$this->data[self::KEY_LABELS] = $value;
		}
		return $this;
	}

	/**
	 * Add label
	 *
	 * @param string $labelName
	 * @param string $from
	 * @param string $from
	 * @return Product
	 */
	public function addLabel($labelName, $from, $to)
	{
		$labelCurrent = [
			self::KEY_LABEL => $labelName,
			self::KEY_FROM => $from,
			self::KEY_TO => $to
		];

		if (!isset($this->data[self::KEY_LABELS])) {
			$this->data[self::KEY_LABELS][] = $labelCurrent;
		} else {
			$updated = false;
			foreach ($this->data[self::KEY_LABELS] as $key => $label)
			{
				if ($labelCurrent[self::KEY_LABEL] === $label[self::KEY_LABEL]) {
					$this->data[self::KEY_LABELS][$key] = $labelCurrent;
					$updated = true;
				}
			}
			if ($updated === false) {
				$this->data[self::KEY_LABELS][] = $labelCurrent;
			}
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
		if ($value !== $this->getPromotions()) {
			$this->data[self::KEY_PROMOTIONS] = $value;
		}
		return $this;
	}

	/**
	 * Add promotion
	 *
	 * @param double $price
	 * @param string $from
	 * @param string $to
	 */
	public function addPromotion($price, $from, $to)
	{
		$promotionCurrent = [
			self::KEY_PRICE => $price,
			self::KEY_FROM => $from,
			self::KEY_TO => $to
		];

		if (!isset($this->data[self::KEY_PROMOTIONS])) {
			$this->data[self::KEY_PROMOTIONS][] = $promotionCurrent;
		} else {
			$updated = false;
			foreach ($this->data[self::KEY_PROMOTIONS] as $key => $media)
			{
				if ($promotionCurrent[self::KEY_FROM] === $media[self::KEY_FROM] &&
					$promotionCurrent[self::KEY_TO] === $media[self::KEY_TO] ) {
					$this->data[self::KEY_PROMOTIONS][$key] = $promotionCurrent;
					$updated = true;
				}
			}
			if ($updated === false) {
				$this->data[self::KEY_PROMOTIONS][] = $promotionCurrent;
			}
		}

		return $this;
	}

	/**
	 * Get media
	 *
	 * @return array
	 */
	public function getMedia()
	{
		return $this->data[self::KEY_MEDIA];
	}

	/**
	 * Set media
	 *
	 * @param array $value
	 * @return Product
	 */
	public function setMedia(array $value)
	{
		if ($value !== $this->getMedia()) {
			$this->data[self::KEY_MEDIA] = $value;
		}
		return $this;
	}

	/**
	 * Add media
	 *
	 * @param string $url
	 * @param boolean $main
	 */
	public function addMedia($url, $main)
	{
		$mediaCurrent = [
			self::KEY_URL => $url,
			self::KEY_MAIN => $main
		];
		if (!isset($this->data[self::KEY_MEDIA])) {
			$this->data[self::KEY_MEDIA][] = $mediaCurrent;
		} else {
			$updated = false;
			foreach ($this->data[self::KEY_MEDIA] as $key => $media)
			{
				if ($mediaCurrent[self::KEY_URL] === $media[self::KEY_URL]) {
					$this->data[self::KEY_MEDIA][$key] = $mediaCurrent;
					$updated = true;
				}
			}
			if ($updated === false) {
				$this->data[self::KEY_MEDIA][] = $mediaCurrent;
			}
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
		return $this->data[self::KEY_VARIANTS];
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
			foreach ($this->data[self::KEY_VARIANTS] as $key => $variant)
			{
				if ($variantCurrent[self::KEY_ID] === $variant[self::KEY_ID]) {
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
}
