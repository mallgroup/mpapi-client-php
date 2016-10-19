<?php
namespace MPAPI\Entity\Deliveries;

use MPAPI\Entity\AbstractEntity;
use MPAPI\Exceptions\PricingLevelBadTypeException;

/**
 * Delivery pricing levels entity
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class PricingLevels extends AbstractEntity
{

	/**
	 *
	 * @var string
	 */
	const KEY_TYPE = 'type';

	/**
	 *
	 * @var string
	 */
	const KEY_PRICE = 'price';

	/**
	 *
	 * @var string
	 */
	const KEY_COD_PRICE = 'cod_price';

	/**
	 *
	 * @var string
	 */
	const KEY_LIMIT = 'limit';

	/**
	 *
	 * @var string
	 */
	const TYPE_PRICE = 'p';

	/**
	 *
	 * @var string
	 */
	const TYPE_WEIGHT = 'w';

	/**
	 *
	 * @var array
	 */
	protected $data = [];

	/**
	 *
	 * @var array
	 */
	protected $allowType = [
		self::TYPE_PRICE,
		self::TYPE_WEIGHT
	];

	/**
	 * @see \MPAPI\Entity\AbstractEntity::getData()
	 */
	public function getData()
	{
		return $this->data;
	}

	/** add delivery pricing level
	 *
	 * @param string $type
	 * @param integer $price
	 * @param integer $codPrice
	 * @param integer $limit
	 * @return PricingLevels
	 */
	public function addLevel($type, $price, $codPrice, $limit)
	{
		if (!in_array($type, $this->allowType)) {
			throw new PricingLevelBadTypeException($type, $this->allowType);
		}

		$pricingLevelCurrent = [
			self::KEY_TYPE => $type,
			self::KEY_PRICE => $price,
			self::KEY_COD_PRICE => $codPrice,
			self::KEY_LIMIT => $limit
		];

		if (empty($this->data)) {
			$this->data[] = $pricingLevelCurrent;
		} else {
			$updated = false;
			foreach ($this->data as $key => $pricingLevel) {
				if ($pricingLevel[self::KEY_TYPE] === $pricingLevelCurrent[self::KEY_TYPE] &&
					$pricingLevel[self::KEY_LIMIT] === $pricingLevelCurrent[self::KEY_LIMIT]
				) {
					$this->data[$key] = $pricingLevelCurrent;
					$updated = true;
				}
			}
			if ($updated === false) {
				$this->data[] = $pricingLevelCurrent;
			}
		}
		return $this;
	}
}
