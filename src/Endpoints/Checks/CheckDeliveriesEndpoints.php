<?php

namespace MPAPI\Endpoints\Checks;

use MPAPI\Entity\Checks\DeliveryError;
use MPAPI\Exceptions\ApplicationException;

class CheckDeliveriesEndpoints extends AbstractChecksEndpoint
{
	/**
	 * @var string
	 */
	const ENDPOINT_PATH = 'checks/deliveries';

	/**
	 * Return list of delivery check errors
	 *
	 * @throws ApplicationException
	 * @throws \MPAPI\Exceptions\ClientIdException
	 * @throws \MPAPI\Exceptions\ForceTokenException
	 * @return DeliveryError[]|array
	 */
	public function errors()
	{
		return $this->sendCheckRequest(self::ENDPOINT_PATH, function ($errorData) {
			return new DeliveryError($errorData);
		});
	}
}
