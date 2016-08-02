<?php
namespace MPAPI\Entity;

/**
 * Delivery setup entity
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class DeliverySetup extends AbstractEntity
{
	/**
	 * @var string
	 */
	const KEY_ID = 'id';

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
			self::KEY_PRICE => $this->getPrice(),
			self::KEY_COD_PRICE => $this->getCodPrice(),
			self::KEY_FREE_LIMIT => $this->getFreeLimit(),
			self::KEY_DELIVERY_DELAY => $this->getDeliveryDelay(),
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
	 * Set delivery setup id
	 *
	 * @param string $id
	 * @return \MPAPI\Entity\DeliverySetup
	 */
	public function setId($id)
	{
		$this->data[self::KEY_ID] = $id;
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
	 * @return \MPAPI\Entity\DeliverySetup
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
	 * @return \MPAPI\Entity\DeliverySetup
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
	 * @return \MPAPI\Entity\DeliverySetup
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
	 * @return \MPAPI\Entity\DeliverySetup
	 */
	public function setDeliveryDelay($delay)
	{
		$this->data[self::KEY_DELIVERY_DELAY] = (int)$delay;
		return $this;
	}
}
