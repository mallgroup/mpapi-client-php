<?php
namespace MPAPI\Entity;

/**
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
abstract class AbstractArticleEntity extends AbstractEntity
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
	const KEY_PRICE = 'price';

	/**
	 *
	 * @var string
	 */
	const KEY_RRP_PRICE = 'rrp';

	/**
	 *
	 * @var integer
	 */
	const PRICE_PRECISION = 3;

	/**
	 *
	 * @var string
	 */
	const KEY_MEDIA = 'media';

	/**
	 *
	 * @var string
	 */
	const KEY_URL = 'url';

	/**
	 *
	 * @var string
	 */
	const KEY_MAIN = 'main';

	/**
	 *
	 * @var string
	 */
	const KEY_PROMOTIONS = 'promotions';

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
	const KEY_PARAMETERS = 'parameters';

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
	 * @var string
	 */
	const KEY_AVAILABILITY = 'availability';

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
	const KEY_RECOMMENDED = 'recommended';

	/**
	 *
	 * @var string
	 */
	const KEY_LABELS = 'labels';

	/**
	 *
	 * @var string
	 */
	const KEY_LABEL = 'label';

	/**
	 *
	 * @var string
	 */
	const KEY_DIMENSIONS = 'dimensions';

	/**
	 *
	 * @var string
	 */
	const KEY_WEIGHT = 'weight';

	/**
	 *
	 * @var string
	 */
	const KEY_WIDTH = 'width';

	/**
	 *
	 * @var string
	 */
	const KEY_LENGTH = 'length';

	/**
	 *
	 * @var string
	 */
	const KEY_HEIGHT = 'height';

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
	 * @return AbstractArticleEntity
	 */
	public function setId($value)
	{
		if ($value !== $this->getId()) {
			$this->data[self::KEY_ID] = $value;
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
	 * @return AbstractArticleEntity
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
	 * @return AbstractArticleEntity
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
	 * @return AbstractArticleEntity
	 */
	public function setLongdesc($value)
	{
		if ($value !== $this->getLongdesc()) {
			$this->data[self::KEY_LONGDESC] = $value;
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
	 * @return AbstractArticleEntity
	 */
	public function setPriority($value)
	{
		if ((int) $value !== $this->getPriority()) {
			$this->data[self::KEY_PRIORITY] = $value;
		}
		return $this;
	}

	/**
	 * Set barcode
	 *
	 * @param string $value
	 * @return AbstractArticleEntity
	 */
	public function setBarcode($value)
	{
		if ($value !== $this->getBarcode()) {
			$this->data[self::KEY_BARCODE] = $value;
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
		$retval = null;
		if (isset($this->data[self::KEY_BARCODE])) {
			$retval = $this->data[self::KEY_BARCODE];
		}
		return $retval;
	}

	/**
	 * Get price
	 *
	 * @return float
	 */
	public function getPrice()
	{
		$retval = null;
		if (isset($this->data[self::KEY_PRICE])) {
			$retval = (float) $this->data[self::KEY_PRICE];
		}
		return $retval;
	}

	/**
	 * Set price
	 *
	 * @param float $value
	 * @return AbstractArticleEntity
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
		$retval = null;
		if (isset($this->data[self::KEY_RRP_PRICE])) {
			$retval = (float) $this->data[self::KEY_RRP_PRICE];
		}
		return $retval;
	}

	/**
	 * Set rrp price
	 *
	 * @param float $value
	 * @return AbstractArticleEntity
	 */
	public function setRrpPrice($value)
	{
		if (bccomp($value, $this->getRrpPrice(), self::PRICE_PRECISION) !== 0) {
			$this->data[self::KEY_RRP_PRICE] = $value;
		}
		return $this;
	}

	/**
	 * Get in stock quantity
	 *
	 * @return integer
	 */
	public function getInStock()
	{
		return (int) $this->data[self::KEY_AVAILABILITY][self::KEY_IN_STOCK];
	}

	/**
	 * Set in stock quantity
	 *
	 * @param integer $value
	 * @return AbstractArticleEntity
	 */
	public function setInStock($value)
	{
		if ((int) $value !== $this->getInStock()) {
			$this->data[self::KEY_AVAILABILITY][self::KEY_IN_STOCK] = $value;
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
		$retval = null;
		if (isset($this->data[self::KEY_MEDIA])) {
			$retval = $this->data[self::KEY_MEDIA];
		}
		return $retval;
	}

	/**
	 * Set media
	 *
	 * @param array $value
	 * @return AbstractArticleEntity
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
			foreach ($this->data[self::KEY_MEDIA] as $key => $media) {
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
	 * @return AbstractArticleEntity
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
	 * @return AbstractArticleEntity
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
			foreach ($this->data[self::KEY_PROMOTIONS] as $key => $media) {
				if ($promotionCurrent[self::KEY_FROM] === $media[self::KEY_FROM] && $promotionCurrent[self::KEY_TO] === $media[self::KEY_TO]) {
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
	 * @return AbstractArticleEntity
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
	 * @return AbstractArticleEntity
	 */
	public function addParameter($paramId, $value)
	{
		if (!isset($this->data[self::KEY_PARAMETERS][$paramId])) {
			$this->data[self::KEY_PARAMETERS][$paramId] = [];
		}
		if (!in_array($value, $this->data[self::KEY_PARAMETERS][$paramId])) {
			$this->data[self::KEY_PARAMETERS][$paramId][] = $value;
		}
		return $this;
	}

	/**
	 *
	 * @param string $status
	 * @return AbstractArticleEntity
	 */
	public function setStatus($status = self::STATUS_ACTIVE)
	{
		$this->data[self::KEY_AVAILABILITY][self::KEY_STATUS] = $status;
		return $this;
	}

	/**
	 * Get availability status
	 *
	 * @return string
	 */
	public function getStatus()
	{
		return $this->data[self::KEY_AVAILABILITY][self::KEY_STATUS];
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
	 * Get recommended variants
	 *
	 * @return array
	 */
	public function getRecommended()
	{
		$retval = null;
		if (isset($this->data[self::KEY_RECOMMENDED])) {
			$retval = $this->data[self::KEY_RECOMMENDED];
		}
		return $retval;
	}

	/**
	 * Set recommended variants
	 *
	 * @param array $value
	 * @return AbstractArticleEntity
	 */
	public function setRecommended($value)
	{
		if ((int) $value !== $this->getRecommended()) {
			$this->data[self::KEY_RECOMMENDED] = $value;
		}
		return $this;
	}

	/**
	 * Add recommended products
	 *
	 * @param array $value
	 * @return AbstractArticleEntity
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
	 * @return AbstractArticleEntity
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
	 * @return AbstractArticleEntity
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
			foreach ($this->data[self::KEY_LABELS] as $key => $label) {
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
	 * Get variable parameters
	 *
	 * @return array
	 */
	public function getDimensions()
	{
		return $this->data[self::KEY_DIMENSIONS];
	}

	/**
	 * Set variable parameters
	 *
	 * @param array $value
	 * @return Product
	 */
	public function setDimensions($value)
	{
		if ($value !== $this->getDimensions()) {
			$this->data[self::KEY_DIMENSIONS] = $value;
		}
		return $this;
	}

	/**
	 * Add dimensions
	 *
	 * @param double $price
	 * @param string $from
	 * @param string $to
	 * @return AbstractArticleEntity
	 */
	public function addDimensions($weight, $width, $height, $length)
	{
		$dimensions = [
			self::KEY_WEIGHT => $weight,
			self::KEY_WIDTH => $width,
			self::KEY_HEIGHT => $height,
			self::KEY_LENGTH => $length
		];
		$this->setDimensions($dimensions);

		return $this;
	}
}