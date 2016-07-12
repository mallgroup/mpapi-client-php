<?php
namespace Marketplace\Validators;

use Marketplace\Entity\Product;
use Marketplace\Exception\ValidatorException;
use Marketplace\Model\PromotionMapper;

/**
 * Parameters validator
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class PromotionValidator extends AbstractValidator
{
	/**
	 *
	 * @var integer
	 */
	const MAX_LABEL_ID_LENGTH = 4;

	/**
	 *
	 * @var PromotionMapper
	 */
	protected $mapper;

	/**
	 *
	 * @param PromotionMapper $mapper
	 */
	public function __construct(PromotionMapper $mapper)
	{
		$this->mapper = $mapper;
	}

	/**
	 * Validate promotions
	 *
	 * @param array $promotions
	 * @param boolean $required
	 * @param string $objectType
	 * @throws ValidatorException
	 * @return boolean
	 */
	public function validate(array $promotions, $required = false, $objectType = self::OBJECT_TYPE_PRODUCT)
	{
		if (! empty($promotions)) {
			foreach ($promotions as $index => $promotion) {
				try {
					if (!is_array($promotion)) {
						throw $this->generateThrow(ValidatorException::MSG_PROMOTIONS_BAD_STRUCTURE);
					}

					// promotions price
					if ((double)$promotion[Product::KEY_PRICE] <= 0 || $this->validatePriceFormat($promotion[Product::KEY_PRICE]) == false) {
						throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_VALUE, $promotion[Product::KEY_PRICE], 0, Product::KEY_PRICE), [
							self::ITEM_KEY => implode('.', [$objectType, Product::KEY_PRICE])
						]);
					}
					// promotion date from
					if ($this->validateDateTime($promotion[Product::KEY_FROM]) === false) {
						throw $this->generateThrow(
							sprintf(ValidatorException::MSG_BAD_DATETIME_FORMAT, $promotion[Product::KEY_FROM]),
							[
								'key' => implode('.', [$objectType, Product::KEY_FROM]),
								'data' => $promotion[$index]
							]
						);
					}

					// promotion date to
					if ($this->validateDateTime($promotion[Product::KEY_TO]) === false) {
						throw $this->generateThrow(
							sprintf(ValidatorException::MSG_BAD_DATETIME_FORMAT, $promotion[Product::KEY_TO]),
							[
								'key' => implode('.', [$objectType, Product::KEY_TO]),
								'data' => $promotion[$index]
							]
						);
					}
					if ($this->validateHistoryDate($promotion[Product::KEY_TO]) === false) {
						throw $this->generateThrow(
							sprintf(ValidatorException::MSG_DATE_IN_HISTORY, $promotion[Product::KEY_TO]),
							[
								'key' => implode('.', [$objectType, Product::KEY_TO]),
								'data' => $promotion[$index]
							]
						);
					}
				} catch (ValidatorException $e) {
					$e->setData([
						self::ITEM_KEY => implode('.', [$objectType, Product::KEY_PROMOTIONS]),
						"data" => [
							"index" => $index,
							'data' => $promotion
						]

					]);
					throw $e;
				}
			}
		} elseif (empty($promotions) && $required === true) {
			throw $this->generateThrow(
				sprintf(ValidatorException::MSG_EMPTY_KEY, Product::KEY_PROMOTIONS)
			);
		}

		return true;
	}
}
