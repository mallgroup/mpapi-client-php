<?php
namespace Marketplace\Validators;

use Marketplace\Model\MediaMapper;
use Marketplace\Exception\ValidatorException;
use Marketplace\Entity\Product;

/**
 * Media validator
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class MediaValidator extends AbstractValidator
{
	/**
	 *
	 * @var integer
	 */
	const MAX_URL_LENGTH = 200;

	/**
	 *
	 * @var int
	 */
	const MAX_IMAGE_DIMENSION = 2000;

	/**
	 *
	 * @var array
	 */
	private $supportedMimeTypes = [
		'image/gif',
		'image/jpeg',
		'image/jpg',
		'image/png'
	];

	/**
	 *
	 * @var MediaMapper
	 */
	protected $mapper;

	/**
	 *
	 * @param MediaMapper $mapper
	 */
	public function __construct(MediaMapper $mapper)
	{
		$this->mapper = $mapper;
	}

	/**
	 * Validate parameters
	 *
	 * @param array $mediaData
	 * @param string $objectType
	 * @throws ValidatorException
	 * @return boolean
	 */
	public function validate(array $mediaData, $objectType = self::OBJECT_TYPE_PRODUCT)
	{
		if (!empty($mediaData)) {
			foreach ($mediaData as $index => $media) {
				// media url
				if (!isset($media[Product::KEY_URL])) {
					throw $this->generateThrow(sprintf(ValidatorException::MSG_EMPTY_VALUE, Product::KEY_MEDIA), [
						'key' => implode('.', [$objectType, Product::KEY_MEDIA]),
						'data' => [
							'index' => $index
						]
					]);
				}
				$url = $media[Product::KEY_URL];
				if ($this->validateLength($url, self::MAX_URL_LENGTH, 0) === false) {
					throw $this->generateThrow(
						sprintf(ValidatorException::MSG_INVALID_VALUE_MAX_LENGTH, Product::KEY_URL, $url, self::MAX_URL_LENGTH),
						[
							'key' => implode('.', [$objectType, Product::KEY_MEDIA]),
							'data' => [
								'index' => $index,
								'data' => $media
							]
						]
					);
				}

				if (filter_var($url, FILTER_VALIDATE_URL) === false) {
					throw $this->generateThrow(
						sprintf(ValidatorException::MSG_INVALID_URL, $url),
						[
							'key' => implode('.', [$objectType, Product::KEY_MEDIA]),
							'data' => [
								'index' => $index,
								'data' => $media
							]
						]
					);
				}

				try {
					$this->validateMedia($url);
				} catch (ValidatorException $e) {
					throw $e->setData([
						'key' => implode('.', [$objectType, Product::KEY_MEDIA]),
						'data' => [
							'index' => $index,
							'data' => $media
						]
					]);
				}
			}
		} else {
			throw $this->generateThrow(ValidatorException::MSG_MISSING_MEDIA, [
				'key' => implode('.', [$objectType, Product::KEY_MEDIA])
			]);
		}

		return true;
	}

	/**
	 * Validate media type and dimension
	 *
	 * @param string $mediaUrl
	 * @throws ValidatorException
	 * @return boolean
	 */
	private function validateMedia($mediaUrl)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $mediaUrl);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 1);

		if (($imageString = curl_exec($ch)) === false) {
			curl_close($ch);
			throw $this->generateThrow(sprintf(ValidatorException::MSG_INVALID_MEDIA_URL, $mediaUrl));
		}

		$mimeType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

		if (is_resource($ch)) {
			curl_close($ch);
		}

		$image = imagecreatefromstring($imageString);
		if (imagesx($image) > self::MAX_IMAGE_DIMENSION || imagesy($image) > self::MAX_IMAGE_DIMENSION || !in_array($mimeType, $this->supportedMimeTypes)) {
			throw $this->generateThrow(sprintf(ValidatorException::MSG_UNSUPPORTED_MIME_TYPE, $mediaUrl));
		}

		return true;
	}
}
