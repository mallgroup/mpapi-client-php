<?php
namespace MPAPI\Endpoints;
use MPAPI\Exceptions\ApplicationException;
use MPAPI\Services\Client;

/**
 * @author Petr Jirouš <petr.jirous@mall.cz>
 */
class TransportsEndpoints
{

	/**
	 * @var string
	 */
	const ENDPOINT_TRANSPORTS = '/v1/transports';

	/**
	 * @var Client
	 */
	private $client;

	/**
	 * TransportsEndpoints constructor.
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * Returns list of available transport services
	 *
	 * @return array
	 * @throws ApplicationException
	 * @throws \MPAPI\Exceptions\ClientIdException
	 * @throws \MPAPI\Exceptions\ForceTokenException
	 */
	public function getAvailableTransportsList()
	{
		$response = $this->client->sendRequest(self::ENDPOINT_TRANSPORTS, 'GET')->getBody()->getContents();
		$decoded = json_decode($response, true);
		if (!$decoded || !isset($decoded['data'])) {
			throw new ApplicationException("Couldn't decode response from /transports");
		}

		$res = [];
		foreach ($decoded['data'] as $transport) {
			$res[(string) $transport['id']] = [
				'name' => $transport['transportName'],
				'packageSize' => $transport['packageSize'],
				'isPickupPoint' => $transport['isPickupPoint'],
			];
		}
		return $res;
	}
}
