<?php
namespace Marketplace\Validators;

use Marketplace\Entity\Partner;
use Marketplace\Exception\ValidatorException;
use Marketplace\Model\PartnerMapper;
use Marketplace\Validators\ParametersValidator;
use Marketplace\Entity\Product;
use Marketplace\Model\ProductMapper;
use Marketplace\Validators\LabelsValidator;
use Marketplace\Validators\MediaValidator;
use Psr\Log\LoggerInterface;

/**
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class ProductValidator extends AbstractValidator
{
	/**
	 *
	 * @var integer
	 */
	const MAX_VARIABLE_PARAMETERS = 2;

	/**
	 *
	 * @var PartnerMapper
	 */
	protected $partnerMapper;

	/**
	 *
	 * @var ProductMapper
	 */
	protected $mapper;

	/**
	 *
	 * @var ParametersValidator
	 */
	private $paramValidator;

	/**
	 *
	 * @var LabelsValidator
	 */
	private $labelsValidator;

	/**
	 *
	 * @var MediaValidator
	 */
	private $mediaValidator;

	/**
	 *
	 * @var PromotionValidator
	 */
	private $promotionValidator;

	/**
	 *
	 * @var VariantValidator
	 */
	private $variantValidator;

	/**
	 *
	 * @var LoggerInterface
	 */
	protected $logger;

	/**
	 *
	 * @var DeliverySetupValidator
	 */
	protected $deliverySetupValidator;

	/**
	 *
	 * @var RecommendedValidator
	 */
	protected $recommendedValidator;

	/**
	 *
	 * @var array
	 */
	protected $sourceStructure = [
		Product::KEY_ID => self::VAR_TYPE_STRING,
		Product::KEY_CATEGORY_ID => self::VAR_TYPE_STRING,
		Product::KEY_TITLE => self::VAR_TYPE_STRING,
		Product::KEY_SHORTDESC => self::VAR_TYPE_STRING,
		Product::KEY_LONGDESC => self::VAR_TYPE_STRING,
		Product::KEY_PRIORITY => self::VAR_TYPE_INTEGER,
		Product::KEY_MEDIA => self::VAR_TYPE_ARRAY,
		Product::KEY_VAT => self::VAR_TYPE_INTEGER
	];

	/**
	 * ProductValidator constructor.
	 * @param ProductMapper $mapper
	 * @param ParametersValidator $paramValidator
	 * @param LabelsValidator $labelValidator
	 * @param MediaValidator $mediaValidator
	 * @param PromotionValidator $promotionValidator
	 * @param DeliverySetupValidator $deliverySetupValidator
	 * @param RecommendedValidator $recommendedValidator
	 * @param VariantValidator $variantValidator
	 * @param PartnerMapper $partnerMapper
	 * @param LoggerInterface $logger
	 */
	public function __construct(
		ProductMapper $mapper,
		ParametersValidator $paramValidator,
		LabelsValidator $labelValidator,
		MediaValidator $mediaValidator,
		PromotionValidator $promotionValidator,
		DeliverySetupValidator $deliverySetupValidator,
		RecommendedValidator $recommendedValidator,
		VariantValidator $variantValidator,
		PartnerMapper $partnerMapper,
		LoggerInterface $logger
	) {
		$this->mapper = $mapper;
		$this->paramValidator = $paramValidator;
		$this->labelsValidator = $labelValidator;
		$this->mediaValidator = $mediaValidator;
		$this->promotionValidator = $promotionValidator;
		$this->deliverySetupValidator = $deliverySetupValidator;
		$this->recommendedValidator = $recommendedValidator;
		$this->variantValidator = $variantValidator;
		$this->partnerMapper = $partnerMapper;
		$this->logger = $logger;
	}

	/**
	 * @param array $validationData
	 * @param Partner $partner
	 * @param string $requestMethod
	 * @param string $forceToken
	 * @throws ValidatorException
	 */
	public function validate($validationData, $partner, $requestMethod, $forceToken = null)
	{
		if (empty($validationData) || !is_array($validationData)) {
			throw $this->generateThrow(ValidatorException::MSG_BAD_DATASTRUCTURE);
		}

		$this->validateStructure($validationData, $this->sourceStructure);
		// product id
		if ($this->validateLength($validationData[Product::KEY_ID], 13) === false) {
			throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_VALUE_MAX_LENGTH, Product::KEY_ID, $validationData[Product::KEY_ID], 13), [
				self::ITEM_KEY => implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_ID])
			]);
		}
		// product category_id
		if ($this->validateLength($validationData[Product::KEY_CATEGORY_ID], 10) === false) {
			throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_VALUE_MAX_LENGTH, Product::KEY_CATEGORY_ID, $validationData[Product::KEY_CATEGORY_ID], 10), [
				self::ITEM_KEY => implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_CATEGORY_ID])
			]);
		}
		// validate and check existing category
		$this->validateCategory($validationData[Product::KEY_CATEGORY_ID], $partner->getPartnerId());

		// product title
		if ($this->validateLength($validationData[Product::KEY_TITLE], 200, 0) === false) {
			throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_VALUE_BETWEEN, Product::KEY_TITLE, $validationData[Product::KEY_TITLE], 0, 200), [
				self::ITEM_KEY => implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_TITLE])
			]);
		}
		// product shortdesc
		if ($this->validateLength($validationData[Product::KEY_SHORTDESC], 2000) === false) {
			throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_VALUE_MAX_LENGTH, Product::KEY_SHORTDESC, $validationData[Product::KEY_SHORTDESC], 2000), [
				self::ITEM_KEY => implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_SHORTDESC])
			]);
		}
		// product vat
		$this->validateVat($validationData[Product::KEY_VAT], $partner->getShopId());

		// product brand_id
		if (isset($validationData[Product::KEY_BRAND_ID])) {
			$this->validateBrandId($validationData);
		}

		// product longdesc
		if ($this->validateLength($validationData[Product::KEY_LONGDESC], self::MAX_LONGDESC_LENGTH) === false) {
			throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_VALUE_MAX_LENGTH, Product::KEY_LONGDESC, $validationData[Product::KEY_LONGDESC], self::MAX_LONGDESC_LENGTH), [
				self::ITEM_KEY => implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_LONGDESC])
			]);
		}
		// product priority
		if ($validationData[Product::KEY_PRIORITY] === 0) {
			throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_VALUE, $validationData[Product::KEY_PRIORITY], 0, Product::KEY_PRIORITY), [
				self::ITEM_KEY => implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_PRIORITY])
			]);
		}
		// product delivery_setup
		if (isset($validationData[Product::KEY_DELIVERY_SETUP])) {
			$this->deliverySetupValidator->validateExist($validationData[Product::KEY_DELIVERY_SETUP], $partner->getPartnerId());
		}

		// product with/without variants
		if (!isset($validationData[Product::KEY_VARIANTS]) && empty($validationData[Product::KEY_VARIANTS]) === true) {
			// product barcode (EAN)
			if (isset($validationData[Product::KEY_BARCODE]) && $this->validateLength($validationData[Product::KEY_BARCODE], 13) === false) {
				throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_VALUE_MAX_LENGTH, Product::KEY_BARCODE, $validationData[Product::KEY_BARCODE], 13), [
					self::ITEM_KEY => implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_BARCODE])
				]);
			}
			// product rrp
			if (isset($validationData[Product::KEY_RRP_PRICE])) {
				$this->validatePriceRound($validationData[Product::KEY_RRP_PRICE], Product::KEY_RRP_PRICE);
			}
			// product price
			if ($validationData[Product::KEY_PRICE] <= 0) {
				throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_VALUE, $validationData[Product::KEY_PRICE], 0, Product::KEY_PRICE), [
					self::ITEM_KEY => implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_PRICE])
				]);
			}
			$this->validateBigDifferencePrice($validationData[Product::KEY_ID], $validationData[Product::KEY_PRICE], $partner->getPartnerId(), 0, $forceToken);
			$this->validatePriceRound($validationData[Product::KEY_PRICE], Product::KEY_PRICE);

			// product promotions
			if (isset($validationData[Product::KEY_PROMOTIONS])) {
				$this->promotionValidator->validate($validationData[Product::KEY_PROMOTIONS]);
			}

			// product media
			if (isset($validationData[Product::KEY_MEDIA]) && ! empty($validationData[Product::KEY_MEDIA])) {
				$this->mediaValidator->validate($validationData[Product::KEY_MEDIA]);
			}

			// validate recommended variants for product
			if (isset($validationData[Product::KEY_RECOMMENDED]) && !empty($validationData[Product::KEY_RECOMMENDED])) {
				$recommended = is_array($validationData[Product::KEY_RECOMMENDED]) ?$validationData[Product::KEY_RECOMMENDED] : [$validationData[Product::KEY_RECOMMENDED]];
				$this->recommendedValidator->validate($recommended);
			}
		} else {
			if (isset($validationData[Product::KEY_VARIABLE_PARAMETERS]) && !empty($validationData[Product::KEY_VARIABLE_PARAMETERS])) {
				$productParameters = isset($validationData[Product::KEY_PARAMETERS]) ? $validationData[Product::KEY_PARAMETERS] : [];
				$this->validateVariableParameters(
					$validationData[Product::KEY_VARIABLE_PARAMETERS],
					$validationData[Product::KEY_CATEGORY_ID],
					$validationData[Product::KEY_VARIANTS],
					$productParameters
				);
			}

			$this->variantValidator->validate($validationData, $partner, $requestMethod, $forceToken);
		}
		// product parameters
		if (isset($validationData[Product::KEY_PARAMETERS]) && ! empty($validationData[Product::KEY_PARAMETERS])) {
			$this->paramValidator->validate($validationData[Product::KEY_PARAMETERS], $validationData[Product::KEY_CATEGORY_ID]);
		}
		// product labels
		if (isset($validationData[Product::KEY_LABELS]) && ! empty($validationData[Product::KEY_LABELS])) {
			$this->labelsValidator->validate($validationData[Product::KEY_LABELS]);
		}
		// product status
		if (isset($validationData[Product::KEY_AVAILABILITY]) && is_array($validationData[Product::KEY_AVAILABILITY])) {
			$this->validateAvailability($validationData[Product::KEY_AVAILABILITY], $requestMethod);
		}
	}

	/**
	 * Validate brand ID
	 *
	 * @param array
	 * @throws ValidatorException
	 * @return boolean
	 */
	public function validateBrandId($validationData)
	{
		$brandId = $validationData[Product::KEY_BRAND_ID];

		if ($brandId !== null) {
			if ($this->validateTypeWord($validationData[Product::KEY_BRAND_ID]) === false) {
				throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_WORD, $validationData[Product::KEY_BRAND_ID], Product::KEY_BRAND_ID), [
					self::ITEM_KEY => implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_BRAND_ID])
				]);
			}

			if (!$this->mapper->checkBrandExist(strtoupper($brandId))) {
				throw $this->generateThrow(sprintf(ValidatorException::MSG_UNKNOWN_BRAND_ID, $brandId), [
					self::ITEM_KEY => implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_BRAND_ID])
				]);
			}
		}

		return true;
	}

	/**
	 * Validation of parnter category
	 *
	 * @param string $categoryId
	 * @param string $partnerId
	 * @throws ValidatorException
	 * @return boolean
	 */
	public function validateCategory($categoryId, $partnerId)
	{
		if (!$this->partnerMapper->checkCategoryExist($categoryId, $partnerId)) {
			throw $this->generateThrow(sprintf(ValidatorException::MSG_UNKNOWN_CATEGORY_ID, $categoryId), [
				self::ITEM_KEY => self::OBJECT_TYPE_PRODUCT
			]);
		}
		return true;
	}

	/**
	 * Validate product variable parameters.
	 *
	 * @param array $variableParameters
	 * @param string $categoryId
	 * @param array $variants
	 * @param array $parameters
	 * @throws ValidatorException
	 * @return boolean
	 */
	public function validateVariableParameters(array $variableParameters, $categoryId, array $variants, array $parameters = [])
	{
		$multipleParams = [];
		// find multiple params in a product params
		foreach ($parameters as $paramId => $paramValue) {
			if (is_array($paramValue)) {
				$multipleParams[] = $paramId;
			}
		}

		// find multiple params in a variant params
		foreach ($variants as $variant) {
			foreach ($variant['parameters'] as $paramId => $paramValue) {
				if (is_array($paramValue)) {
					$multipleParams[] = $paramId;
				}
			}
		}

		$paramsCount = count($variableParameters);
		if ($paramsCount > self::MAX_VARIABLE_PARAMETERS) {
			throw $this->generateThrow(sprintf(ValidatorException::MSG_TOO_MANY_VARIABLE_PARAM, self::MAX_VARIABLE_PARAMETERS, $paramsCount), [
				self::ITEM_KEY => implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_VARIABLE_PARAMETERS])
			]);
		}
		foreach ($variableParameters as $parameter) {
			$this->validateLength($parameter, 50);

			if (in_array($parameter, $multipleParams)) {
				throw $this->generateThrow(sprintf(ValidatorException::MSG_MULTIPLE_PARAM_CANNOT_BE_VARIABLE, $parameter), [
					self::ITEM_KEY => implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_VARIABLE_PARAMETERS])
				]);
			}

			if (!$this->paramValidator->validateParamExist($parameter, $categoryId)) {
				throw $this->generateThrow(sprintf(ValidatorException::MSG_UNKNOWN_PARAM, $parameter), [
					self::ITEM_KEY => implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_VARIABLE_PARAMETERS])
				]);
			}
		}
		return true;
	}
}
