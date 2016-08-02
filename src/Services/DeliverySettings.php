<?php
namespace MPAPI\Services;

use MPAPI\Entity\DeliveryMethod;

/**
 * Delivery settings
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class DeliverySettings extends AbstractService
{
	/**
	 *
	 * @var Client
	 */
	private $client;

	/**
	 *
	 * @var string
	 */
	const PATH = 'delivery-settings';

	/**
	 * Orders constructor.
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * Get delivery settings
	 *
	 * @return array
	 */
	public function get()
	{
		$response = $this->client->sendRequest(self::PATH, 'GET');
		$responseBody = json_decode($response->getBody(), true);
		return $responseBody['data'];
	}

	/**
	 * Put delivery settings
	 *
	 * @param DeliveryMethod $deliveryMethods
	 * @return array
	 */
	public function put(DeliveryMethod $deliveryMethods = null)
	{
		$response = $this->client->sendRequest(self::PATH, 'PUT', $deliveryMethods->getData());
		return $response->getStatusCode() == 200;
	}
}
