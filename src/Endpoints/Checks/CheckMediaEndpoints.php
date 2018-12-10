<?php

namespace MPAPI\Endpoints\Checks;

use MPAPI\Endpoints\AbstractEndpoints;
use MPAPI\Entity\Checks\DeliveryError;
use MPAPI\Entity\Checks\MediaError;
use MPAPI\Exceptions\ApplicationException;
use MPAPI\Services\Client;

class CheckMediaEndpoints extends AbstractChecksEndpoint
{
	/**
	 * @var string
	 */
	const ENDPOINT_PATH = 'checks/media';


	/**
	 * Return list of delivery check errors
	 *
	 * @throws ApplicationException
	 * @throws \MPAPI\Exceptions\ClientIdException
	 * @throws \MPAPI\Exceptions\ForceTokenException
	 * @return MediaError[]|array
	 */
	public function errors()
	{
		return $this->sendCheckRequest(self::ENDPOINT_PATH, function ($errorData) {
			return new MediaError($errorData);
		});
	}
}
