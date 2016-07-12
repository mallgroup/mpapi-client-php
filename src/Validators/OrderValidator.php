<?php
namespace Marketplace\Validators;

use Marketplace\Exception\ValidatorException;
use Marketplace\Entity\Order;
use Marketplace\Exception\OrdersException;

/**
 * Order validator
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class OrderValidator extends AbstractValidator
{
	/**
	 *
	 * @var integer
	 */
	const MAX_PURCHASE_ID_LENGHT = 10;
	/**
	 *
	 * @var integer
	 */
	const MAX_ORDER_ID_LENGHT = 13;

	/**
	 *
	 * @var integer
	 */
	const MIN_ORDER_ID_LENGHT = 1;

	/**
	 *
	 * @var integer
	 */
	const MIN_ITEM_ID_LENGTH = 1;

	/**
	 *
	 * @var integer
	 */
	const MAX_ITEM_ID_LENGTH = 50;

	/**
	 *
	 * @var integer
	 */
	const MIN_QUANTITY = 1;

	/**
	 * Construct
	 */
	public function __construct()
	{
	}

	/**
	 * Validate order data
	 *
	 * @param array $orderData
	 * @throws ValidatorException
	 * @return boolean
	 */
	public function validate(array $orderData)
	{
		// validate order ID
		if ($this->validateBiggerThen($orderData[Order::KEY_ORDER_ID], self::MIN_ORDER_ID_LENGHT) === false) {
			throw $this->generateThrow(sprintf(OrdersException::MSG_BAD_ITEM_CONTENT, Order::KEY_ORDER_ID, 'integer', 'min', self::MIN_ORDER_ID_LENGHT));
		}
		if ($this->validateLength($orderData[Order::KEY_ORDER_ID], self::MAX_ORDER_ID_LENGHT) === false) {
			throw $this->generateThrow(sprintf(OrdersException::MSG_BAD_ITEM_CONTENT, Order::KEY_ORDER_ID, 'integer', 'max', self::MAX_ORDER_ID_LENGHT));
		}
		// validate purchase ID
		if ($this->validateLength($orderData[Order::KEY_PURCHASE_ID], self::MAX_PURCHASE_ID_LENGHT) === false) {
			throw $this->generateThrow(sprintf(OrdersException::MSG_BAD_ITEM_CONTENT, Order::KEY_PURCHASE_ID, 'integer', 'max', self::MAX_PURCHASE_ID_LENGHT));
		}
		if (!isset($orderData[Order::KEY_ITEMS])) {
			throw $this->generateThrow(sprintf(OrdersException::MSG_MISSING_KEY, Order::KEY_ITEMS));
		}
		// validate key items
		if (!is_array($orderData[Order::KEY_ITEMS]) || empty($orderData[Order::KEY_ITEMS])) {
			throw $this->generateThrow(sprintf(OrdersException::MSG_EMPTY_KEY, Order::KEY_ITEMS));
		}
		// validate items data
		$this->validateItems($orderData[Order::KEY_ITEMS]);

		return true;
	}

	/**
	 * Validate order items
	 *
	 * @param array $orderItems
	 * @return boolean
	 */
	public function validateItems(array $orderItems)
	{
		foreach ($orderItems as $index => $item) {
			// validate item id
			if (!isset($item[Order::KEY_ITEM_ID])) {
				throw $this->generateThrow(sprintf(OrdersException::MSG_MISSING_KEY, implode('.', [Order::KEY_ITEMS, $index, Order::KEY_ITEM_ID])));
			}
			if (empty($item[Order::KEY_ITEM_ID])) {
				throw $this->generateThrow(sprintf(OrdersException::MSG_EMPTY_KEY, implode('.', [Order::KEY_ITEMS, $index, Order::KEY_ITEM_ID])));
			}
			if ($this->validateLength($item[Order::KEY_ITEM_ID], self::MAX_ITEM_ID_LENGTH, self::MIN_ITEM_ID_LENGTH) === false) {
				throw $this->generateThrow(sprintf(OrdersException::MSG_BAD_LENGHT, implode('.', [Order::KEY_ITEMS, $index, Order::KEY_ITEM_ID]), self::MAX_ITEM_ID_LENGTH));
			}
			// validate item quantity
			if (!isset($item[Order::KEY_ITEM_QUANTITY])) {
				throw $this->generateThrow(sprintf(OrdersException::MSG_MISSING_KEY, implode('.', [Order::KEY_ITEMS, $index, Order::KEY_ITEM_QUANTITY])));
			}
			if ((int)$item[Order::KEY_ITEM_QUANTITY] < self::MIN_QUANTITY) {
				throw $this->generateThrow(
					sprintf(
						OrdersException::MSG_BAD_MIN_VALUE,
						implode('.', [Order::KEY_ITEMS, $index, Order::KEY_ITEM_QUANTITY]),
						$item[Order::KEY_ITEM_QUANTITY],
						self::MIN_QUANTITY
					)
				);
			}
			// validate item price
			if (!isset($item[Order::KEY_ITEM_PRICE])) {
				throw $this->generateThrow(sprintf(OrdersException::MSG_MISSING_KEY, implode('.', [Order::KEY_ITEMS, $index, Order::KEY_ITEM_PRICE])));
			}
			// validate item VAT
			if (!isset($item[Order::KEY_ITEM_VAT])) {
				throw $this->generateThrow(sprintf(OrdersException::MSG_MISSING_KEY, implode('.', [Order::KEY_ITEMS, $index, Order::KEY_ITEM_VAT])));
			}
		}

		return true;
	}
}
