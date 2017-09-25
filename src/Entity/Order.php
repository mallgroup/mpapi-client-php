<?php
namespace MPAPI\Entity;

use MPAPI\Entity\AbstractEntity;

/**
 * Order entity
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class Order extends AbstractEntity
{

	/**
	 *
	 * @var string
	 */
	const KEY_ORDER_ID = 'order_id';

	/**
	 *
	 * @var string
	 */
	const KEY_ID = 'id';

	/**
	 *
	 * @var string
	 */
	const KEY_PARTNER_ID = 'partner_id';

	/**
	 *
	 * @var string
	 */
	const KEY_PURCHASE_ID = 'purchase_id';

	/**
	 *
	 * @var string
	 */
	const KEY_CURRENCY_ID = 'currency';

	/**
	 *
	 * @var string
	 */
	const KEY_DELIVERY_PRICE = 'delivery_price';

	/**
	 *
	 * @var string
	 */
	const KEY_DELIVERY_METHOD = 'delivery_method';

	/**
	 *
	 * @var string
	 */
	const KEY_DELIVERY_METHOD_ID = 'delivery_method_id';

	/**
	 *
	 * @var string
	 */
	const KEY_DELIVERY_DPOSITION = 'delivery_position';

	/**
	 *
	 * @var string
	 */
	const KEY_DELIVERY_DATE = 'delivery_date';

	/**
	 *
	 * @var string
	 */
	const KEY_COD_PRICE = 'cod_price';

	/**
	 *
	 * @var string
	 */
	const KEY_ADDRESS = 'address';

	/**
	 *
	 * @var string
	 */
	const KEY_NAME = 'name';

	/**
	 *
	 * @var string
	 */
	const KEY_COMPANY = 'company';

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
	const KEY_COUNTRY = 'country';

	/**
	 *
	 * @var string
	 */
	const KEY_CONFIRMED = 'confirmed';

	/**
	 *
	 * @var string
	 */
	const KEY_STATUS = 'status';

	/**
	 *
	 * @var string
	 */
	const KEY_COD = 'cod';

	/**
	 *
	 * @var string
	 */
	const KEY_TRANSPORT_ID = 'transport_id';

	/**
	 *
	 * @var string
	 */
	const KEY_TRACKING_NO = 'tracking_number';

	/**
	 *
	 * @var string
	 */
	const KEY_EXTERNAL_ORDER_ID = 'external_order_id';

	/**
	 *
	 * @var string
	 */
	const KEY_DISCOUNT = 'discount';

	/**
	 *
	 * @var string
	 */
	const KEY_PAYMENT_TYPE = 'payment_type';

	/**
	 *
	 * @var string
	 */
	const KEY_CREATED = 'created';

	/**
	 *
	 * @var string
	 */
	const KEY_CUSTOMER_ID = 'customer_id';

	/**
	 *
	 * @var string
	 */
	const URI_ORDERS_TYPE_UNCONFIRMED = 'unconfirmed';

	/**
	 *
	 * @var string
	 */
	const URI_ORDERS_TYPE_OPEN = 'open';

	/**
	 *
	 * @var string
	 */
	const KEY_TRACKING = 'tracking';

	/**
	 *
	 * @var string
	 */
	const KEY_TRACKING_NUMBER = 'tracking_number';

	/**
	 *
	 * @var string
	 */
	const KEY_ITEMS = 'items';

	/**
	 *
	 * @var string
	 */
	const KEY_ITEM_ID = 'product_id';

	/**
	 *
	 * @var string
	 */
	const KEY_ITEM_QUANTITY = 'quantity';

	/**
	 *
	 * @var string
	 */
	const KEY_ITEM_PRICE = 'price';

	/**
	 *
	 * @var string
	 */
	const KEY_ITEM_VAT = 'vat';

	/**
	 *
	 * @var string
	 */
	const STATUS_BLOCKED = 'blocked';

	/**
	 *
	 * @var string
	 */
	const STATUS_OPEN = 'open';

	/**
	 *
	 * @var string
	 */
	const STATUS_SHIPPING = 'shipping';

	/**
	 *
	 * @var string
	 */
	const STATUS_SHIPPED = 'shipped';

	/**
	 *
	 * @var string
	 */
	const STATUS_DELIVERED = 'delivered';

	/**
	 *
	 * @var string
	 */
	const STATUS_RETURNED = 'returned';

	/**
	 *
	 * @var string
	 */
	const STATUS_CANCELLED = 'cancelled';

	/**
	 *
	 * @var array
	 */
	private $changes = [];

	/**
	 *
	 * @var array
	 */
	protected $data;

	/**
	 * Get data for output
	 *
	 * @return array
	 */
	public function getData()
	{
		return [
			'id' => (int)$this->getOrderId(),
			'purchase_id' => (int)$this->getPurchaseId(),
			'external_order_id' => (int)$this->getExternalOrderId(),
			'currency' => $this->getCurrencyId(),
			'delivery_price' => (float)$this->getDeliveryPrice(),
			'cod_price' => (float)$this->getCodPrice(),
			'discount' => (float)$this->getDiscount(),
			'payment_type' => $this->getPaymentType(),
			'delivery_method' => $this->getDeliveryMethod(),
			'delivery_method_id' => (int)$this->getDeliveryMethodId(),
			'tracking_number' => $this->getTrackingNumber(),
			'ship_date' => $this->getDeliveryDate(),
			'delivery_date' => $this->getDeliveryDate(),
			'cod' => (float)$this->getCod(),
			'address' => [
				'customer_id' => (int)$this->getCustomerId(),
				'name' => $this->getName(),
				'company' => $this->getCompany(),
				'phone' => $this->getPhone(),
				'email' => $this->getEmail(),
				'street' => $this->getStreet(),
				'city' => $this->getCity(),
				'zip' => $this->getZip(),
				'country' => $this->getCountry()
			],
			'confirmed' => $this->getConfirmed(),
			'status' => $this->getStatus(),
			'items' => $this->getItems()
		];
	}

	/**
	 * Get order id
	 *
	 * @return string
	 */
	public function getOrderId()
	{
		$retval = null;
		if (isset($this->data[self::KEY_ORDER_ID])) {
			$retval = $this->data[self::KEY_ORDER_ID];
		} else {
			$retval = $this->data[self::KEY_ID];
		}
		return $retval;
	}

	/**
	 * Get order items
	 *
	 * @return OrderItem[]
	 */
	public function getItems()
	{
		return $this->data[self::KEY_ITEMS];
	}

	/**
	 * Get partner id
	 *
	 * return integer
	 */
	public function getPartnerId()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_PARTNER_ID])) {
			$retval = (int)$this->data[self::KEY_PARTNER_ID];
		}
		return $retval;
	}

	/**
	 * Set partner id
	 *
	 * @param integer $partnerId
	 * @return Order
	 */
	public function setPartnerId($partnerId)
	{
		$this->data[self::KEY_PARTNER_ID] = $partnerId;
		return $this;
	}

	/**
	 * return integer
	 */
	public function getPurchaseId()
	{
		return $this->data[self::KEY_PURCHASE_ID];
	}

	/**
	 * return string
	 */
	public function getCurrencyId()
	{
		return $this->data[self::KEY_CURRENCY_ID];
	}

	/**
	 * return integer
	 */
	public function getDeliveryPrice()
	{
		return $this->data[self::KEY_DELIVERY_PRICE];
	}

	/**
	 * return string
	 */
	public function getDeliveryMethod()
	{
		return $this->data[self::KEY_DELIVERY_METHOD];
	}

	/**
	 * return integer
	 */
	public function getDeliveryMethodId()
	{
		return $this->data[self::KEY_DELIVERY_METHOD_ID];
	}

	/**
	 * return integer
	 */
	public function getDeliveryPosition()
	{
		return $this->data[self::KEY_DELIVERY_DPOSITION];
	}

	/**
	 * return string
	 */
	public function getDeliveryDate()
	{
		return $this->data[self::KEY_DELIVERY_DATE];
	}

	/**
	 * return double
	 */
	public function getCod()
	{
		return $this->data[self::KEY_COD];
	}

	/**
	 * return string
	 */
	public function getName()
	{
		return $this->data[self::KEY_ADDRESS][self::KEY_NAME];
	}

	/**
	 * return string
	 */
	public function getCompany()
	{
		$retval = '';
		if (!empty($this->data[self::KEY_ADDRESS][self::KEY_COMPANY])) {
			$retval = $this->data[self::KEY_ADDRESS][self::KEY_COMPANY];
		}
		return $retval;
	}

	/**
	 * return string
	 */
	public function getPhone()
	{
		return $this->data[self::KEY_ADDRESS][self::KEY_PHONE];
	}

	/**
	 * return string
	 */
	public function getEmail()
	{
		return $this->data[self::KEY_ADDRESS][self::KEY_EMAIL];
	}

	/**
	 * return string
	 */
	public function getStreet()
	{
		return $this->data[self::KEY_ADDRESS][self::KEY_STREET];
	}

	/**
	 * return string
	 */
	public function getCity()
	{
		return $this->data[self::KEY_ADDRESS][self::KEY_CITY];
	}

	/**
	 * return string
	 */
	public function getZip()
	{
		return $this->data[self::KEY_ADDRESS][self::KEY_ZIP];
	}

	/**
	 * return string
	 */
	public function getCountry()
	{
		return $this->data[self::KEY_ADDRESS][self::KEY_COUNTRY];
	}

	/**
	 * return string
	 */
	public function getConfirmed()
	{
		return $this->data[self::KEY_CONFIRMED];
	}

	/**
	 * return string
	 */
	public function getStatus()
	{
		return $this->data[self::KEY_STATUS];
	}

	/**
	 * return double
	 */
	public function getCodPrice()
	{
		$retval = 0;
		if (!empty($this->data[self::KEY_COD_PRICE])) {
			$retval = $this->data[self::KEY_COD_PRICE];
		}
		return $retval;
	}

	/**
	 * return integer
	 */
	public function getTransportId()
	{
		$retval = [];
		if (isset($this->data[self::KEY_TRANSPORT_ID])) {
			$retval = $this->data[self::KEY_TRANSPORT_ID];
		}
		return $retval;
	}

	/**
	 * return string
	 */
	public function getTrackingNumber()
	{
		$retval = [];
		if (isset($this->data[self::KEY_TRACKING_NO])) {
			$retval = $this->data[self::KEY_TRACKING_NO];
		}
		return $retval;
	}

	/**
	 * return integer
	 */
	public function getExternalOrderId()
	{
		return $this->data[self::KEY_EXTERNAL_ORDER_ID];
	}

	/**
	 * return integer
	 */
	public function getDiscount()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_DISCOUNT])) {
			$retval = $this->data[self::KEY_DISCOUNT];
		}
		return $retval;
	}

	/**
	 * return integer
	 */
	public function getPaymentType()
	{
		$retval = null;
		if (isset($this->data[self::KEY_PAYMENT_TYPE])) {
			$retval = $this->data[self::KEY_PAYMENT_TYPE];
		}
		return $retval;
	}

	/**
	 * return date
	 */
	public function getCreated()
	{
		$retval = null;
		if (isset($this->data[self::KEY_CREATED])) {
			$retval = $this->data[self::KEY_CREATED];
		}
		return $retval;
	}

	/**
	 * return integer
	 */
	public function getCustomerId()
	{
		$retval = null;
		if (isset($this->data[self::KEY_ADDRESS][self::KEY_CUSTOMER_ID])) {
			$retval = $this->data[self::KEY_ADDRESS][self::KEY_CUSTOMER_ID];
		}
		return $retval;
	}

	/**
	 * Set order status
	 *
	 * @param string $orderStatus
	 * @return Order
	 */
	public function setStatus($orderStatus)
	{
		$this->data[self::KEY_STATUS] = $orderStatus;
		return $this;
	}

	/**
	 * Set confirmed
	 *
	 * @param boolean $confirmed
	 * @return Order
	 */
	public function setConfirmed($confirmed = false)
	{
		$this->data[self::KEY_CONFIRMED] = $confirmed;
		return $this;
	}
}
