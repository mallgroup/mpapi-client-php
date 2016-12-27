<?php
namespace Marketplace\Validators;

use Marketplace\Entity\Product;
use Marketplace\Exception\ValidatorException;
use Marketplace\Model\BaseMapper;
use Marketplace\Model\PartnerMapper;
use Psr\Log\LoggerInterface;

abstract class AbstractValidator
{
	/**
	 * @var string
	 */
	const OBJECT_TYPE_PRODUCT = 'product';

	/**
	 * @var string
	 */
	const OBJECT_TYPE_VARIANT = 'variant';

	/**
	 *
	 * @var string
	 */
	const ITEM_KEY = 'key';

	/**
	 *
	 * @var string
	 */
	const PARAM_GLUE = ', ';

	/**
	 *
	 * @var string
	 */
	const DATETIME_PATTERN = '/^(?P<year>\d{4})-(?P<month>\d{2})-(?P<day>\d{2}) (?P<hour>\d{2}):(?P<minute>\d{2}):(?P<second>\d{2})$/';

	/**
	 *
	 * @var string
	 */
	const PRICE_FORMAT_PATTERN = '/^(?:[1-9]\d*|0)?(?:\.\d+)?$/';

	/**
	 *
	 * @var string
	 */
	const DATE_FORMAT = 'Y-m-d';

	/**
	 *
	 * @var string
	 */
	const STATUS_ACTIVE = 'A';

	/**
	 *
	 * @var string
	 */
	const STATUS_INACTIVE = 'N';

	/**
	 *
	 * @var string
	 */
	const REQUEST_METHOD_POST = 'POST';

	/**
	 *
	 * @var string
	 */
	const VAR_TYPE_STRING = 'string';

	/**
	 *
	 * @var string
	 */
	const VAR_TYPE_ARRAY = 'array';

	/**
	 *
	 * @var string
	 */
	const VAR_TYPE_INTEGER = 'integer';

	/**
	 *
	 * @var string
	 */
	const VAR_TYPE_DOUBLE = 'double';

	/**
	 *
	 * @var integer
	 */
	const MAX_LONGDESC_LENGTH = 13000;

	/**
	 *
	 * @var bool
	 */
	protected $forceTokenUsed = false;

	/**
	 *
	 * @var array
	 */
	protected $sourceStructure = [];

	/**
	 *
	 * @var LoggerInterface
	 */
	protected $logger;

	/**
	 *
	 * @var BaseMapper
	 */
	protected $mapper;

	/**
	 *
	 * @var PartnerMapper
	 */
	protected $partnerMapper;

	/**
	 * Generate and return ValidatorException
	 *
	 * @param string $message
	 * @param array $data
	 * @param integer $code
	 * @return ValidatorException
	 */
	public function generateThrow($message, array $data = [], $code = 400)
	{
		$throw = new ValidatorException($message, $code);
		$throw->setData($data);
		return $throw;
	}

	/**
	 * Validate string length
	 *
	 * @param string $value
	 * @param integer $max
	 * @param integer $min
	 * @return boolean
	 */
	protected function validateLength($value, $max, $min = 0)
	{
		return (mb_strlen($value, 'UTF-8') <= $max && mb_strlen($value, 'UTF-8') >= $min);
	}

	/**
	 * Validate if first value is bigger then second value
	 *
	 * @param integer $value
	 * @param integer $secondValue
	 * @return boolean
	 */
	protected function validateBiggerThen($value, $secondValue)
	{
		return $value > $secondValue;
	}

	/**
	 * Validate if first value is lower then second value
	 *
	 * @param integer $value
	 * @param integer $secondValue
	 * @return boolean
	 */
	protected function validateLowerThen($value, $secondValue)
	{
		return $value < $secondValue;
	}

	/**
	 * Validate letters in the word
	 *
	 * @param string $value
	 * @return boolean
	 */
	protected function validateTypeWord($value)
	{
		return preg_match('~[a-zA-Z0-9]+~', $value);
	}

	/**
	 * Validation of date
	 *
	 * @param string $date
	 * @return boolean
	 */
	protected function validateDateTime($date)
	{
		return (bool)preg_match(self::DATETIME_PATTERN, $date);
	}

	/**
	 * Check if date is in history
	 *
	 * @param string $date
	 * @return boolean
	 */
	public function validateHistoryDate($date)
	{
		$retval = true;

		// actual date time
		$dateNow = new \DateTime();
		// validation date time
		$validationDate = new \DateTime($date);
		if ($validationDate->format(self::DATE_FORMAT) < $dateNow->format(self::DATE_FORMAT)) {
			$retval = false;
		}

		return $retval;
	}


	/**
	 * Price round validator.
	 *
	 * @param float $price
	 * @param string $key
	 * @return float
	 */
	public function validatePriceRound($price, $key)
	{
		$roundDecimals = Product::ROUND_DECIMAL;
		$roundedPrice = $this->priceRound($price, $roundDecimals);

		if ($price != $roundedPrice) {
			throw $this->generateThrow(sprintf(ValidatorException::MSG_INCORRECT_PRICE, $key, $price, $roundDecimals));
		}

		return $roundedPrice;
	}

	/**
	 * Price round for Purchase XML
	 *
	 * @param float $price
	 * @param integer $roundDecimals
	 * @throws ValidatorException
	 * @return float
	 */
	public function priceRound($price, $roundDecimals = 0)
	{
		$price = trim($price);

		if (strlen($price)) {
			$price = str_replace(',', '.', $price);

			if (!is_numeric($price)) {
				throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_PRICE_FORMAT, $price));
			}

			if ($price < 0) {
				throw $this->generateThrow(sprintf(ValidatorException::MSG_PRICE_NOT_POSITIVE, $price));
			}
		}

		$price = floatval($price);
		return round($price, intval($roundDecimals));
	}

	/**
	 * Validate product/variant price.
	 *
	 * @param integer $productId
	 * @param float $productPrice
	 * @param string $partnerId
	 * @param integer $variantId
	 * @param string $forceToken
	 * @throws ValidatorException
	 */
	public function validateBigDifferencePrice($productId, $productPrice, $partnerId, $variantId = 0, $forceToken = '')
	{
		$currentPrices = $this->mapper->getCurrentPrices($productId, $variantId, $partnerId);
		$currentPrice = $this->parseCurrentPrice($currentPrices);
		$priceDifference = $this->calculatePercentageDifference($currentPrice, $productPrice);
		$generatedForceToken = $this->createForceToken($productId, $variantId, $partnerId, $currentPrice, $productPrice, $priceDifference);

		if ($priceDifference > Product::PRICE_PERCENTAGE_LIMIT && empty($forceToken)) {
			$eventData = [
				'productId' => $productId,
				'variantId' => $variantId,
				'partnerId' => $partnerId,
				'currentPrice' => $currentPrice,
				'newPrice' => $productPrice,
				'differenceLimit' => Product::PRICE_PERCENTAGE_LIMIT,
				'priceDifference' => $priceDifference,
				'forceToken' => $generatedForceToken
			];

			$this->partnerMapper->addPartnerError($partnerId);

			$this->logger->info('mp_price_out_of_range', $eventData);
			throw $this->generateThrow(sprintf(ValidatorException::MSG_PRICE_DIFFERENCE_TOO_HIGH, $currentPrice, $productPrice, $productId, Product::PRICE_PERCENTAGE_LIMIT, $priceDifference), [
				self::ITEM_KEY => implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_VARIANTS]),
				'data' => [
					'forceToken' => $generatedForceToken,
					'variantIndex' => $variantId

				]
			]);
		} elseif ($priceDifference > Product::PRICE_PERCENTAGE_LIMIT && !empty($forceToken) && !$this->forceTokenUsed) {
			if ($generatedForceToken !== $forceToken) {
				throw $this->generateThrow(sprintf(ValidatorException::MSG_INCORRECT_FORCE_TOKEN, $forceToken));
			} else {
				$this->forceTokenUsed = true;
			}
		}
	}

	/**
	 * Parse current price.
	 *
	 * @param array $prices
	 * @return integer
	 */
	public function parseCurrentPrice(array $prices)
	{
		$currentPrice = 0;

		if (!empty($prices['variantprice'])) {
			$currentPrice = $prices['variantprice'];
		} elseif (!empty($prices['productprice'])) {
			$currentPrice = $prices['productprice'];
		}

		return $currentPrice;
	}

	/**
	 * Calculate percentage difference between two prices.
	 *
	 * @param int $currentPrice
	 * @param int $newPrice
	 * @return int
	 */
	public function calculatePercentageDifference($currentPrice, $newPrice)
	{
		$percentageDiff = 0;

		if ($currentPrice !== 0) {
			$percentageDiff = abs($currentPrice - $newPrice) / $currentPrice * 100;
		}

		return $percentageDiff;
	}

	/**
	 * Create force token for price update.
	 *
	 * @param string $productId
	 * @param string $variantId
	 * @param string $partnerId
	 * @param integer $originalPrice
	 * @param integer $newPrice
	 * @param integer $difference
	 * @return string
	 */
	public function createForceToken($productId, $variantId, $partnerId, $originalPrice, $newPrice, $difference)
	{
		return sha1($productId . $variantId . $partnerId . $originalPrice . $newPrice . $difference);
	}

	/**
	 * Is valid EAN-13.
	 *
	 * @param string $ean
	 * @return bool
	 */
	protected function validateEan($ean)
	{
		$retval = true;
		$ean = trim((string)$ean);
		$ean = str_pad($ean, 13, '0', STR_PAD_LEFT);

		if (strlen($ean) != 13) {
			return false;
		}

		$even = false;
		$sum = 0;
		$allZeroes = true;
		for ($i = 12; $i >= 0; $i--) {
			if ($allZeroes && ($ean[$i] != 0)) {
				$allZeroes = false;
			}
			if ($even === true) {
				$sum += $ean[$i] * 3;
				$even = false;
			} else {
				$sum += $ean[$i];
				$even = true;
			}
		}

		if (($sum % 10) != 0) {
			$retval = false;
		}

		if ($allZeroes) {
			$retval = false;
		}

		return $retval;
	}

	/**
	 * Validate format of price
	 *
	 * @param string $price
	 * @return boolean
	 */
	protected function validatePriceFormat($price)
	{
		return preg_match(self::PRICE_FORMAT_PATTERN, $price);
	}

	/**
	 * Validate vat rate.
	 *
	 * @param float $vatValue
	 * @param string $shopId
	 * @throws ValidatorException
	 * @return boolean
	 */
	public function validateVat($vatValue, $shopId)
	{
		if ($this->validateLength($vatValue, 99, 0) === false) {
			throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_VALUE_BETWEEN, Product::KEY_VAT, $vatValue, 0, 99), [
				self::ITEM_KEY => implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_VAT])
			]);
		}
		// TODO create shop_config in MARKETPLACET_1
		$countryId = substr($shopId, 0, 2);
		$allowedVatRates = $this->partnerMapper->getVatRates($countryId);

		if (!in_array($vatValue, $allowedVatRates)) {
			throw $this->generateThrow(sprintf(ValidatorException::MSG_NOT_EXISTS_VAT, $vatValue, implode(', ', $allowedVatRates)), [
				self::ITEM_KEY => implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_VAT])
			]);
		}

		return true;
	}

	/**
	 * Validate availability validity
	 *
	 * @param array $availability
	 * @param string $action
	 * @param boolean $requiredAvailability
	 * @param boolean $requiredStatus
	 * @param boolean $requiredInStock
	 * @return boolean
	 */
	public function validateAvailability($availability, $action, $requiredAvailability = false, $requiredStatus = false, $requiredInStock = false)
	{
		if (!empty($availability)) {
			try {
				if (!isset($availability[Product::KEY_STATUS]) && $requiredStatus) {
					throw $this->generateThrow(sprintf(ValidatorException::MSG_MISSING_STATUS));
				}
				$status = $availability[Product::KEY_STATUS];
				if (!in_array($availability[Product::KEY_STATUS], $this->getStatusOptions())) {
					throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_STATUS, $status));
				}
				// validate in stock
				if (!isset($availability[Product::KEY_IN_STOCK]) && $requiredInStock) {
					throw $this->generateThrow(sprintf(ValidatorException::MSG_MISSING_IN_STOCK));
				}
				$inStock = $availability[Product::KEY_IN_STOCK];
				if ($action == self::REQUEST_METHOD_POST) {
					if ($this->validateBiggerThen($inStock, 0) === false) {
						throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_VALUE, $inStock, 0, Product::KEY_IN_STOCK));
					}
					if ($status !== self::STATUS_ACTIVE) {
						throw $this->generateThrow(sprintf(ValidatorException::MSG_STATUS_MUST_ACTIVE, $status));
					}
				}
			} catch (ValidatorException $e) {
				$e->setData([
					self::ITEM_KEY => implode('.', [self::OBJECT_TYPE_PRODUCT, Product::KEY_AVAILABILITY]),
					'data' => [
						'data' => $availability
					]
				]);
				throw $e;
			}
		} elseif (empty($availability) && $requiredAvailability) {
			throw $this->generateThrow(sprintf(ValidatorException::MSG_EMPTY_KEY, Product::KEY_AVAILABILITY));
		}

		return true;
	}

	/**
	 * Check validate structure
	 *
	 * @param array $sourceData
	 * @param array $sourceStructure
	 * @param string $objectType
	 * @throws ValidatorException
	 * @return boolean
	 */
	protected function validateStructure(array $sourceData, array $sourceStructure, $objectType = self::OBJECT_TYPE_PRODUCT)
	{
		foreach ($sourceStructure as $itemKey => $keyType) {
			if (!isset($sourceData[$itemKey])) {
				throw $this->generateThrow(sprintf(ValidatorException::MSG_KEY_NOT_FOUND, $itemKey), [
					self::ITEM_KEY => $objectType
				]);
			} elseif ((is_array($keyType) && !in_array(gettype($sourceData[$itemKey]), $keyType)) || (!is_array($keyType) && gettype($sourceData[$itemKey]) !== $keyType)) {
				$itemType = is_array($keyType) ? implode(', ', $keyType) : $keyType;
				throw $this->generateThrow(sprintf(ValidatorException::MSG_BAD_DATE_TYPE, $itemKey, gettype($sourceData[$itemKey]), $itemType), [
					self::ITEM_KEY => $objectType
				]);
			} elseif ((is_array($sourceData[$itemKey]) && count($sourceData[$itemKey]) === 0) || is_string($sourceData[$itemKey]) && mb_strlen($sourceData[$itemKey], 'UTF-8') === 0) {
				throw $this->generateThrow(sprintf(ValidatorException::MSG_EMPTY_KEY, $itemKey), [
					self::ITEM_KEY => $objectType
				]);
			}
		}
	}

	/**
	 * Get list of product/availability status options
	 *
	 * @return array
	 */
	private function getStatusOptions()
	{
		return [
			self::STATUS_ACTIVE,
			self::STATUS_INACTIVE
		];
	}
}
