<?php
namespace MPAPI\Entity;
use MPAPI\Exceptions\UnknownPackageSizeException;

/**
 * Pickup point entity
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class PickupPoint
{
	/**
	 *
	 * @var string
	 */
	const KEY_PARTNER_ID = 'partner_id';

	/**
	 *
	 * @var string
	 */
	const KEY_DELIVERY_CODE = 'delivery_code';

	/**
	 *
	 * @var string
	 */
	const KEY_CODE = 'code';

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
	 * @var string
	 */
	const KEY_TITLE = 'title';

	/**
	 *
	 * @var string
	 */
	const KEY_PRIORITY = 'priority';

	/**
	 *
	 * @var string
	 */
	const KEY_DIMENSIONS = 'dimensions';

	/**
	 *
	 * @var string
	 */
	const KEY_HEIGHT = 'height';

	/**
	 *
	 * @var string
	 */
	const KEY_LENGTH = 'length';

	/**
	 *
	 * @var string
	 */
	const KEY_WIDTH = 'width';

	/**
	 *
	 * @var string
	 */
	const KEY_WEIGHT = 'weight';

	/**
	 * @var string
	 */
	const KEY_PACKAGE_SIZE = 'package_size';

	/**
	 *
	 * @var array
	 */
	private $data;

	/**
	 *
	 * @param array $data
	 */
	public function __construct(array $data = [])
	{
		$this->data = $data;
	}

	/**
	 *
	 * @see \MPAPI\Entity\AbstractEntity::getData()
	 */
	public function getData()
	{
		$retval = [
			self::KEY_CODE => $this->getCode(),
			self::KEY_TITLE => $this->getTitle(),
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
				self::KEY_HEIGHT => $this->getHeightLimit(),
				self::KEY_LENGTH => $this->getLengthLimit(),
				self::KEY_WIDTH => $this->getWidthLimit(),
				self::KEY_WEIGHT => $this->getWeightLimit()
			],
			self::KEY_PRIORITY => $this->getPriority(),
			self::KEY_PACKAGE_SIZE => $this->getPackageSize()
		];
		return $retval;
	}

	/**
	 * Get delivery code
	 *
	 * @return string
	 */
	public function getDeliveryCode()
	{
		return $this->data[self::KEY_DELIVERY_CODE];
	}

	/**
	 * Set delivery code
	 *
	 * @param string $code
	 * @return PickupPoint
	 */
	public function setDeliveryCode($code)
	{
		$this->data[self::KEY_DELIVERY_CODE] = $code;
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
	 * @return double
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
		return $this->data[self::KEY_OPENING_HOURS];
	}

	/**
	 * Set opening hours
	 *
	 * @param array $openingHours
	 * @return PickupPoint
	 */
	public function setOpeningHours(array $openingHours)
	{
		$this->data[self::KEY_OPENING_HOURS] = $openingHours;
		return $this;
	}

	/**
	 * Get payment methods
	 *
	 * @return array
	 */
	public function getPaymentMethods()
	{
		return $this->data[self::KEY_PAYMENT_METHODS];
	}

	/**
	 * Set payment methods
	 *
	 * @param array $paymentMethods
	 * @return PickupPoint
	 */
	public function setPaymentMethods(array $paymentMethods)
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
	 * Get email
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
	 * Get height (in cm)
	 *
	 * @return double
	 */
	public function getHeightLimit()
	{
		return (double) $this->data[self::KEY_DIMENSIONS][self::KEY_HEIGHT];
	}

	/**
	 * Set max height (in cm)
	 *
	 * @param double $height
	 * @return PickupPoint
	 */
	public function setHeightLimit($height)
	{
		$this->data[self::KEY_DIMENSIONS][self::KEY_HEIGHT] = (double) $height;
		return $this;
	}

	/**
	 * Get length (in cm)
	 *
	 * @return double
	 */
	public function getLengthLimit()
	{
		return (double) $this->data[self::KEY_DIMENSIONS][self::KEY_LENGTH];
	}

	/**
	 * Set max length (in cm)
	 *
	 * @param double $length
	 * @return PickupPoint
	 */
	public function setLengthLimit($length)
	{
		$this->data[self::KEY_DIMENSIONS][self::KEY_LENGTH] = (double) $length;
		return $this;
	}

	/**
	 * Get width (in cm)
	 *
	 * @return double
	 */
	public function getWidthLimit()
	{
		return (double) $this->data[self::KEY_DIMENSIONS][self::KEY_WIDTH];
	}

	/**
	 * Set max width (in cm)
	 *
	 * @param double $width
	 * @return PickupPoint
	 */
	public function setWidthLimit($width)
	{
		$this->data[self::KEY_DIMENSIONS][self::KEY_WIDTH] = (double) $width;
		return $this;
	}

	/**
	 * Get weight
	 *
	 * @return double
	 */
	public function getWeightLimit()
	{
		return (double) $this->data[self::KEY_DIMENSIONS][self::KEY_WEIGHT];
	}

	/**
	 * Set max weight (in kg)
	 *
	 * @param double $weight
	 * @return PickupPoint
	 */
	public function setWeightLimit($weight)
	{
		$this->data[self::KEY_DIMENSIONS][self::KEY_WEIGHT] = (double) $weight;
		return $this;
	}

	/**
	 * Get pickup point priority
	 *
	 * @return integer
	 */
	public function getPriority()
	{
		return (int)$this->data[self::KEY_PRIORITY];
	}

	/**
	 * Set pickup point priority
	 *
	 * @param integer $priority
	 * @return PickupPoint
	 */
	public function setPriority($priority)
	{
		$this->data[self::KEY_PRIORITY] = $priority;
		return $this;
	}

	/**
	 * Get pickup point title
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->data[self::KEY_TITLE];
	}

	/**
	 * Set pickup point title
	 *
	 * @param string $title
	 * @return PickupPoint
	 */
	public function setTitle($title)
	{
		$this->data[self::KEY_TITLE] = $title;
		return $this;
	}

	/**
	 * Get pickup point code
	 *
	 * @return string
	 */
	public function getCode()
	{
		return $this->data[self::KEY_CODE];
	}

	/**
	 * Set pickup point title
	 *
	 * @param string $code
	 * @return PickupPoint
	 */
	public function setCode($code)
	{
		$this->data[self::KEY_CODE] = $code;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPackageSize()
	{
		return $this->data[self::KEY_PACKAGE_SIZE];
	}

	/**
	 * @param $packageSize
	 * @return $this
	 * @throws UnknownPackageSizeException
	 */
	public function setPackageSize($packageSize)
	{
		if (!in_array($packageSize, PackageSize::PACKAGES_SIZE_LIST)) {
			throw UnknownPackageSizeException::withPackageSize($packageSize);
		}
		$this->data[self::KEY_PACKAGE_SIZE] = $packageSize;
		return $this;
	}
}
