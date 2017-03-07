<?php
namespace MPAPI\Endpoints;

use MPAPI\Services\Client;

/**
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class OrderUpdateEndpoints extends AbstractEndpoints
{
	/**
	 *
	 * @var string
	 */
	const ENDPOINT_PATH = 'orders/%s';

	/**
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 * Update order status
	 *
	 * @param integer $orderId
	 * @param string $status
	 * @param boolean $confirmed
	 * @param string $trackingNumber
	 * @return boolean
	 */
	public function status($orderId, $status, $confirmed = true, $trackingNumber = '')
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_PATH, $orderId), 'PUT', [
			'status' => $status,
			'confirmed' => $confirmed,
			'tracking_number' => $trackingNumber
		]);
		return $response->getStatusCode() == 200;
	}
}
