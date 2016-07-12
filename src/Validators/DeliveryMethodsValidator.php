<?php
namespace Marketplace\Validators;

use Marketplace\Entity\DeliveryMethod;
use Marketplace\Entity\DeliverySetupPricing;
use Marketplace\Exception\ValidatorException;

/**
 * Parameters validator
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class DeliveryMethodsValidator extends AbstractValidator
{
	/**
	 *
	 * @var string
	 */
	const DELIVERY_METHODS = 'delivery_methods';

	/**
	 *
	 * @var string
	 */
	const DELIVERY_SETUPS = 'delivery_setups';

	/**
	 *
	 * @var array
	 */
	protected $sourceStructure = [
		'id' => self::VAR_TYPE_STRING,
		DeliveryMethod::KEY_TITLE => self::VAR_TYPE_STRING,
		DeliveryMethod::KEY_PRICE => [
			self::VAR_TYPE_INTEGER,
			self::VAR_TYPE_DOUBLE
		],
		DeliveryMethod::KEY_COD_PRICE => [
			self::VAR_TYPE_INTEGER,
			self::VAR_TYPE_DOUBLE
		],
		DeliveryMethod::KEY_FREE_LIMIT => [
			self::VAR_TYPE_INTEGER,
			self::VAR_TYPE_DOUBLE
		],
		DeliveryMethod::KEY_DELIVERY_DELAY => [
			self::VAR_TYPE_INTEGER,
			self::VAR_TYPE_DOUBLE
		]
	];

	/**
	 *
	 * @var array
	 */
	protected $deliverySetupSourceStructure = [
		'id' => self::VAR_TYPE_STRING,
		'pricing' => self::VAR_TYPE_ARRAY
	];

	/**
	 *
	 * @var array
	 */
	protected $pricingSourceStructure = [
		'id' => self::VAR_TYPE_STRING,
		DeliverySetupPricing::KEY_PRICE => [
			self::VAR_TYPE_INTEGER,
			self::VAR_TYPE_DOUBLE
		],
		DeliverySetupPricing::KEY_COD_PRICE => [
			self::VAR_TYPE_INTEGER,
			self::VAR_TYPE_DOUBLE
		],
		DeliverySetupPricing::KEY_FREE_LIMIT => [
			self::VAR_TYPE_INTEGER,
			self::VAR_TYPE_DOUBLE
		],
		DeliverySetupPricing::KEY_DELIVERY_DELAY => [
			self::VAR_TYPE_INTEGER,
			self::VAR_TYPE_DOUBLE
		]
	];

	/**
	 * Validate delivery methods
	 *
	 * @param array $validationData
	 * @throws ValidatorException
	 * @return boolean
	 */
	public function validate($validationData)
	{
		if (empty($validationData) || !is_array($validationData)) {
			throw $this->generateThrow(ValidatorException::MSG_BAD_DATASTRUCTURE);
		}

		if (!isset($validationData[self::DELIVERY_METHODS]) || $validationData[self::DELIVERY_METHODS] === null) {
			throw $this->generateThrow(ValidatorException::MSG_MISSING_DELIVERY_METHODS);
		}

		foreach ($validationData[self::DELIVERY_METHODS] as $delivery_method) {
			$methodCurrentPosition = implode('/', [
				self::DELIVERY_METHODS,
				array_search($delivery_method, $validationData[self::DELIVERY_METHODS])
			]);
			$this->validateStructure($delivery_method, $this->sourceStructure, $methodCurrentPosition);
			// ID validate
			if ($this->validateLength($delivery_method['id'], 50, 1) === false) {
				throw $this->generateThrow(sprintf(
					ValidatorException::MSG_INVALID_VALUE_BETWEEN,
					'id',
					$validationData[$delivery_method['id']],
					1,
					50
				));
			}
			// Title validate
			if ($this->validateLength($delivery_method[DeliveryMethod::KEY_TITLE], 200, 1) === false) {
				throw $this->generateThrow(sprintf(
					ValidatorException::MSG_INVALID_VALUE_BETWEEN,
					DeliveryMethod::KEY_TITLE,
					$validationData[$delivery_method[DeliveryMethod::KEY_TITLE]],
					1,
					200
				));
			}
			//Price validate
			if ($delivery_method[DeliveryMethod::KEY_PRICE] < 0) {
				throw $this->generateThrow(sprintf(
					ValidatorException::MSG_INVALID_FLOAT_VALUE_MIN,
					implode('/', [$methodCurrentPosition, DeliveryMethod::KEY_PRICE]),
					$delivery_method[DeliveryMethod::KEY_PRICE],
					0,
					0
				));
			}
			//COD price validate
			if ($delivery_method[DeliveryMethod::KEY_COD_PRICE] < 0) {
				throw $this->generateThrow(sprintf(
					ValidatorException::MSG_INVALID_FLOAT_VALUE_MIN,
					implode('/', [$methodCurrentPosition, DeliveryMethod::KEY_COD_PRICE]),
					$delivery_method[DeliveryMethod::KEY_COD_PRICE],
					0,
					0
				));
			}
			//Free limit validate
			if ($delivery_method[DeliveryMethod::KEY_FREE_LIMIT] < 0) {
				throw $this->generateThrow(sprintf(
					ValidatorException::MSG_INVALID_FLOAT_VALUE_MIN,
					implode('/', [$methodCurrentPosition, DeliveryMethod::KEY_FREE_LIMIT]),
					$delivery_method[DeliveryMethod::KEY_FREE_LIMIT],
					0,
					0
				));
			}
			//Delivery delay validate
			if ($delivery_method[DeliveryMethod::KEY_DELIVERY_DELAY] < 0) {
				throw $this->generateThrow(sprintf(
					ValidatorException::MSG_INVALID_VALUE,
					$delivery_method[DeliveryMethod::KEY_DELIVERY_DELAY],
					0,
					implode('/', [$methodCurrentPosition, DeliveryMethod::KEY_DELIVERY_DELAY])
				));
			}
			// is pick up point validate
			if (isset($delivery_method[DeliveryMethod::KEY_IS_PICKUP_POINT]) &&
				is_bool($delivery_method[DeliveryMethod::KEY_IS_PICKUP_POINT]) === false) {
				throw $this->generateThrow(sprintf(
					ValidatorException::MSG_BAD_DATE_TYPE,
					implode('/', [$methodCurrentPosition, DeliveryMethod::KEY_IS_PICKUP_POINT]),
					gettype($delivery_method[DeliveryMethod::KEY_IS_PICKUP_POINT]),
					'bool'
				));
			}
		}
		if (isset($validationData[self::DELIVERY_SETUPS]) && is_array($validationData[self::DELIVERY_SETUPS])) {
			$this->validateDeliverySetups($validationData);
		}

		return true;
	}

	/**
	 * Validate delivery setups
	 *
	 * @param $validationData
	 * @throws ValidatorException
	 * @return boolean
	 */
	public function validateDeliverySetups($validationData)
	{
		foreach ($validationData[self::DELIVERY_SETUPS] as $delivery_setup) {
			$setupCurrentPosition = implode('/', [
				self::DELIVERY_SETUPS,
				array_search($delivery_setup, $validationData[self::DELIVERY_SETUPS])
			]);
			$this->validateStructure(
				$delivery_setup,
				$this->deliverySetupSourceStructure,
				implode('/', [$setupCurrentPosition])
			);
			// ID validate
			if ($this->validateLength($delivery_setup['id'], 50, 1) === false) {
				throw $this->generateThrow(sprintf(
					ValidatorException::MSG_INVALID_VALUE_BETWEEN,
					implode('/', [$setupCurrentPosition, 'id']),
					$validationData[$delivery_setup['id']],
					1,
					50
				));
			}
			//Pricing
			foreach ($delivery_setup['pricing'] as $pricing) {
				$pricingCurrentPosition = implode('/', [
					$setupCurrentPosition,
					'pricing',
					array_search($pricing, $delivery_setup['pricing'])
				]);
				$this->validateStructure($pricing, $this->pricingSourceStructure, $pricingCurrentPosition);
				// ID validate
				if (in_array($pricing['id'], array_column($validationData[self::DELIVERY_METHODS], 'id')) === false) {
					throw $this->generateThrow(sprintf(
						ValidatorException::MSG_DELIVERY_METHOD_ID_NOT_FOUND,
						implode('/', [$pricingCurrentPosition, 'id']),
						$pricing['id']
					));
				}
				//Price validate
				if ($pricing[DeliverySetupPricing::KEY_PRICE] < 0) {
					throw $this->generateThrow(sprintf(
						ValidatorException::MSG_INVALID_FLOAT_VALUE_MIN,
						implode('/', [$pricingCurrentPosition, DeliverySetupPricing::KEY_PRICE]),
						$pricing[DeliverySetupPricing::KEY_PRICE],
						0,
						0
					));
				}
				//COD price validate
				if ($pricing[DeliverySetupPricing::KEY_COD_PRICE] < 0) {
					throw $this->generateThrow(sprintf(
						ValidatorException::MSG_INVALID_FLOAT_VALUE_MIN,
						implode('/', [$pricingCurrentPosition, DeliverySetupPricing::KEY_COD_PRICE]),
						$pricing[DeliverySetupPricing::KEY_COD_PRICE],
						0,
						0
					));
				}
				//Free limit validate
				if ($pricing[DeliverySetupPricing::KEY_FREE_LIMIT] < 0) {
					throw $this->generateThrow(sprintf(
						ValidatorException::MSG_INVALID_FLOAT_VALUE_MIN,
						implode('/', [$pricingCurrentPosition, DeliverySetupPricing::KEY_FREE_LIMIT]),
						$pricing[DeliverySetupPricing::KEY_FREE_LIMIT],
						0,
						0
					));
				}
				//Delivery delay validate
				if ($pricing[DeliveryMethod::KEY_DELIVERY_DELAY] < 0) {
					throw $this->generateThrow(sprintf(
						ValidatorException::MSG_INVALID_VALUE,
						$pricing[DeliverySetupPricing::KEY_DELIVERY_DELAY],
						0,
						implode('/', [$pricingCurrentPosition, DeliverySetupPricing::KEY_DELIVERY_DELAY])
					));
				}
			}
		}

		return true;
	}
}
