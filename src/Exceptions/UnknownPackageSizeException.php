<?php
namespace MPAPI\Exceptions;

use MPAPI\Entity\PackageSize;

/**
* Class UnknownPackageSizeException
 *
 * @package MPAPI\Exceptions
 */
class UnknownPackageSizeException extends \Exception
{
	/**
	 *
	 * @var string
	 */
	const MSG_UNKNOWN_PACKAGE_SIZE = 'Unknown package size \'%s\', allowed are: %s.';

	/**
	 * @param $size
	 * @return UnknownPackageSizeException
	 */
	public static function withPackageSize($size)
	{
		return new static(sprintf(self::MSG_UNKNOWN_PACKAGE_SIZE, $size, implode(', ', PackageSize::PACKAGES_SIZE_LIST)));
	}
}
