<?php
namespace MPAPI\Entity;

use MPAPI\Exceptions\AvailabilityBadStatusException;
use MPAPI\Exceptions\AvailabilityBadInStockValueException;

/**
 * Availability entity
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class Availability extends AbstractEntity
{

	/**
	 *
	 * @var string
	 */
	const STATUS_ACTIVE = 'A';

	/**
	 *
	 * @var string
	 */
	const STATUS_INACTIVE = 'N';

	/**
	 *
	 * @var string
	 */
	const KEY_STATUS = 'status';

	/**
	 *
	 * @var string
	 */
	const KEY_IN_STOCK = 'in_stock';

	/**
	 *
	 * @var string
	 */
	private $productId;

	/**
	 *
	 * @var array
	 */
	private $allowedStatuses = [
		self::STATUS_ACTIVE,
		self::STATUS_INACTIVE
	];

	/**
	 *
	 * @var array
	 */
	protected $data;

	/**
	 *
	 * @param integer $inStock
	 * @param string $status
	 */
	public function __construct($inStock, $status = self::STATUS_ACTIVE)
	{
		$this->setInStock($inStock);
		$this->setStatus($status);
	}

	/**
	 *
	 * @see \MPAPI\Entity\AbstractEntity::getData()
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * Get product availability status
	 *
	 * @return string
	 */
	public function getStatus()
	{
		return $this->data[self::KEY_STATUS];
	}

	/**
	 * Set availability status
	 *
	 * @param string $status
	 * @return Availability
	 */
	public function setStatus($status)
	{
		if (!in_array($status, $this->allowedStatuses)) {
			throw new AvailabilityBadStatusException($status, $this->allowedStatuses);
		}
		
		$this->data[self::KEY_STATUS] = $status;
		return $this;
	}

	/**
	 * Get product in stock amount
	 *
	 * @return integer
	 */
	public function getInStock()
	{
		return (int) $this->data[self::KEY_IN_STOCK];
	}

	/**
	 *
	 * @param integer $amount
	 * @return Availability
	 */
	public function setInStock($amount)
	{
		if (!is_numeric($amount)) {
			throw new AvailabilityBadInStockValueException();
		}
		
		$this->data[self::KEY_IN_STOCK] = $amount;
		
		return $this;
	}

	/**
	 * Check is product active
	 *
	 * @return boolean
	 */
	public function isActive()
	{
		return $this->getStatus() == self::STATUS_ACTIVE;
	}

	/**
	 * Check is product on stock
	 *
	 * @return boolean
	 */
	public function isOnStock()
	{
		return $this->getInStock() > 0;
	}
}
