<?php
namespace MPAPI\Entity;

/**
 * Class PackageSize
 *
 * @package MPAPI\Entity
 */
class PackageSize {

	/**
	 * @var string
	 */
	const SMALLBOX = 'smallbox';

	/**
	 * @var string
	 */
	const BIGBOX = 'bigbox';

	/**
	 * @var array
 	 */
	const PACKAGES_SIZE_LIST = [
		self::SMALLBOX,
		self::BIGBOX
	];
}
