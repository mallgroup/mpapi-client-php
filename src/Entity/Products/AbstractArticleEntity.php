<?php
namespace MPAPI\Entity\Products;

use MPAPI\Entity\AbstractEntity;
use MPAPI\Entity\PackageSize;
use MPAPI\Exceptions\UnknownPackageSizeException;

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
	const KEY_ARTICLE_ID = 'article_id';

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
	const KEY_PURCHASE_PRICE = 'purchase_price';

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
	const KEY_SWITCH = 'switch';

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
	 *
	 * @var string
	 */
	const KEY_DELIVERY_DELAY = 'delivery_delay';

	/**
	 *
	 * @var string
	 */
	const KEY_FREE_DELIVERY = 'free_delivery';

	/**
	 * @var string
 	 */
	const KEY_PACKAGE_SIZE = 'package_size';

	/**
	 *
	 * @var array
	 */
	protected $data = [
		self::KEY_FREE_DELIVERY => false
	];

	/**
	 * Get variant ID
	 *
	 * @return string
	 */
	public function getId()
	{
		$retval = '';
		if (isset($this->data[self::KEY_ID])) {
			$retval = $this->data[self::KEY_ID];
		}
		return $retval;
	}

	/**
	 * Get MALL article ID
	 *
	 * @return integer
	 */
	public function getArticleId()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_ARTICLE_ID])) {
			$retval = $this->data[self::KEY_ARTICLE_ID];
		}
		return $retval;
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
		$retval = '';
		if (isset($this->data[self::KEY_TITLE])) {
			$retval = $this->data[self::KEY_TITLE];
		}
		return $retval;
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
	 * Get product url
	 *
	 * @return string
	 */
	public function getUrl()
	{
		$retval = '';
		if (isset($this->data[self::KEY_URL])) {
			$retval = $this->data[self::KEY_URL];
		}
		return $retval;
	}

	/**
	 * Get short description of product
	 *
	 * @return string
	 */
	public function getShortdesc()
	{
		$retval = '';
		if (isset($this->data[self::KEY_SHORTDESC])) {
			$retval = $this->data[self::KEY_SHORTDESC];
		}
		return $retval;
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
		$retval = '';
		if (isset($this->data[self::KEY_LONGDESC])) {
			$retval = $this->data[self::KEY_LONGDESC];
		}
		return $retval;
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
		$retval = 0;
		if (isset($this->data[self::KEY_PRIORITY])) {
			$retval = (int) $this->data[self::KEY_PRIORITY];
		}
		return $retval;
	}

	/**
	 * Set product priority
	 *
	 * @param integer $value
	 * @return AbstractArticleEntity
	 */
	public function setPriority($value)
	{
		if ((int) $value !== $this->getPriority() || !isset($this->data[self::KEY_PRIORITY])) {
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
		$retval = '';
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
		$retval = 0;
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
		if (function_exists('bccomp') && bccomp($value, $this->getPrice(), self::PRICE_PRECISION) !== 0) {
			$this->data[self::KEY_PRICE] = $value;
		} elseif ((int)$value != (int) $this->getPrice()) {
			$this->data[self::KEY_PRICE] = $value;
		}
		return $this;
	}

	/**
	 * Get purchase price
	 *
	 * @return float
	 */
	public function getPurchasePrice()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_PURCHASE_PRICE])) {
			$retval = (float) $this->data[self::KEY_PURCHASE_PRICE];
		}
		return $retval;
	}

	/**
	 * Set purchase price
	 *
	 * @param float $value
	 * @return AbstractArticleEntity
	 */
	public function setPurchasePrice($value)
	{
		if (function_exists('bccomp') && bccomp($value, $this->getPrice(), self::PRICE_PRECISION) !== 0) {
			$this->data[self::KEY_PURCHASE_PRICE] = $value;
		} elseif ((int)$value != (int) $this->getPrice()) {
			$this->data[self::KEY_PURCHASE_PRICE] = $value;
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
		$retval = 0;
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
		if (function_exists('bccomp') && bccomp($value, $this->getRrpPrice(), self::PRICE_PRECISION) !== 0) {
			$this->data[self::KEY_RRP_PRICE] = $value;
		} elseif ((int)$value != (int) $this->getRrpPrice()) {
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
		$retval = 0;
		if (isset($this->data[self::KEY_AVAILABILITY][self::KEY_IN_STOCK])) {
			$retval = (int) $this->data[self::KEY_AVAILABILITY][self::KEY_IN_STOCK];
		}
		return $retval;
	}

	/**
	 * Set in stock quantity
	 *
	 * @param integer $value
	 * @return AbstractArticleEntity
	 */
	public function setInStock($value)
	{
		if ((int) $value !== $this->getInStock() || !isset($this->data[self::KEY_AVAILABILITY][self::KEY_IN_STOCK])) {
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
		$retval = [];
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
	 * @param string|null $switch
	 * @return AbstractArticleEntity
	 */
	public function addMedia($url, $main = false, $switch = null)
	{
		$mediaCurrent = [
			self::KEY_URL => $url,
			self::KEY_MAIN => (bool)$main,
			self::KEY_SWITCH => $switch
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
		$retval = [];
		if (isset($this->data[self::KEY_PROMOTIONS])) {
			$retval = $this->data[self::KEY_PROMOTIONS];
		}
		return $retval;
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
		$retval = [];
		if (isset($this->data[self::KEY_PARAMETERS])) {
			$retval = $this->data[self::KEY_PARAMETERS];
		}
		return $retval;
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
		$retval = '';
		if (isset($this->data[self::KEY_AVAILABILITY][self::KEY_STATUS])) {
			$retval = $this->data[self::KEY_AVAILABILITY][self::KEY_STATUS];
		}
		return $retval;
	}

	/**
	 * Get availability
	 *
	 * @return array
	 */
	public function getAvailability()
	{
		$retval = [];
		if (isset($this->data[self::KEY_AVAILABILITY])) {
			$retval = $this->data[self::KEY_AVAILABILITY];
		}
		return $retval;
	}

	/**
	 * Get recommended variants
	 *
	 * @return array
	 */
	public function getRecommended()
	{
		$retval = [];
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
		$retval = [];
		if (isset($this->data[self::KEY_LABELS])) {
			$retval = $this->data[self::KEY_LABELS];
		}
		return $retval;
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
	 * @param string $to
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
	 * Get dimensions
	 *
	 * @return array
	 */
	public function getDimensions()
	{
		$retval = [];
		if (isset($this->data[self::KEY_DIMENSIONS])) {
			$retval = $this->data[self::KEY_DIMENSIONS];
		}
		return $retval;
	}

	/**
	 * Set dimensions
	 *
	 * @param array $value
	 * @return AbstractArticleEntity
	 */
	public function setDimensions($value)
	{
		if ($value !== $this->getDimensions() || !isset($this->data[self::KEY_DIMENSIONS])) {
			$this->data[self::KEY_DIMENSIONS] = $value;
		}
		return $this;
	}

	/**
	 * Add dimensions
	 *
	 * @param double $weight
	 * @param double $width
	 * @param double $height
	 * @param double $length
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

	/**
	 * set dimension weight
	 *
	 * @param double $weight
	 * @return AbstractArticleEntity
	 */
	public function setWeight($weight)
	{
		$dimensions = $this->getDimensions()[0];
		$dimensions[self::KEY_WEIGHT] = $weight;
		$this->setDimensions($dimensions);

		return $this;
	}

	/**
	 * set dimension width
	 *
	 * @param double $width
	 * @return AbstractArticleEntity
	 */
	public function setWidth($width)
	{
		$dimensions = $this->getDimensions()[0];
		$dimensions[self::KEY_WIDTH] = $width;
		$this->setDimensions($dimensions);

		return $this;
	}

	/**
	 * set dimension height
	 *
	 * @param double $height
	 * @return AbstractArticleEntity
	 */
	public function setHeight($height)
	{
		$dimensions = $this->getDimensions()[0];
		$dimensions[self::KEY_HEIGHT] = $height;
		$this->setDimensions($dimensions);

		return $this;
	}

	/**
	 * set dimension length
	 *
	 * @param double $length
	 * @return AbstractArticleEntity
	 */
	public function setLength($length)
	{
		$dimensions = $this->getDimensions()[0];
		$dimensions[self::KEY_LENGTH] = $length;
		$this->setDimensions($dimensions);

		return $this;
	}

	/**
 	 * Get package size (SMALLBOX or BIGBOX)
 	 *
	 * @return string
 	 */
	public function getPackageSize()
	{
		$retval = '';
		if (isset($this->data[self::KEY_PACKAGE_SIZE])) {
			$retval = $this->data[self::KEY_PACKAGE_SIZE];
		}
		return $retval;
	}

	/**
 	 * Set package size (SMALLBOX or BIGBOX)
 	 *
	 * @return string
 	 */
	public function setPackageSize($size)
	{
		if (!in_array($size, PackageSize::PACKAGES_SIZE_LIST, true)) {
			throw UnknownPackageSizeException::withPackageSize($size);
		}
		$this->data[self::KEY_PACKAGE_SIZE] = $size;
		return $this;
	}

	/**
	 * Get delivery delay
	 *
	 * @return integer
	 */
	public function getDeliveryDelay()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_DELIVERY_DELAY])) {
			$retval = (int) $this->data[self::KEY_DELIVERY_DELAY];
		}
		return $retval;
	}

	/**
	 * Set delivery delay
	 *
	 * @param integer $value
	 * @return AbstractArticleEntity
	 */
	public function setDeliveryDelay($value)
	{
		if ((int) $value !== $this->getDeliveryDelay() || !isset($this->data[self::KEY_DELIVERY_DELAY])) {
			$this->data[self::KEY_DELIVERY_DELAY] = $value;
		}
		return $this;
	}

	/**
	 * Check has free delivery
	 *
	 * @return bool
	 */
	public function hasFreeDelivery()
	{
		if (!isset($this->data[self::KEY_FREE_DELIVERY])) {
			(bool)$this->data[self::KEY_FREE_DELIVERY] = false;
		}
		return (bool)$this->data[self::KEY_FREE_DELIVERY];
	}

	/**
	 * Set free delivery
	 *
	 * @param bool $status
	 * @return AbstractArticleEntity
	 */
	public function setFreeDelivery($status)
	{
		if ((bool) $status !== $this->hasFreeDelivery()) {
			$this->data[self::KEY_FREE_DELIVERY] = (bool) $status;
		}
		return $this;
	}
}