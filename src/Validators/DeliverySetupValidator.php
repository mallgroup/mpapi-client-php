<?php
namespace Marketplace\Validators;

use Marketplace\Exception\ValidatorException;
use Marketplace\Entity\Product;
use Marketplace\Model\DeliveryMethodMapper;

/**
 * Delivery setup validator
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class DeliverySetupValidator extends AbstractValidator
{

	/**
	 *
	 * @var DeliveryMethodMapper
	 */
	protected $mapper;

	/**
	 *
	 * @param DeliverySetupMapper $mapper
	 */
	public function __construct(DeliveryMethodMapper $mapper)
	{
		$this->mapper = $mapper;
	}

	/**
	 * Validate delivery setup
	 *
	 * @param array $deliverySetup
	 * @param boolean $required
	 * @param string $objectType
	 * @throws ValidatorException
	 * @return boolean
	 */
	public function validate(array $deliverySetup)
	{
		if (!empty($deliverySetup)) {
			foreach ($deliverySetup as $setup) {
				$this->validateExist($deliverySetup, $setup);
			}
		}

		return true;
	}

	/**
	 *
	 * @param string $deliverySetupId
	 * @param integer $partnerId
	 * @return boolean
	 */
	public function validateExist($deliverySetupId, $partnerId)
	{
		if (!empty($deliverySetupId) && !empty($partnerId)) {
			if ($this->validateTypeWord($deliverySetupId) === false) {
				throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_WORD, $deliverySetupId, Product::KEY_DELIVERY_SETUP), [
					'key' => implode('.', [
						self::OBJECT_TYPE_PRODUCT,
						Product::KEY_DELIVERY_SETUP
					])
				]);
			}

			if ($this->mapper->checkDeliverySetupExists($deliverySetupId, $partnerId) === false) {
				throw $this->generateThrow(sprintf(ValidatorException::MSG_DELIVERY_SETUP_NOT_FOUND, $deliverySetupId, $partnerId), [
					'key' => implode('.', [
						self::OBJECT_TYPE_PRODUCT,
						Product::KEY_DELIVERY_SETUP
					])
				]);
			}
		}
		return true;
	}
}
