<?php
namespace Marketplace\Validators;

use Marketplace\Model\LabelMapper;
use Marketplace\Exception\ValidatorException;
use Marketplace\Entity\Product;

/**
 * Parameters validator
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class LabelsValidator extends AbstractValidator
{
	/**
	 *
	 * @var integer
	 */
	const MAX_LABEL_ID_LENGTH = 4;

	/**
	 *
	 * @var LabelMapper
	 */
	protected $mapper;

	/**
	 *
	 * @param LabelMapper $mapper
	 */
	public function __construct(LabelMapper $mapper)
	{
		$this->mapper = $mapper;
	}

	/**
	 * Validate parameters
	 *
	 * @param array $labels
	 * @param boolean $required
	 * @param string $objectType
	 * @throws ValidatorException
	 * @return boolean
	 */
	public function validate(array $labels, $required = false, $objectType = self::OBJECT_TYPE_PRODUCT)
	{
		if (!empty($labels)) {
			foreach ($labels as $index => $label) {
				// label Id
				$labelId = $label[Product::KEY_LABEL];
				if ($this->validateLength($labelId, self::MAX_LABEL_ID_LENGTH) === false) {
					throw $this->generateThrow(
						sprintf(ValidatorException::MSG_INVALID_VALUE_MAX_LENGTH, $labelId, self::MAX_LABEL_ID_LENGTH),
						[
							'key' => implode('.', [$objectType, Product::KEY_LABELS]),
							'data' => [
								'index' => $index,
								'data' => $labels[$index]
							]
						]
					);
				}
				if (empty($labelId)) {
					throw $this->generateThrow(sprintf(ValidatorException::MSG_EMPTY_VALUE, Product::KEY_LABEL), [
						'key' => implode('.', [$objectType, Product::KEY_LABELS]),
						'data' => [
							'index' => $index,
							'data' => $labels[$index]
						]
					]);
				}
				if (!$this->mapper->checkLabelExist($labelId)) {
					throw $this->generateThrow(
						sprintf(ValidatorException::MSG_UNKNOWN_LABEL, $labelId),
						[
							'key' => implode('.', [$objectType, Product::KEY_LABELS]),
							'data' => [
								'index' => $index,
								'data' => $labels[$index]
							]
						]
					);
				}
				// label date from
				$labelFrom = $label[Product::KEY_FROM];
				if ($this->validateDateTime($labelFrom) === false) {
					throw $this->generateThrow(
						sprintf(ValidatorException::MSG_BAD_DATETIME_FORMAT, $labelFrom),
						[
							'key' => implode('.', [$objectType, Product::KEY_LABELS]),
							'data' => [
								'index' => $index,
								'data' => $labels[$index]
							]
						]
					);
				}
				// label date to
				$labelTo = $label[Product::KEY_TO];
				if ($this->validateDateTime($labelTo) === false) {
					throw $this->generateThrow(
						sprintf(ValidatorException::MSG_BAD_DATETIME_FORMAT, $labelTo),
						[
							'key' => implode('.', [$objectType, Product::KEY_LABELS]),
							'data' => [
								'index' => $index,
								'data' => $labels[$index]
							]
						]
					);
				}
				if ($this->validateHistoryDate($labelTo) === false) {
					throw $this->generateThrow(
						sprintf(ValidatorException::MSG_DATE_IN_HISTORY, $labelTo),
						[
							'key' => implode('.', [$objectType, Product::KEY_LABELS]),
							'data' => [
								'index' => $index,
								'data' => $labels[$index]
							]
						]
					);
				}
			}
		} elseif (empty($labels) && $required === true) {
			throw $this->generateThrow(sprintf(ValidatorException::MSG_EMPTY_KEY, Product::KEY_LABELS), [
				'key' => implode('.', [$objectType, Product::KEY_LABELS])
			]);
		}

		return true;
	}
}
