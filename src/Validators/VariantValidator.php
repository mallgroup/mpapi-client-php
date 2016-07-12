<?php
namespace Marketplace\Validators;

use Marketplace\Entity\Partner;
use Marketplace\Exception\ValidatorException;
use Marketplace\Model\PartnerMapper;
use Marketplace\Validators\ParametersValidator;
use Marketplace\Entity\Variant;
use Marketplace\Validators\LabelsValidator;
use Marketplace\Validators\MediaValidator;
use Marketplace\Model\VariantMapper;
use Marketplace\Entity\Product;
use Monolog\Logger;

/**
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class VariantValidator extends AbstractValidator
{
	/**
	 *
	 * @var string
	 */
	const ITEM_KEY = 'key';

	/**
	 *
	 * @var PartnerMapper
	 */
	protected $partnerMapper;

	/**
	 *
	 * @var VariantMapper
	 */
	protected $mapper;

	/**
	 *
	 * @var Logger
	 */
	protected $logger;

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
	 * @var DeliverySetupValidator
	 */
	private $deliverySetupValidator;

	/**
	 *
	 * @var RecommendedValidator
	 */
	private $recommendedValidator;

	/**
	 *
	 * @var PromotionValidator
	 */
	private $promotionValidator;

	/**
	 *
	 * @var array
	 */
	protected $sourceStructure = [
		Variant::KEY_ID => self::VAR_TYPE_STRING,
		Variant::KEY_TITLE => self::VAR_TYPE_STRING,
		Variant::KEY_SHORTDESC => self::VAR_TYPE_STRING,
		Variant::KEY_LONGDESC => self::VAR_TYPE_STRING,
		Variant::KEY_PRIORITY => self::VAR_TYPE_INTEGER,
		Variant::KEY_PRICE => [
			self::VAR_TYPE_INTEGER,
			self::VAR_TYPE_DOUBLE
		]
	];

	/**
	 * ProductValidator constructor.
	 * @param VariantMapper $mapper
	 * @param ParametersValidator $paramValidator
	 * @param LabelsValidator $labelValidator
	 * @param MediaValidator $mediaValidator
	 * @param RecommendedValidator $recommendedValidator
	 * @param PromotionValidator $promotionValidator
	 * @param PartnerMapper $partnerMapper
	 * @param Logger $logger
	 */
	public function __construct(
		VariantMapper $mapper,
		ParametersValidator $paramValidator,
		LabelsValidator $labelValidator,
		MediaValidator $mediaValidator,
		DeliverySetupValidator $deliverySetupValidator,
		RecommendedValidator $recommendedValidator,
		PromotionValidator $promotionValidator,
		PartnerMapper $partnerMapper,
		Logger $logger
	) {
		$this->mapper = $mapper;
		$this->paramValidator = $paramValidator;
		$this->labelsValidator = $labelValidator;
		$this->mediaValidator = $mediaValidator;
		$this->deliverySetupValidator = $deliverySetupValidator;
		$this->recommendedValidator = $recommendedValidator;
		$this->promotionValidator = $promotionValidator;
		$this->partnerMapper = $partnerMapper;
		$this->logger = $logger;
	}

	/**
	 * @param $validationData
	 * @param Partner $partner
	 * @param string $requestMethod
	 * @param string $forceToken
	 * @throws ValidatorException
	 */
	public function validate($validationData, $partner, $requestMethod, $forceToken)
	{
		if (!empty($validationData)) {
			foreach ($validationData[Product::KEY_VARIANTS] as $index => $variantData) {
				try {
					if (empty($variantData) || !is_array($variantData)) {
						throw $this->generateThrow(ValidatorException::MSG_BAD_DATASTRUCTURE);
					}
					// validate data structure
					$this->validateStructure($variantData, $this->sourceStructure, self::OBJECT_TYPE_VARIANT);
					// validate ID length
					if ($this->validateLength($variantData[Variant::KEY_ID], 13) === false) {
						throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_VALUE_MAX_LENGTH, Variant::KEY_ID, $variantData[Variant::KEY_ID], 13));
					}
					// validate title length
					if ($this->validateLength($variantData[Variant::KEY_TITLE], 100) === false) {
						throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_VALUE_MAX_LENGTH, Variant::KEY_TITLE, $variantData[Variant::KEY_TITLE], 100));
					}
					// variant shortdesc
					if ($this->validateLength($variantData[Variant::KEY_SHORTDESC], 2000) === false) {
						throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_VALUE_EAN, Variant::KEY_SHORTDESC, $variantData[Variant::KEY_SHORTDESC], 2000));
					}
					// variant longdesc
					if ($this->validateLength($variantData[Variant::KEY_LONGDESC], 4000) === false) {
						throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_VALUE_MAX_LENGTH, Variant::KEY_LONGDESC, $variantData[Variant::KEY_LONGDESC], 4000));
					}
					// variant priority
					if ($this->validateBiggerThen($variantData[Variant::KEY_PRIORITY], 0) === false) {
						throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_VALUE, $variantData[Variant::KEY_PRIORITY], 0, Variant::KEY_PRIORITY));
					}
					// validate barcode (EAN)
					if (isset($variantData[Variant::KEY_BARCODE]) && $this->validateEan($variantData[Variant::KEY_BARCODE]) === false) {
						throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_VALUE_EAN, Variant::KEY_BARCODE, $variantData[Variant::KEY_BARCODE]));
					}
					// validate price
					if ($this->validatePriceFormat($variantData[Variant::KEY_PRICE]) === false) {
						throw $this->generateThrow(sprintf(ValidatorException::MSG_BAD_PRICE_FORMAT, $variantData[Variant::KEY_PRICE]));
					}
					if ($this->validateBiggerThen($variantData[Variant::KEY_PRICE], 0) === false) {
						throw $this->generateThrow(sprintf(ValidatorException::MSG_ZERO_PRICE, $variantData[Variant::KEY_PRICE]));
					}
					// validate big difference price
					$this->validateBigDifferencePrice($validationData[Product::KEY_ID], $variantData[Variant::KEY_PRICE], $partner->getPartnerId(), $variantData[Variant::KEY_ID], $forceToken);
					$this->validatePriceRound($variantData[Variant::KEY_PRICE], Variant::KEY_PRICE);

					if (isset($variantData[Variant::KEY_RRP_PRICE])) {
						$this->validatePriceRound($variantData[Variant::KEY_RRP_PRICE], Variant::KEY_RRP_PRICE);
					}
					// validate variant availability
					if (isset($variantData[Variant::KEY_AVAILABILITY])) {
						$this->validateAvailability($variantData[Variant::KEY_AVAILABILITY], $requestMethod);
					}
					// validate recommended products/variants
					if (isset($variantData[Variant::KEY_RECOMMENDED]) && !empty($variantData[Variant::KEY_RECOMMENDED])) {
						$recommended = is_array($variantData[Variant::KEY_RECOMMENDED]) ? $variantData[Variant::KEY_RECOMMENDED] : [$variantData[Variant::KEY_RECOMMENDED]];
						$this->recommendedValidator->validate($recommended);
					}
				} catch (ValidatorException $e) {
					$data = $e->getData();
					$throwData = [];
					$throwData['variantIndex'] = $index;
					if (isset($data['data']['forceToken']) && !empty($data['data']['forceToken'])) {
						$throwData['forceToken'] = $data['data']['forceToken'];
					}
					throw $e->setData([
						self::ITEM_KEY => implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_VARIANTS]),
						'data' => $throwData
					]);
				}
				try {
					// validate variant media
					if (isset($variantData[Variant::KEY_MEDIA]) && !empty($variantData[Variant::KEY_MEDIA])) {
						$this->mediaValidator->validate($variantData[Variant::KEY_MEDIA], implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_VARIANTS]));
					} else {
						throw $this->generateThrow(sprintf(ValidatorException::MSG_EMPTY_KEY, Variant::KEY_MEDIA), [
							self::ITEM_KEY => implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_VARIANTS, Variant::KEY_MEDIA])
						]);
					}
					// validate variant parameters
					if (!empty($variantData[Variant::KEY_PARAMETERS])) {
						$this->paramValidator->validate(
							$variantData[Variant::KEY_PARAMETERS],
							$validationData[Product::KEY_CATEGORY_ID],
							false,
							implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_VARIANTS])
						);
					} else {
						throw $this->generateThrow(sprintf(ValidatorException::MSG_VARIANT_PARAMS_MISSING), [
							self::ITEM_KEY => implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_VARIANTS])
						]);
					}
					// validate variant promotions
					if (isset($variantData[Variant::KEY_PROMOTIONS]) && !empty($variantData[Variant::KEY_PROMOTIONS])) {
						$this->promotionValidator->validate(
							$variantData[Variant::KEY_PROMOTIONS],
							false,
							implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_VARIANTS])
						);
					}
				} catch (ValidatorException $e) {
					$messageData = $e->getData();
					$messageData['data']['variantIndex'] = $index;

					throw $e->setData($messageData);
				}
			}
		}

		if (!is_array($validationData)) {
			throw $this->generateThrow(ValidatorException::MSG_BAD_DATASTRUCTURE);
		}

		return true;
	}
}
