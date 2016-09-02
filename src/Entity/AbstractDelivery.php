<?php
namespace MPAPI\Entity;

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
	 *
	 * @var array
	 */
	protected $data = [];

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
		return $this->data[self::KEY_TITLE];
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
		return $this->data[self::KEY_CODE];
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
		return (double) $this->data[self::KEY_PRICE];
	}

	/**
	 * Set delivery price
	 *
	 * @param double $price
	 * @return Delivery
	 */
	public function setPrice($price)
	{
		if ((double) $price !== $this->getPrice()) {
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
		return (double) $this->data[self::KEY_COD_PRICE];
	}

	/**
	 * Set delivery COD price
	 *
	 * @param double $price
	 * @return Delivery
	 */
	public function setCodPrice($price)
	{
		if ((double) $price !== $this->getCodPrice()) {
			$this->changes[] = self::KEY_COD_PRICE;
			$this->data[self::KEY_COD_PRICE] = (double) $price;
		}
		return $this;
	}

	/**
	 * Get delivery free limit
	 *
	 * @return double
	 */
	public function getFreeLimit()
	{
		return (double) $this->data[self::KEY_FREE_LIMIT];
	}

	/**
	 * Set delivery COD price
	 *
	 * @param double $limit
	 * @return Delivery
	 */
	public function setFreeLimit($limit)
	{
		if ((double) $limit !== $this->getFreeLimit()) {
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
		return (int) $this->data[self::KEY_DELIVERY_DELAY];
	}

	/**
	 * Set delivery delay
	 *
	 * @param int $delay
	 * @return Delivery
	 */
	public function setDeliveryDelay($delay)
	{
		if ((int) $delay !== $this->getDeliveryDelay()) {
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
		if ((double) $heightMin !== $this->getHeightMin()) {
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
		if ((double) $heightMax !== $this->getHeightMax()) {
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
		if ((double) $lengthMin !== $this->getLengthMin()) {
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
		if ((double) $lengthMax !== $this->getLengthMax()) {
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
		if ((double) $widthMin !== $this->getWidthMin()) {
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
		if ((double) $widthMax !== $this->getWidthMax()) {
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
		if ((double) $weightMin !== $this->getWeightMin()) {
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
		if ((double) $weightMax !== $this->getWeightMax()) {
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
		return (int) $this->data[self::KEY_PRIORITY];
	}

	/**
	 * Set delivery priority
	 *
	 * @param int $priority
	 * @return Delivery
	 */
	public function setPriority($priority)
	{
		if ((int) $priority !== $this->getPriority()) {
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
}
