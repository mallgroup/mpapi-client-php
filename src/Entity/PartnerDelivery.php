<?php
namespace MPAPI\Entity;

/**
 * Partner delivery entity
 *
 * @author Martin Drlik <martin.drlik@mall.cz>
 */
class PartnerDelivery extends AbstractDelivery
{

	/**
	 *
	 * @var string
	 */
	const KEY_DELIVERY_METHOD_ID = 'delivery_method_id';

	/**
	 *
	 * @var string
	 */
	const KEY_EXTERNAL_ID = 'external_id';

	/**
	 *
	 * @var string
	 */
	const KEY_PARTNER_ID = 'partner_id';

	/**
	 *
	 * @var string
	 */
	const KEY_IS_PICKUP_POINT = 'is_pickup_point';

	/**
	 *
	 * @var array
	 */
	protected $data;

	/**
	 *
	 * @var array
	 */
	protected $changes;

	/**
	 *
	 * @see \MPAPI\Entity\AbstractDelivery::getData()
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * Get transport delivery method id
	 *
	 * @return string
	 */
	public function getDeliveryMethodId()
	{
		return $this->data[self::KEY_DELIVERY_METHOD_ID];
	}

	/**
	 * Get partner id
	 *
	 * @return integer
	 */
	public function getPartnerId()
	{
		return $this->data[self::KEY_PARTNER_ID];
	}

	/**
	 * Set partner id
	 *
	 * @param integer $partnerId
	 * @return PartnerDelivery
	 */
	public function setPartnerId($partnerId)
	{
		if ((int) $partnerId !== $this->getPartnerId()) {
			$this->changes[] = self::KEY_PARTNER_ID;
			$this->data[self::KEY_PARTNER_ID] = (int) $partnerId;
		}
		return $this;
	}

	/**
	 * Is pickup point true/false
	 *
	 * @return boolean
	 */
	public function isPickupPoint()
	{
		return (boolean) $this->data[self::KEY_IS_PICKUP_POINT];
	}

	/**
	 * Set delivery as pickup point
	 *
	 * @param boolean $status
	 * @return PartnerDelivery
	 */
	public function setAsPickupPoint($status)
	{
		if ((boolean) $status !== $this->isPickupPoint() || !isset($this->data[self::KEY_IS_PICKUP_POINT])) {
			$this->changes[] = self::KEY_IS_PICKUP_POINT;
			$this->data[self::KEY_IS_PICKUP_POINT] = (boolean) $status;
		}
		return $this;
	}
}
