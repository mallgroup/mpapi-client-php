<?php

namespace MPAPI\Endpoints\Checks;

use MPAPI\Endpoints\AbstractEndpoints;
use MPAPI\Entity\Checks\DeliveryError;
use MPAPI\Exceptions\ApplicationException;
use MPAPI\Services\Client;

class CheckDeliveriesEndpoints extends AbstractEndpoints
{
	/**
	 * @var string
	 */
	const ENDPOINT_PATH = 'checks/deliveries';


	public function __construct(Client $client)
	{
		parent::__construct($client);
		$this->client->setAutoDataCollecting(false);
	}

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

		$response = $this->client->sendRequest(self::ENDPOINT_PATH, 'GET')->getBody()->getContents();
		$decoded = json_decode($response, true);
		if (!$decoded || !isset($decoded['errors'])) {
			throw new ApplicationException("Couldn't decode delivery errors");
		}

		$errors = [];
		foreach ($decoded['errors'] as $error) {
			$errors[] = new DeliveryError($error);
		}
		return $errors;
	}
}
