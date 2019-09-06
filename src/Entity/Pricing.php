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
	 * @return float
	 */
	public function getPrice()
	{
		return $this->data[self::KEY_PRICE];
	}

	/**
	 * @param float $price
	 *
	 * @return self
	 */
	public function setPrice($price)
	{
		$this->data[self::KEY_PRICE] = (float) $price;
		return $this;
	}

	/**
	 * @return float
	 */
	public function getPurchasePrice()
	{
		return $this->data[self::KEY_PURCHASE_PRICE];
	}

	/**
	 * @param float $purchasePrice
	 *
	 * @return self
	 */
	public function setPurchasePrice($purchasePrice)
	{
		$this->data[self::KEY_PURCHASE_PRICE] = (float) $purchasePrice;
		return $this;
	}

	/**
	 * @return float
	 */
	public function getRrp()
	{
		return $this->data[self::KEY_RRP_PRICE];
	}

	/**
	 * @param float $rrp
	 *
	 * @return self
	 */
	public function setRrp($rrp)
	{
		$this->data[self::KEY_RRP_PRICE] = (float) $rrp;
		return $this;
	}
}
