<?php
namespace MAPI\Entity;

/**
 * Order entity
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class Order
{

	/**
	 *
	 * @var integer
	 */
	const KEY_ORDER_ID = 'order_id';

	/**
	 *
	 * @var integer
	 */
	const KEY_PARTNER_ID = 'partner_id';

	/**
	 *
	 * @var integer
	 */
	const KEY_PURCHASE_ID = 'purchase_id';

	/**
	 *
	 * @var string
	 */
	const KEY_CURRENCY_ID = 'currency_id';

	/**
	 *
	 * @var integer
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
	 * @var integer
	 */
	const KEY_DELIVERY_COD_PRICE = 'delivery_cod_price';

	/**
	 *
	 * @var string
	 */
	const KEY_EXTERNAL_DELIVERY_METHOD_ID = 'external_delivery_method_id';

	/**
	 *
	 * @var integer
	 */
	const KEY_TRANSPORT_ID = 'transport_id';

	/**
	 *
	 * @var string
	 */
	const KEY_TRACKING_NO = 'tracking_number';

	/**
	 *
	 * @var integer
	 */
	const KEY_EXTERNAL_ORDER_ID = 'external_order_id';

	/**
	 *
	 * @var integer
	 */
	const KEY_DISCOUNT = 'discount';

	/**
	 *
	 * @var integer
	 */
	const KEY_PAYMENT_TYPE = 'payment_type';

	/**
	 *
	 * @var string
	 */
	const KEY_CREATED = 'created';

	/**
	 *
	 * @var integer
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
	 * @var array
	 */
	private $changes = [];

	/**
	 *
	 * @var array
	 */
	private $data;

	/**
	 * Constructor
	 *
	 * @param array $orderData
	 */
	public function __construct($orderData)
	{
		$this->data = $orderData;
	}

	/**
	 * Get data for output
	 *
	 * @return array
	 */
	public function getOutputData()
	{
		return [
			'id' => (int)$this->getOrderId(),
			'purchase_id' => (int)$this->getPurchaseId(),
			'external_order_id' => (int)$this->getExternalOrderId(),
			'currency' => $this->getCurrencyId(),
			'delivery_price' => (float)$this->getDeliveryPrice(),
			'cod_price' => (float)$this->getDeliveryCodPrice(),
			'discount' => (float)$this->getDiscount(),
			'delivery_method' => $this->getExternalDeliveryMethodId(),
			'delivery_method_id' => (int)$this->getDeliveryMethodId(),
			'ship_date' => $this->getDeliveryDate(),
			'delivery_date' => $this->getDeliveryDate(),
			'cod' => (float)$this->getCodPrice(),
			'address' => [
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
			'items' => $this->getItemsOutput()
		];
	}

	/**
	 * Get order id
	 *
	 * @return string
	 */
	public function getOrderId()
	{
		return $this->data[self::KEY_ORDER_ID];
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
	 *
	 * @return array
	 */
	public function getItemsOutput()
	{
		$retval = [];
		/* @var OrderItemsIterator $items */
		foreach ($this->data[self::KEY_ITEMS] as $items) {
			$retval[] = $items->getOutputData();
		}
		return $retval;
	}

	/**
	 * return integer
	 */
	public function getPartnerId()
	{
		return (int)$this->data[self::KEY_PARTNER_ID];
	}

	/**
	 *
	 * @param integer $partnerId
	 * @return Order
	 */
	public function setPartnerId($partnerId)
	{
		return $this->data[self::KEY_PARTNER_ID] = $partnerId;
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
	 * return integer
	 */
	public function getCodPrice()
	{
		return $this->data[self::KEY_COD_PRICE];
	}

	/**
	 * return string
	 */
	public function getName()
	{
		return $this->data[self::KEY_NAME];
	}

	/**
	 * return string
	 */
	public function getCompany()
	{
		return $this->data[self::KEY_COMPANY];
	}

	/**
	 * return string
	 */
	public function getPhone()
	{
		return $this->data[self::KEY_PHONE];
	}

	/**
	 * return string
	 */
	public function getEmail()
	{
		return $this->data[self::KEY_EMAIL];
	}

	/**
	 * return string
	 */
	public function getStreet()
	{
		return $this->data[self::KEY_STREET];
	}

	/**
	 * return string
	 */
	public function getCity()
	{
		return $this->data[self::KEY_CITY];
	}

	/**
	 * return string
	 */
	public function getZip()
	{
		return $this->data[self::KEY_ZIP];
	}

	/**
	 * return string
	 */
	public function getCountry()
	{
		return $this->data[self::KEY_COUNTRY];
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
	 * return integer
	 */
	public function getDeliveryCodPrice()
	{
		return $this->data[self::KEY_DELIVERY_COD_PRICE];
	}

	/**
	 * return string
	 */
	public function getExternalDeliveryMethodId()
	{
		return $this->data[self::KEY_EXTERNAL_DELIVERY_METHOD_ID];
	}

	/**
	 * return integer
	 */
	public function getTransportId()
	{
		return $this->data[self::KEY_TRANSPORT_ID];
	}

	/**
	 * return string
	 */
	public function getTrackingNumber()
	{
		return $this->data[self::KEY_TRACKING_NO];
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
		return $this->data[self::KEY_DISCOUNT];
	}

	/**
	 * return integer
	 */
	public function getPaymentType()
	{
		return $this->data[self::KEY_PAYMENT_TYPE];
	}

	/**
	 * return date
	 */
	public function getCreated()
	{
		return $this->data[self::KEY_CREATED];
	}

	/**
	 * return integer
	 */
	public function getCustomerId()
	{
		return $this->data[self::KEY_CUSTOMER_ID];
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
	 * @param string $confirmed
	 * @return Order
	 */
	public function setConfirmed($confirmed = false)
	{
		$this->data[self::KEY_CONFIRMED] = $confirmed;
		return $this;
	}

	/**
	 * Check order changes
	 *
	 * @return boolean
	 */
	public function isChanged()
	{
		return !empty($this->changes);
	}

	/**
	 * Get all order changes
	 *
	 * @return array
	 */
	public function getChanges()
	{
		return $this->changes;
	}
}
