<?php
namespace MPAPI\Entity;

/**
 * Delivery method entity
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class DeliveryMethod extends AbstractEntity
{
	/**
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
	const KEY_PICKUP_POINT = 'is_pickup_point';

	/**
	 *
	 * @var string
	 */
	const KEY_SETUPS = 'delivery_setups';

	/**
	 *
	 * @var string
	 */
	const KEY_PRICING = 'pricing';

	/**
	 *
	 * @var array
	 */
	protected $data = [];

	/**
	 * @see \MPAPI\Entity\AbstractEntity::getData()
	 */
	public function getData()
	{
		return [
			self::KEY_ID => $this->getId(),
			self::KEY_TITLE => $this->getTitle(),
			self::KEY_PRICE => $this->getPrice(),
			self::KEY_COD_PRICE => $this->getCodPrice(),
			self::KEY_FREE_LIMIT => $this->getFreeLimit(),
			self::KEY_DELIVERY_DELAY => $this->getDeliveryDelay(),
			self::KEY_PICKUP_POINT => $this->isPickupPoint()
		];
	}

	/**
	 * Get data for delivery setups
	 *
	 * @return array
	 */
	public function getPricingData()
	{
		return [
			self::KEY_ID => $this->getId(),
			self::KEY_PRICING => $this->getDeliverySetups()
		];
	}

	/**
	 * Get delivery method ID
	 *
	 * @return string
	 */
	public function getId()
	{
		return $this->data[self::KEY_ID];
	}

	/**
	 *
	 * @param string $id
	 * @return \MPAPI\Entity\DeliveryMethod
	 */
	public function setId($id)
	{
		$this->data[self::KEY_ID] = $id;
		return $this;
	}

	/**
	 * Get delivery method title
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->data[self::KEY_TITLE];
	}

	/**
	 * Set delivery method title
	 *
	 * @param string $title
	 * @return \MPAPI\Entity\DeliveryMethod
	 */
	public function setTitle($title)
	{
		$this->data[self::KEY_TITLE] = $title;
		return $this;
	}

	/**
	 * Get delivery price
	 *
	 * @return integer
	 */
	public function getPrice()
	{
		return $this->data[self::KEY_PRICE];
	}

	/**
	 * Set delivery method price
	 *
	 * @param integer $price
	 * @return \MPAPI\Entity\DeliveryMethod
	 */
	public function setPrice($price)
	{
		$this->data[self::KEY_PRICE] = $price;
		return $this;
	}

	/**
	 * Get cash on delivery price
	 *
	 * @return integer
	 */
	public function getCodPrice()
	{
		return $this->data[self::KEY_COD_PRICE];
	}

	/**
	 * Set cash on delivery price
	 *
	 * @param integer $price
	 * @return \MPAPI\Entity\DeliveryMethod
	 */
	public function setCodPrice($price)
	{
		$this->data[self::KEY_COD_PRICE] = $price;
		return $this;
	}

	/**
	 * Get free limit
	 *
	 * @return integer
	 */
	public function getFreeLimit()
	{
		return $this->data[self::KEY_FREE_LIMIT];
	}

	/**
	 * Set free delivery limit
	 *
	 * @param integer $limit
	 * @return \MPAPI\Entity\DeliveryMethod
	 */
	public function setFreeLimit($limit)
	{
		$this->data[self::KEY_FREE_LIMIT] = $limit;
		return $this;
	}

	/**
	 * Check free limit setup
	 *
	 * @return boolean
	 */
	public function hasFreeLimit()
	{
		return $this->getFreeLimit() > 0;
	}

	/**
	 * Get delivery delay
	 *
	 * @return integer
	 */
	public function getDeliveryDelay()
	{
		return $this->data[self::KEY_DELIVERY_DELAY];
	}

	/**
	 * Set delivery delay (in days)
	 *
	 * @param integer $daysDelay
	 * @return \MPAPI\Entity\DeliveryMethod
	 */
	public function setDeliveryDelay($delay)
	{
		$this->data[self::KEY_DELIVERY_DELAY] = (int)$delay;
		return $this;
	}

	/**
	 * Mark delivery method as pickup point
	 *
	 * @param boolean $status
	 * @return \MPAPI\Entity\DeliveryMethod
	 */
	public function setPickupPoint($status)
	{
		$this->data[self::KEY_PICKUP_POINT] = (boolean)$status;
		return $this;
	}

	/**
	 * Check is delivery method marked as pickup point
	 *
	 * @return boolean
	 */
	public function isPickupPoint()
	{
		return (boolean)$this->data[self::KEY_PICKUP_POINT];
	}

	/**
	 * Check if delivery method has any delivery setups
	 *
	 * @return boolean
	 */
	public function hasSetups()
	{
		return count($this->data[self::KEY_SETUPS]) > 0;
	}

	/**
	 * Get delivery setups as array of DeliverySetups
	 *
	 * @return DeliverySetup[]
	 */
	public function getDeliverySetups()
	{
		return $this->data[self::KEY_SETUPS];
	}

	/**
	 * Get delivery setups data
	 *
	 * @return array
	 */
	public function getDeliverySetupsData()
	{
		$retval = [];

		if ($this->hasSetups() === true) {
			foreach ($this->getDeliverySetups() as $deliverySetup) {
				$retval[] = $deliverySetup->getData();
			}
		}

		return $retval;
	}

	/**
	 * Add delivery setup
	 *
	 * @param DeliverySetup $setup
	 * @return \MPAPI\Entity\DeliveryMethod
	 */
	public function addDeliverySetup(DeliverySetup $setup)
	{
		$this->data[self::KEY_SETUPS][] = $setup;
		return $this;
	}
}
