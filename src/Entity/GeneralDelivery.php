<?php
namespace MPAPI\Entity;

/**
 * General delivery entity
 *
 * @author Martin Drlik <martin.drlik@mall.cz>
 */
class GeneralDelivery extends AbstractDelivery
{

	/**
	 *
	 * @var string
	 */
	const KEY_TRANSPORT_ID = 'transport_id';

	/**
	 *
	 * @var string
	 */
	const KEY_DESCRIPTION = 'description';

	/**
	 *
	 * @var string
	 */
	const KEY_TRACKING_URL = 'tracking_url';

	/**
	 *
	 * @var string
	 */
	const KEY_ACTIVE = 'active';

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
	 * Get transport description
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return $this->data[self::KEY_DESCRIPTION];
	}

	/**
	 * Set transport description
	 *
	 * @param string $description
	 * @return GeneralDelivery
	 */
	public function setDescription($description)
	{
		if ($description !== $this->getDescription()) {
			$this->changes[] = self::KEY_DESCRIPTION;
			$this->data[self::KEY_DESCRIPTION] = $description;
		}
		return $this;
	}

	/**
	 * Get tracking url
	 *
	 * @return string
	 */
	public function getTrackingUrl()
	{
		return $this->data[self::KEY_TRACKING_URL];
	}

	/**
	 * Set tracking url
	 *
	 * @param string $url
	 * @return GeneralDelivery
	 */
	public function setTrackingUrl($url)
	{
		if ($url !== $this->getTrackingUrl()) {
			$this->changes[] = self::KEY_TRACKING_URL;
			$this->data[self::KEY_TRACKING_URL] = $url;
		}
		return $this;
	}

	/**
	 * Check if is transport service active
	 *
	 * @return boolean
	 */
	public function isActive()
	{
		return (boolean) $this->data[self::KEY_ACTIVE];
	}

	/**
	 * Set transport active status
	 *
	 * @param boolean $active
	 * @return GeneralDelivery
	 */
	public function setActive($active)
	{
		if ((boolean) $active !== $this->isActive()) {
			$this->changes[] = self::KEY_ACTIVE;
			$this->data[self::KEY_ACTIVE] = (boolean) $active;
		}
		return $this;
	}

	/**
	 * Get transport service ID
	 *
	 * @return integer
	 */
	public function getTransportId()
	{
		return $this->data[self::KEY_TRANSPORT_ID];
	}

	/**
	 * Set transport service ID
	 *
	 * @param integer $transportId
	 * @return GeneralDelivery
	 */
	public function setTransportId($transportId)
	{
		if ($transportId !== $this->getTransportId()) {
			$this->changes[] = self::KEY_TRANSPORT_ID;
			$this->data[self::KEY_TRANSPORT_ID] = $transportId;
		}
		return $this;
	}
}
