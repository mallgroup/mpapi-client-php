<?php
namespace MPAPI\Entity;

use MPAPI\Entity\AbstractDelivery;

/**
 * Pickup point entity
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class PickupPoint extends AbstractDelivery
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
	const KEY_PARTNER_ID = 'partner_id';

	/**
	 *
	 * @var string
	 */
	const KEY_STREET = 'street';

	/**
	 *
	 * @var string
	 */
	const KEY_CITY = 'city';

	/**
	 *
	 * @var string
	 */
	const KEY_ZIP = 'zip';

	/**
	 *
	 * @var string
	 */
	const KEY_LONGITUDE = 'longitude';

	/**
	 *
	 * @var string
	 */
	const KEY_LATITUDE = 'latitude';

	/**
	 *
	 * @var string
	 */
	const KEY_OPENING_HOURS = 'opening_hours';

	/**
	 *
	 * @var string
	 */
	const KEY_PAYMENT_METHODS = 'payment_methods';

	/**
	 *
	 * @var string
	 */
	const KEY_PHONE = 'phone';

	/**
	 *
	 * @var string
	 */
	const KEY_EMAIL = 'email';

	/**
	 *
	 * @var string
	 */
	const KEY_DISTRICT_CODE = 'district_code';

	/**
	 *
	 * @var string
	 */
	const KEY_NOTE = 'note';

	/**
	 *
	 * @var array
	 */
	protected $data;

	/**
	 *
	 * @see \MPAPI\Entity\AbstractEntity::getData()
	 */
	public function getData()
	{
		$retval = [
			self::KEY_CODE => $this->getCode(),
			self::KEY_TITLE => $this->getTitle(),
			self::KEY_DELIVERY_METHOD_ID => $this->getDeliveryMethodId(),
			self::KEY_PARTNER_ID => $this->getPartnerId(),
			self::KEY_STREET => $this->getStreet(),
			self::KEY_CITY => $this->getCity(),
			self::KEY_ZIP => $this->getZip(),
			self::KEY_LATITUDE => $this->getLatitude(),
			self::KEY_LONGITUDE => $this->getLongitude(),
			self::KEY_OPENING_HOURS => $this->getOpeningHours(),
			self::KEY_PAYMENT_METHODS => $this->getPaymentMethods(),
			self::KEY_PHONE => $this->getPhone(),
			self::KEY_EMAIL => $this->getEmail(),
			self::KEY_DISTRICT_CODE => $this->getDistrictCode(),
			self::KEY_NOTE => $this->getNote(),
			self::KEY_DIMENSIONS => [
				self::KEY_HEIGHT => $this->getHeight(),
				self::KEY_LENGTH => $this->getLength(),
				self::KEY_WIDTH => $this->getWidth(),
				self::KEY_WEIGHT => $this->getWeight()
			],
			self::KEY_PRIORITY => $this->getPriority()
		];
		return $retval;
	}

	/**
	 * Get pickup point id
	 *
	 * @return integer
	 */
	public function getPickupPointId()
	{
		return (int) $this->data[self::KEY_PICKUP_POINT_ID];
	}

	/**
	 * Get delivery method id
	 *
	 * @return integer
	 */
	public function getDeliveryMethodId()
	{
		return (int) $this->data[self::KEY_DELIVERY_METHOD_ID];
	}

	/**
	 * Set delivery method id
	 *
	 * @param integer $deliveryMethodId
	 * @return PickupPoint
	 */
	public function setDeliveryMethodId($deliveryMethodId)
	{
		$this->data[self::KEY_DELIVERY_METHOD_ID] = (int) $deliveryMethodId;
		return $this;
	}

	/**
	 * Get partner id
	 *
	 * @return integer
	 */
	public function getPartnerId()
	{
		return (int) $this->data[self::KEY_PARTNER_ID];
	}

	/**
	 * Set partner id
	 *
	 * @param integer $partnerId
	 * @return PickupPoint
	 */
	public function setPartnerId($partnerId)
	{
		$this->data[self::KEY_PARTNER_ID] = (int) $partnerId;
		return $this;
	}

	/**
	 * Get street and number
	 *
	 * @return string
	 */
	public function getStreet()
	{
		return $this->data[self::KEY_STREET];
	}

	/**
	 * Set street and number
	 *
	 * @param string $street
	 * @return PickupPoint
	 */
	public function setStreet($street)
	{
		$this->data[self::KEY_STREET] = $street;
		return $this;
	}

	/**
	 * Get city
	 *
	 * @return string
	 */
	public function getCity()
	{
		return $this->data[self::KEY_CITY];
	}

	/**
	 * Set city
	 *
	 * @param string $city
	 * @return PickupPoint
	 */
	public function setCity($city)
	{
		$this->data[self::KEY_CITY] = $city;
		return $this;
	}

	/**
	 * Get zip
	 *
	 * @return string
	 */
	public function getZip()
	{
		return $this->data[self::KEY_ZIP];
	}

	/**
	 * Set zip
	 *
	 * @param string $zip
	 * @return PickupPoint
	 */
	public function setZip($zip)
	{
		$this->data[self::KEY_ZIP] = $zip;
		return $this;
	}

	/**
	 * Get latitude
	 *
	 * @return double
	 */
	public function getLatitude()
	{
		return (double) $this->data[self::KEY_LATITUDE];
	}

	/**
	 * Set latitude
	 *
	 * @param double $latitude
	 * @return PickupPoint
	 */
	public function setLatitude($latitude)
	{
		$this->data[self::KEY_LATITUDE] = (double) $latitude;
		return $this;
	}

	/**
	 * Get longitude
	 *
	 * @return string
	 */
	public function getLongitude()
	{
		return (double) $this->data[self::KEY_LATITUDE];
	}

	/**
	 * Set longitude
	 *
	 * @param double $longitude
	 * @return PickupPoint
	 */
	public function setLongitude($longitude)
	{
		$this->data[self::KEY_LONGITUDE] = (double) $longitude;
		return $this;
	}

	/**
	 * Get opening hours
	 *
	 * @return string
	 */
	public function getOpeningHours()
	{
		return json_decode($this->data[self::KEY_OPENING_HOURS], true);
	}

	/**
	 * Set opening hours
	 *
	 * @param string $openingHours
	 * @return PickupPoint
	 */
	public function setOpeningHours($openingHours)
	{
		$this->data[self::KEY_OPENING_HOURS] = $openingHours;
		return $this;
	}

	/**
	 * Get payment methods
	 *
	 * @return string
	 */
	public function getPaymentMethods()
	{
		return json_decode($this->data[self::KEY_PAYMENT_METHODS], true);
	}

	/**
	 * Set payment methods
	 *
	 * @param string $paymentMethods
	 * @return PickupPoint
	 */
	public function setPaymentMethods($paymentMethods)
	{
		$this->data[self::KEY_PAYMENT_METHODS] = $paymentMethods;
		return $this;
	}

	/**
	 * Get phone
	 *
	 * @return string
	 */
	public function getPhone()
	{
		return $this->data[self::KEY_PHONE];
	}

	/**
	 * Set phone
	 *
	 * @param string $phone
	 * @return PickupPoint
	 */
	public function setPhone($phone)
	{
		$this->data[self::KEY_PHONE] = $phone;
		return $this;
	}

	/**
	 * Get longitude
	 *
	 * @return string
	 */
	public function getEmail()
	{
		return $this->data[self::KEY_EMAIL];
	}

	/**
	 * Set email
	 *
	 * @param string $email
	 * @return PickupPoint
	 */
	public function setEmail($email)
	{
		$this->data[self::KEY_EMAIL] = $email;
		return $this;
	}

	/**
	 * Get district code
	 *
	 * @return string
	 */
	public function getDistrictCode()
	{
		return $this->data[self::KEY_DISTRICT_CODE];
	}

	/**
	 * Set district code
	 *
	 * @param string $districtCode
	 * @return PickupPoint
	 */
	public function setDistrictCode($districtCode)
	{
		$this->data[self::KEY_DISTRICT_CODE] = $districtCode;
		return $this;
	}

	/**
	 * Get note
	 *
	 * @return string
	 */
	public function getNote()
	{
		return $this->data[self::KEY_NOTE];
	}

	/**
	 * Set note
	 *
	 * @param string $note
	 * @return PickupPoint
	 */
	public function setNote($note)
	{
		$this->data[self::KEY_NOTE] = $note;
		return $this;
	}

	/**
	 * Get height
	 *
	 * @return double
	 */
	public function getHeight()
	{
		return (double) $this->data[self::KEY_HEIGHT];
	}

	/**
	 * Set max height
	 *
	 * @param double $height
	 * @return PickupPoint
	 */
	public function setHeight($height)
	{
		$this->data[self::KEY_HEIGHT] = (double) $height;
		return $this;
	}

	/**
	 * Get length
	 *
	 * @return double
	 */
	public function getLength()
	{
		return (double) $this->data[self::KEY_LENGTH];
	}

	/**
	 * Set max length
	 *
	 * @param double $length
	 * @return PickupPoint
	 */
	public function setLength($length)
	{
		$this->data[self::KEY_LENGTH] = (double) $length;
		return $this;
	}

	/**
	 * Get width
	 *
	 * @return double
	 */
	public function getWidth()
	{
		return (double) $this->data[self::KEY_WIDTH];
	}

	/**
	 * Set max width
	 *
	 * @param double $width
	 * @return PickupPoint
	 */
	public function setWidth($width)
	{
		$this->data[self::KEY_WIDTH] = (double) $width;
		return $this;
	}

	/**
	 * Get weight
	 *
	 * @return double
	 */
	public function getWeight()
	{
		return (double) $this->data[self::KEY_WEIGHT];
	}

	/**
	 * Set max weight
	 *
	 * @param double $weight
	 * @return PickupPoint
	 */
	public function setWeight($weight)
	{
		$this->data[self::KEY_WEIGHT] = (double) $weight;
		return $this;
	}
}
