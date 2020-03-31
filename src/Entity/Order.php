<?php

namespace MPAPI\Entity;

use MPAPI\Lib\Helpers\InputDataHelper;

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
	const KEY_DELIVERED_AT = 'delivered_at';

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
	const KEY_TRACKING_URL = 'tracking_url';

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
	 * @var string
	 */
	const KEY_MDP = 'mdp';

	/**
	 * @var string
	 */
	const KEY_BRANCHES = 'branches';

	/**
	 * @var string
	 */
	const KEY_BRANCH_ID = 'branch_id';

	/**
	 * @var string
	 */
	const KEY_SECONDARY_BRANCH_ID = 'secondary_branch_id';

	/**
	 * @var string
	 */
	const KEY_OVERRIDDEN = 'overridden';

	/**
	 * @var string
	 */
	const KEY_LAST_CHANGE = 'last_change';

	/**
	 * @var string
	 */
	const KEY_FIRST_DELIVERY_ATTEMPT = 'first_delivery_attempt';

	/**
	 * @var string
	 */
	const KEY_READY_TO_RETURN = 'ready_to_return';

	/**
	 * @var string
	 */
	const KEY_SHIPPED = 'shipped';

	/**
	 * @var string
	 */
	const KEY_OPEN = 'open';

	/**
	 * @var string
	 */
	const KEY_BLOCKED = 'blocked';

	/**
	 * @var string
	 */
	const KEY_LOST = 'lost';

	/**
	 * @var string
	 */
	const KEY_RETURNED = 'returned';

	/**
	 * @var string
	 */
	const KEY_CANCELLED = 'cancelled';

	/**
	 * @var string
	 */
	const KEY_DELIVERED = 'delivered';

	/**
	 * @var string
	 */
	const KEY_SHIPPING = 'shipping';

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
			'tracking_url' => $this->getTrackingUrl(),
			'ship_date' => $this->getDeliveryDate(),
			'delivery_date' => $this->getDeliveryDate(),
			'delivered_at' => $this->getDeliveredAt(),
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
			'items' => $this->getItems(),
			'mdp' => $this->getMdp(),
			'branch_id' => $this->getBranchId(),
			'branches' => [
				'branch_id' => $this->getMainBranchId(),
				'secondary_branch_id' => $this->getSecondaryBranchId(),
				'overridden' => $this->isBranchOverridden(),
				'last_change' => $this->getBranchLastChange(),
			],
			'first_delivery_attempt' => $this->getFirstDeliveryAttempt(),
			'ready_to_return' => $this->isReadyToReturn(),
			'shipped' => $this->getShippedStatus(),
			'open' => $this->getOpenStatus(),
			'blocked' => $this->getBlockedStatus(),
			'lost' => $this->getLostStatus(),
			'returned' => $this->getReturnedStatus(),
			'cancelled' => $this->getCancelledStatus(),
			'delivered' => $this->getDeliveredStatus(),
			'shipping' => $this->getShippingStatus(),
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
	 * @return array Order items
	 */
	public function getItems()
	{
		return $this->data[self::KEY_ITEMS];
	}

	/**
	 * Get partner id
	 *
	 * @return int
	 */
	public function getPartnerId()
	{
		return InputDataHelper::getInt($this->data, [self::KEY_PARTNER_ID]);
	}

	/**
	 * Set partner id
	 *
	 * @param int $partnerId
	 * @return Order
	 */
	public function setPartnerId($partnerId)
	{
		$this->data[self::KEY_PARTNER_ID] = $partnerId;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getPurchaseId()
	{
		return $this->data[self::KEY_PURCHASE_ID];
	}

	/**
	 * @return string
	 */
	public function getCurrencyId()
	{
		return $this->data[self::KEY_CURRENCY_ID];
	}

	/**
	 * @return int
	 */
	public function getDeliveryPrice()
	{
		return $this->data[self::KEY_DELIVERY_PRICE];
	}

	/**
	 * @return string
	 */
	public function getDeliveryMethod()
	{
		return $this->data[self::KEY_DELIVERY_METHOD];
	}

	/**
	 * @return int
	 */
	public function getDeliveryMethodId()
	{
		return $this->data[self::KEY_DELIVERY_METHOD_ID];
	}

	/**
	 * @return int
	 */
	public function getDeliveryPosition()
	{
		return $this->data[self::KEY_DELIVERY_DPOSITION];
	}

	/**
	 * @return string
	 */
	public function getDeliveryDate()
	{
		return $this->data[self::KEY_DELIVERY_DATE];
	}

	/**
	 * @return string
	 */
	public function getDeliveredAt()
	{
		return InputDataHelper::getString($this->data, [self::KEY_DELIVERED_AT]);
	}

	/**
	 * @return float
	 */
	public function getCod()
	{
		return $this->data[self::KEY_COD];
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->data[self::KEY_ADDRESS][self::KEY_NAME];
	}

	/**
	 * @return string
	 */
	public function getCompany()
	{
		return InputDataHelper::getString($this->data, [self::KEY_ADDRESS, self::KEY_COMPANY]);
	}

	/**
	 * @return string
	 */
	public function getPhone()
	{
		return $this->data[self::KEY_ADDRESS][self::KEY_PHONE];
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->data[self::KEY_ADDRESS][self::KEY_EMAIL];
	}

	/**
	 * @return string
	 */
	public function getStreet()
	{
		return $this->data[self::KEY_ADDRESS][self::KEY_STREET];
	}

	/**
	 * @return string
	 */
	public function getCity()
	{
		return $this->data[self::KEY_ADDRESS][self::KEY_CITY];
	}

	/**
	 * @return string
	 */
	public function getZip()
	{
		return $this->data[self::KEY_ADDRESS][self::KEY_ZIP];
	}

	/**
	 * @return string
	 */
	public function getCountry()
	{
		return $this->data[self::KEY_ADDRESS][self::KEY_COUNTRY];
	}

	/**
	 * @return string
	 */
	public function getConfirmed()
	{
		return $this->data[self::KEY_CONFIRMED];
	}

	/**
	 * @return string
	 */
	public function getStatus()
	{
		return $this->data[self::KEY_STATUS];
	}

	/**
	 * @return double
	 */
	public function getCodPrice()
	{
		return InputDataHelper::getFloat($this->data, [self::KEY_COD_PRICE]);
	}

	/**
	 * @return int
	 */
	public function getTransportId()
	{
		return InputDataHelper::getInt($this->data, [self::KEY_TRANSPORT_ID]);
	}

	/**
	 * @return string
	 */
	public function getTrackingNumber()
	{
		return InputDataHelper::getString($this->data, [self::KEY_TRACKING_NO]);
	}

	/**
	 * @return string
	 */
	public function getTrackingUrl()
	{
		return InputDataHelper::getString($this->data, [self::KEY_TRACKING_URL]);
	}

	/**
	 * @return int
	 */
	public function getExternalOrderId()
	{
		return $this->data[self::KEY_EXTERNAL_ORDER_ID];
	}

	/**
	 * @return int
	 */
	public function getDiscount()
	{
		return InputDataHelper::getInt($this->data, [self::KEY_DISCOUNT]);
	}

	/**
	 * @return int|null
	 */
	public function getPaymentType()
	{
		return InputDataHelper::getNullableInt($this->data, [self::KEY_PAYMENT_TYPE]);
	}

	/**
	 * @return string|null
	 */
	public function getCreated()
	{
		return InputDataHelper::getNullableString($this->data, [self::KEY_CREATED]);
	}

	/**
	 * @return int|null
	 */
	public function getCustomerId()
	{
		return InputDataHelper::getNullableInt($this->data, [self::KEY_ADDRESS, self::KEY_CUSTOMER_ID]);
	}

	/**
	 * @return bool
	 */
	public function getMdp()
	{
		return (bool) $this->data[self::KEY_MDP];
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

	/**
	 * @return int|null
	 */
	public function getBranchId()
	{
		return InputDataHelper::getNullableInt($this->data, [self::KEY_BRANCH_ID]);
	}

	/**
	 * @return int|null
	 */
	public function getMainBranchId()
	{
		return InputDataHelper::getNullableInt($this->data, [self::KEY_BRANCHES, self::KEY_BRANCH_ID]);
	}

	/**
	 * @return int|null
	 */
	public function getSecondaryBranchId()
	{
		return InputDataHelper::getNullableInt($this->data, [self::KEY_BRANCHES, self::KEY_SECONDARY_BRANCH_ID]);
	}

	/**
	 * @return bool
	 */
	public function isBranchOverridden()
	{
		return (bool) $this->data[self::KEY_BRANCHES][self::KEY_OVERRIDDEN];
	}

	/**
	 * @return string|null
	 */
	public function getBranchLastChange()
	{
		return InputDataHelper::getNullableString($this->data, [self::KEY_BRANCHES, self::KEY_LAST_CHANGE]);
	}

	/**
	 * @return string|null
	 */
	public function getFirstDeliveryAttempt()
	{
		return InputDataHelper::getNullableString($this->data, [self::KEY_FIRST_DELIVERY_ATTEMPT]);
	}

	/**
	 * @return bool
	 */
	public function isReadyToReturn()
	{
		return (bool) $this->data[self::KEY_READY_TO_RETURN];
	}

	/**
	 * @return string|null
	 */
	public function getShippedStatus()
	{
		return InputDataHelper::getNullableString($this->data, [self::KEY_SHIPPED]);
	}

	/**
	 * @return string|null
	 */
	public function getOpenStatus()
	{
		return InputDataHelper::getNullableString($this->data, [self::KEY_OPEN]);
	}

	/**
	 * @return string|null
	 */
	public function getBlockedStatus()
	{
		return InputDataHelper::getNullableString($this->data, [self::KEY_BLOCKED]);
	}

	/**
	 * @return string|null
	 */
	public function getLostStatus()
	{
		return InputDataHelper::getNullableString($this->data, [self::KEY_LOST]);
	}

	/**
	 * @return string|null
	 */
	public function getReturnedStatus()
	{
		return InputDataHelper::getNullableString($this->data, [self::KEY_RETURNED]);
	}

	/**
	 * @return string|null
	 */
	public function getCancelledStatus()
	{
		return InputDataHelper::getNullableString($this->data, [self::KEY_CANCELLED]);
	}

	/**
	 * @return string|null
	 */
	public function getDeliveredStatus()
	{
		return InputDataHelper::getNullableString($this->data, [self::KEY_DELIVERED]);
	}

	/**
	 * @return string|null
	 */
	public function getShippingStatus()
	{
		return InputDataHelper::getNullableString($this->data, [self::KEY_SHIPPING]);
	}

}
