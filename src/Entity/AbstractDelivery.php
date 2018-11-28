<?php
namespace MPAPI\Entity;

use MPAPI\Exceptions\UnknownPackageSizeException;

/**
 * Delivery entity
 *
 * @author Martin Drlik <martin.drlik@mall.cz>
 */
abstract class AbstractDelivery extends AbstractEntity
{

	/**
	 *
	 * @var string
	 */
	const KEY_TITLE = 'title';

	/**
	 *
	 * @var string
	 */
	const KEY_PRICE = 'price';

	/**
	 *
	 * @var string
	 */
	const KEY_COD_PRICE = 'cod_price';

	/**
	 *
	 * @var string
	 */
	const KEY_FREE_LIMIT = 'free_limit';

	/**
	 *
	 * @var string
	 */
	const KEY_DELIVERY_DELAY = 'delivery_delay';

	/**
	 *
	 * @var string
	 */
	const KEY_HEIGHT = 'height';

	/**
	 *
	 * @var string
	 */
	const KEY_MIN_HEIGHT = 'height_min';

	/**
	 *
	 * @var string
	 */
	const KEY_MAX_HEIGHT = 'height_max';

	/**
	 *
	 * @var string
	 */
	const KEY_LENGTH = 'length';

	/**
	 *
	 * @var string
	 */
	const KEY_MIN_LENGTH = 'length_min';

	/**
	 *
	 * @var string
	 */
	const KEY_MAX_LENGTH = 'length_max';

	/**
	 *
	 * @var string
	 */
	const KEY_WIDTH = 'width';

	/**
	 *
	 * @var string
	 */
	const KEY_MIN_WIDTH = 'width_min';

	/**
	 *
	 * @var string
	 */
	const KEY_MAX_WIDTH = 'width_max';

	/**
	 *
	 * @var string
	 */
	const KEY_WEIGHT = 'weight';

	/**
	 *
	 * @var string
	 */
	const KEY_MIN_WEIGHT = 'weight_min';

	/**
	 *
	 * @var string
	 */
	const KEY_MAX_WEIGHT = 'weight_max';

	/**
	 *
	 * @var string
	 */
	const KEY_PRIORITY = 'priority';

	/**
	 *
	 * @var string
	 */
	const KEY_MIN = 'min';

	/**
	 *
	 * @var string
	 */
	const KEY_MAX = 'max';

	/**
	 *
	 * @var string
	 */
	const KEY_CODE = 'code';

	/**
	 *
	 * @var string
	 */
	const KEY_DIMENSION_PATTERN = '%s_%s';

	/**
	 * @var string
	 */
	const KEY_PACKAGE_SIZE = 'package_size';

	/**
	 *
	 * @var array
	 */
	protected $data = [
		self::KEY_PACKAGE_SIZE => PackageSize::SMALLBOX
	];

	/**
	 *
	 * @var array
	 */
	protected $changes = [];

	/**
	 * Get delivery title
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
	 * Set delivery title
	 *
	 * @param string $title
	 * @return Delivery
	 */
	public function setTitle($title)
	{
		if ($title !== $this->getTitle()) {
			$this->changes[] = self::KEY_TITLE;
			$this->data[self::KEY_TITLE] = $title;
		}
		return $this;
	}

	/**
	 * Get delivery CODE
	 *
	 * @return string
	 */
	public function getCode()
	{
		$retval = '';
		if (isset($this->data[self::KEY_CODE])) {
			$retval = $this->data[self::KEY_CODE];
		}
		return $retval;
	}

	/**
	 * Set delivery CODE
	 *
	 * @param string $code
	 * @return Delivery
	 */
	public function setCode($code)
	{
		if ($code !== $this->getCode()) {
			$this->changes[] = self::KEY_CODE;
			$this->data[self::KEY_CODE] = $code;
		}
		return $this;
	}

	/**
	 * Get delivery price
	 *
	 * @return double
	 */
	public function getPrice()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_PRICE])) {
			$retval = $this->data[self::KEY_PRICE];
		}
		return (double) $retval;
	}

	/**
	 * Set delivery price
	 *
	 * @param double $price
	 * @return Delivery
	 */
	public function setPrice($price)
	{
		if ((double) $price !== $this->getPrice() || !isset($this->data[self::KEY_PRICE])) {
			$this->changes[] = self::KEY_PRICE;
			$this->data[self::KEY_PRICE] = (double) $price;
		}
		return $this;
	}

	/**
	 * Get delivery COD price
	 *
	 * @return double
	 */
	public function getCodPrice()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_COD_PRICE])) {
			$retval = $this->data[self::KEY_COD_PRICE];
		}
		return (double) $retval;
	}

	/**
	 * Set delivery COD price
	 *
	 * @param double $price
	 * @return Delivery
	 */
	public function setCodPrice($price)
	{
		if ((double) $price !== $this->getCodPrice() || !isset($this->data[self::KEY_COD_PRICE])) {
			$this->changes[] = self::KEY_COD_PRICE;
			$this->data[self::KEY_COD_PRICE] = (double) $price;
		}
		return $this;
	}

	/**
	 * Get delivery free limit
	 *
	 * @return double|null
	 */
	public function getFreeLimit()
	{
		$retval = null;
		if (isset($this->data[self::KEY_FREE_LIMIT])) {
			$retval = (double) $this->data[self::KEY_FREE_LIMIT];
		}
		return $retval;
	}

	/**
	 * Set delivery COD price
	 *
	 * @param double $limit
	 * @return Delivery
	 */
	public function setFreeLimit($limit)
	{
		if ((double) $limit !== $this->getFreeLimit() || !isset($this->data[self::KEY_FREE_LIMIT])) {
			$this->changes[] = self::KEY_FREE_LIMIT;
			$this->data[self::KEY_FREE_LIMIT] = (double) $limit;
		}
		return $this;
	}

	/**
	 * Get delivery delivery delay
	 *
	 * @return integer
	 */
	public function getDeliveryDelay()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_DELIVERY_DELAY])) {
			$retval = $this->data[self::KEY_DELIVERY_DELAY];
		}
		return (int) $retval;
	}

	/**
	 * Set delivery delay
	 *
	 * @param int $delay
	 * @return Delivery
	 */
	public function setDeliveryDelay($delay)
	{
		if ((int) $delay !== $this->getDeliveryDelay() || !isset($this->data[self::KEY_DELIVERY_DELAY])) {
			$this->changes[] = self::KEY_DELIVERY_DELAY;
			$this->data[self::KEY_DELIVERY_DELAY] = (int) $delay;
		}
		return $this;
	}

	/**
	 * Get delivery min. height
	 *
	 * @return double
	 */
	public function getHeightMin()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_HEIGHT][self::KEY_MIN])) {
			$retval = $this->data[self::KEY_HEIGHT][self::KEY_MIN];
		}
		return (double) $retval;
	}

	/**
	 * Set delivery min. height
	 *
	 * @param double $heightMin
	 * @return Delivery
	 */
	public function setHeightMin($heightMin)
	{
		if ((double) $heightMin !== $this->getHeightMin() || !isset($this->data[self::KEY_HEIGHT][self::KEY_MIN])) {
			$this->changes[] = self::KEY_MIN_HEIGHT;
			$this->data[self::KEY_HEIGHT][self::KEY_MIN] = (double) $heightMin;
		}
		return $this;
	}

	/**
	 * Get delivery max. height
	 *
	 * @return double
	 */
	public function getHeightMax()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_HEIGHT][self::KEY_MAX])) {
			$retval = $this->data[self::KEY_HEIGHT][self::KEY_MAX];
		}
		return (double) $retval;
	}

	/**
	 * Set delivery max. height
	 *
	 * @param double $heightMax
	 * @return Delivery
	 */
	public function setHeightMax($heightMax)
	{
		if ((double) $heightMax !== $this->getHeightMax() || !isset($this->data[self::KEY_HEIGHT][self::KEY_MAX])) {
			$this->changes[] = self::KEY_MAX_HEIGHT;
			$this->data[self::KEY_HEIGHT][self::KEY_MAX] = (double) $heightMax;
		}
		return $this;
	}

	/**
	 * Get delivery min. length
	 *
	 * @return double
	 */
	public function getLengthMin()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_LENGTH][self::KEY_MIN])) {
			$retval = $this->data[self::KEY_LENGTH][self::KEY_MIN];
		}
		return (double) $retval;
	}

	/**
	 * Set delivery min. length
	 *
	 * @param double $lengthMin
	 * @return Delivery
	 */
	public function setLengthMin($lengthMin)
	{
		if ((double) $lengthMin !== $this->getLengthMin() || !isset($this->data[self::KEY_LENGTH][self::KEY_MIN])) {
			$this->changes[] = self::KEY_MIN_LENGTH;
			$this->data[self::KEY_LENGTH][self::KEY_MIN] = (double) $lengthMin;
		}
		return $this;
	}

	/**
	 * Get delivery max. length
	 *
	 * @return double
	 */
	public function getLengthMax()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_LENGTH][self::KEY_MAX])) {
			$retval = $this->data[self::KEY_LENGTH][self::KEY_MAX];
		}
		return (double) $retval;
	}

	/**
	 * Set delivery max. length
	 *
	 * @param double $lengthMax
	 * @return Delivery
	 */
	public function setLengthMax($lengthMax)
	{
		if ((double) $lengthMax !== $this->getLengthMax() || !isset($this->data[self::KEY_LENGTH][self::KEY_MAX])) {
			$this->changes[] = self::KEY_MAX_LENGTH;
			$this->data[self::KEY_LENGTH][self::KEY_MAX] = (double) $lengthMax;
		}
		return $this;
	}

	/**
	 * Get delivery min. width
	 *
	 * @return double
	 */
	public function getWidthMin()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_WIDTH][self::KEY_MIN])) {
			$retval = $this->data[self::KEY_WIDTH][self::KEY_MIN];
		}
		return (double) $retval;
	}

	/**
	 * Set delivery min. width
	 *
	 * @param double $widthMin
	 * @return Delivery
	 */
	public function setWidthMin($widthMin)
	{
		if ((double) $widthMin !== $this->getWidthMin() || !isset($this->data[self::KEY_WIDTH][self::KEY_MIN])) {
			$this->changes[] = self::KEY_MIN_WIDTH;
			$this->data[self::KEY_WIDTH][self::KEY_MIN] = (double) $widthMin;
		}
		return $this;
	}

	/**
	 * Get delivery max. width
	 *
	 * @return double
	 */
	public function getWidthMax()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_WIDTH][self::KEY_MAX])) {
			$retval = $this->data[self::KEY_WIDTH][self::KEY_MAX];
		}
		return (double) $retval;
	}

	/**
	 * Set delivery max. width
	 *
	 * @param double $widthMax
	 * @return Delivery
	 */
	public function setWidthMax($widthMax)
	{
		if ((double) $widthMax !== $this->getWidthMax() || !isset($this->data[self::KEY_WIDTH][self::KEY_MAX])) {
			$this->changes[] = self::KEY_MAX_WIDTH;
			$this->data[self::KEY_WIDTH][self::KEY_MAX] = (double) $widthMax;
		}
		return $this;
	}

	/**
	 * Get delivery min. weight
	 *
	 * @return double
	 */
	public function getWeightMin()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_WEIGHT][self::KEY_MIN])) {
			$retval = $this->data[self::KEY_WEIGHT][self::KEY_MIN];
		}
		return (double) $retval;
	}

	/**
	 * Set delivery min. weight
	 *
	 * @param double $weightMin
	 * @return Delivery
	 */
	public function setWeightMin($weightMin)
	{
		if ((double) $weightMin !== $this->getWeightMin() || !isset($this->data[self::KEY_WEIGHT][self::KEY_MIN])) {
			$this->changes[] = self::KEY_MIN_WEIGHT;
			$this->data[self::KEY_WEIGHT][self::KEY_MIN] = (double) $weightMin;
		}
		return $this;
	}

	/**
	 * Get delivery max. weight
	 *
	 * @return double
	 */
	public function getWeightMax()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_WEIGHT][self::KEY_MAX])) {
			$retval = $this->data[self::KEY_WEIGHT][self::KEY_MAX];
		}
		return (double) $retval;
	}

	/**
	 * Set delivery max. weight
	 *
	 * @param double $weightMax
	 * @return Delivery
	 */
	public function setWeightMax($weightMax)
	{
		if ((double) $weightMax !== $this->getWeightMax() || !isset($this->data[self::KEY_WEIGHT][self::KEY_MAX])) {
			$this->changes[] = self::KEY_MAX_WEIGHT;
			$this->data[self::KEY_WEIGHT][self::KEY_MAX] = (double) $weightMax;
		}
		return $this;
	}

	/**
	 * Get delivery priority
	 *
	 * @return integer
	 */
	public function getPriority()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_PRIORITY])) {
			$retval = $this->data[self::KEY_PRIORITY];
		}
		return (int) $retval;
	}

	/**
	 * Set delivery priority
	 *
	 * @param int $priority
	 * @return Delivery
	 */
	public function setPriority($priority)
	{
		if ((int) $priority !== $this->getPriority() || !isset($this->data[self::KEY_PRIORITY])) {
			$this->changes[] = self::KEY_PRIORITY;
			$this->data[self::KEY_PRIORITY] = (int) $priority;
		}
		return $this;
	}

	/**
	 * Get status of changes
	 *
	 * @return boolean
	 */
	public function isChanged()
	{
		return !empty($this->changes);
	}

	/**
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
	 * @param string $packageSize
	 * @return AbstractDelivery
	 * @throws UnknownPackageSizeException
	 */
	public function setPackageSize($packageSize)
	{
		if (!in_array($packageSize, PackageSize::PACKAGES_SIZE_LIST, true)) {
			throw UnknownPackageSizeException::withPackageSize($packageSize);
		}

		if ($packageSize !== $this->getPackageSize() || !isset($this->data[self::KEY_PACKAGE_SIZE])) {
			$this->changes[] = self::KEY_PACKAGE_SIZE;
			$this->data[self::KEY_PACKAGE_SIZE] = $packageSize;
		}
		return $this;
	}
}
