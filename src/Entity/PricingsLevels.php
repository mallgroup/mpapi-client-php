<?php
namespace MPAPI\Entity\Delivery;

use MPAPI\Entity\AbstractEntity;

/**
 * Delivery pricings levels entity
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class PricingsLevels extends AbstractEntity
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
	 * @return PricingsLevels
	 */
	public function addData($type, $price, $codPrice, $limit)
	{
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
