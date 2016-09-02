<?php
/**
 * Created by PhpStorm.
 * User: mhrdlicka
 * Date: 1.9.2016
 * Time: 14:20
 */

namespace MPAPI\Endpoints\Deliveries;

use MPAPI\Endpoints\AbstractEndpoints;

/**
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class AbstractDeliveriesEndpoints extends AbstractEndpoints
{
	/**
	 *
	 * @var string
	 */
	const ENDPOINT_PATH = 'deliveries/partner';

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_PATH_WITH_CODE = 'deliveries/partner/%s';
}
