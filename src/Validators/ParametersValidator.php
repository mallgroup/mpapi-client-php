<?php
namespace Marketplace\Validators;

use Marketplace\Model\ParameterMapper;
use Marketplace\Exception\ValidatorException;
use Marketplace\Entity\Product;

/**
 * Parameters validator
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class ParametersValidator extends AbstractValidator
{
	/**
	 *
	 * @var integer
	 */
	const MAX_PARAM_VALUE_LENGTH = 50;

	/**
	 *
	 * @var ParameterMapper
	 */
	protected $mapper;

	/**
	 *
	 * @param ParameterMapper $mapper
	 */
	public function __construct(ParameterMapper $mapper)
	{
		$this->mapper = $mapper;
	}

	/**
	 * Validate parameters
	 *
	 * @param array $parameters
	 * @param string $categoryId
	 * @param boolean $checkMissingParams
	 * @param string $objectType
	 * @throws ValidatorException
	 * @return boolean
	 */
	public function validate(array $parameters, $categoryId, $checkMissingParams = false, $objectType = self::OBJECT_TYPE_PRODUCT)
	{
		$categoryParams = $this->mapper->getCategoryParams($categoryId);
		foreach ($parameters as $paramId => $paramValue) {
			if (!isset($categoryParams[$paramId])) {
				$e = $this->generateThrow(
					sprintf(ValidatorException::MSG_PARAM_NOT_EXIST, $paramId, $categoryId),
					[
						'key' => $objectType,
						'data' => [
							'item' => Product::KEY_PARAMETERS,
							'data' => $parameters
						]
					]
				);
				throw $e;
			}

			if (in_array($paramId, $categoryParams)) {
				unset($categoryParams[$paramId]);
			}

			if (empty($paramValue)) {
				$e = $this->generateThrow(
					sprintf(ValidatorException::MSG_EMPTY_PARAMETER_VALUE, $paramId),
					[
						'key' => implode('.', [$objectType, Product::KEY_PARAMETERS])
					]
				);
				throw $e;
			}

			if (is_array($paramValue)) {
				foreach ($paramValue as $value) {
					$this->validateValueLength($value, $paramId, $objectType);
				}
			} else {
				$this->validateValueLength($paramValue, $paramId, $objectType);
			}
		}

		// if there are any params then the product is missing these parameters
		if (!empty($categoryParams) && $checkMissingParams === true) {
			$missingParam = (count($categoryParams) > 1) ? implode(self::PARAM_GLUE, array_keys($categoryParams)) : current($categoryParams);
			throw $this->generateThrow(sprintf(ValidatorException::MSG_MISSING_CATEGORY_PARAM, $missingParam), [
				'key' => implode('.', [$objectType, Product::KEY_PARAMETERS])
			]);
		}

		return true;
	}

	/**
	 * Validate label exist
	 *
	 * @param string $paramId
	 * @param string $categoryId
	 * @return boolean
	 */
	public function validateParamExist($paramId, $categoryId)
	{
		return $this->mapper->checkParamExist($paramId, $categoryId);
	}

	/**
	 * Validate length of param value
	 *
	 * @param string $value
	 * @param string $objectType
	 * @throws \Marketplace\Exception\ValidatorException
	 * @return boolean
	 */
	private function validateValueLength($value, $paramId, $objectType = self::OBJECT_TYPE_PRODUCT)
	{
		if (strlen($value) > self::MAX_PARAM_VALUE_LENGTH) {
			$e = $this->generateThrow(
				sprintf(ValidatorException::MSG_TOO_LONG_PARAM_VALUE, $paramId, self::MAX_PARAM_VALUE_LENGTH),
				['key' => implode('.', [$objectType, Product::KEY_PARAMETERS])]
			);
			throw $e;
		}
		return true;
	}
}
