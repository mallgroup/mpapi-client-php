<?php

namespace MPAPI\Entity;

use MPAPI\Entity\Products\AbstractArticleEntity;

/**
 * Class Pricing
 *
 * @package MPAPI\Entity
 * @author  Michal Saloň <michal.salon@mallgroup.com>
 */
class Pricing extends AbstractEntity
{
	/** @var string */
	const KEY_PRICE = AbstractArticleEntity::KEY_PRICE;

	/** @var string */
	const KEY_RRP_PRICE = AbstractArticleEntity::KEY_RRP_PRICE;

	/** @var string */
	const KEY_PURCHASE_PRICE = AbstractArticleEntity::KEY_PURCHASE_PRICE;

	/**
	 * Pricing constructor.
	 *
	 * @param $price
	 * @param $purchasePrice
	 * @param $rrp
	 */
	public function __construct($price, $purchasePrice, $rrp)
	{
		$this->setPrice($price);
		$this->setPurchasePrice($purchasePrice);
		$this->setRrp($rrp);
	}

	/**
	 * Get entity data in array
	 *
	 * @return array
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * @return int
	 */
	public function getPrice()
	{
		return $this->data[self::KEY_PRICE];
	}

	/**
	 * @param int $price
	 *
	 * @return self
	 */
	public function setPrice($price)
	{
		$this->data[self::KEY_PRICE] = (int) $price;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getPurchasePrice()
	{
		return $this->data[self::KEY_PURCHASE_PRICE];
	}

	/**
	 * @param int $purchasePrice
	 *
	 * @return self
	 */
	public function setPurchasePrice($purchasePrice)
	{
		$this->data[self::KEY_PURCHASE_PRICE] = (int) $purchasePrice;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getRrp()
	{
		return $this->data[self::KEY_RRP_PRICE];
	}

	/**
	 * @param int $rrp
	 *
	 * @return self
	 */
	public function setRrp($rrp)
	{
		$this->data[self::KEY_RRP_PRICE] = (int) $rrp;
		return $this;
	}
}
