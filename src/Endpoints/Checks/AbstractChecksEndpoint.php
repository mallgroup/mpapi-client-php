<?php

namespace MPAPI\Endpoints\Checks;

use MPAPI\Endpoints\AbstractEndpoints;
use MPAPI\Entity\Checks\AbstractErrorEntity;
use MPAPI\Exceptions\ApplicationException;
use MPAPI\Services\Client;

abstract class AbstractChecksEndpoint extends AbstractEndpoints
{

	/**
	 * AbstractChecksEndpoint constructor.
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		parent::__construct($client);
		$this->client->setAutoDataCollecting(false);
	}

	/**
	 * @param $url
	 * @param $callback
	 * @return array
	 * @throws ApplicationException
	 * @throws \MPAPI\Exceptions\ClientIdException
	 * @throws \MPAPI\Exceptions\ForceTokenException
	 */
	protected function sendCheckRequest($url, $callback)
	{
		$response = $this->client->sendRequest($url, 'GET')->getBody()->getContents();
		$decoded = json_decode($response, true);
		if (!$decoded || !isset($decoded['errors'])) {
			throw new ApplicationException("Couldn't decode errors");
		}

		$errors = [];
		foreach ($decoded['errors'] as $errorData) {
			$error = $callback($errorData);
			if ($error instanceof AbstractErrorEntity) {
				$errors[] = $error;
			} else {
				throw new ApplicationException("Wrong error object. Must be instance of AbstractErrorEntity");
			}
		}
		return $errors;
	}
}
