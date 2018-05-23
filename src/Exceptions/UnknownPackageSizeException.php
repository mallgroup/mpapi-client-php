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
	const MSG_UNKNOWN_PACKAGE_SIZE = 'Unknown package size \'%s\'. You can use %s.';

	/**
	 * @param $size
	 * @return UnknownPackageSizeException
	 */
	public static function withPackageSize($size)
	{
		return new static(sprintf(self::MSG_UNKNOWN_PACKAGE_SIZE, $size, implode(' or ', PackageSize::PACKAGES_SIZE_LIST)));
	}
}
