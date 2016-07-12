<?php
namespace Marketplace\Validators;

use Marketplace\Model\RecommendedMapper;
use Marketplace\Exception\ValidatorException;
use Marketplace\Entity\Variant;

/**
 * Recommended validator
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class RecommendedValidator extends AbstractValidator
{
	/**
	 *
	 * @var integer
	 */
	const RECOMMENDED_VARIANT_LIMIT = 30;

	/**
	 *
	 * @var RecommendedMapper
	 */
	protected $mapper;

	/**
	 *
	 * @param RecommendedMapper $mapper
	 */
	public function __construct(RecommendedMapper $mapper)
	{
		$this->mapper = $mapper;
	}

	/**
	 * Validate parameters
	 *
	 * @param array $variantIds
	 * @param string $objectType
	 * @throws ValidatorException
	 * @return boolean
	 */
	public function validate(array $variantIds, $objectType = self::OBJECT_TYPE_PRODUCT)
	{
		$variantCount = count($variantIds);
		if ($variantCount > self::RECOMMENDED_VARIANT_LIMIT) {
			throw $this->generateThrow(
				sprintf(ValidatorException::MSG_RECOMMENDED_OVERLIMIT, self::RECOMMENDED_VARIANT_LIMIT, $variantCount),
				['key' => implode('.', [$objectType, Variant::KEY_RECOMMENDED])]
			);
		}

		$existingVariants = $this->mapper->checkVariantExists($variantIds);
		// compare array of required and existing variants
		$missingVariants = array_diff($variantIds, array_keys($existingVariants));

		if (!empty($missingVariants)) {
			throw $this->generateThrow(
				sprintf(ValidatorException::MSG_PRODUCT_NOT_FOUND, implode(self::PARAM_GLUE, $missingVariants)),
				['key' => implode('.', [$objectType, Variant::KEY_RECOMMENDED])]
			);
		}

		return true;
	}
}
