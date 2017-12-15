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
	const ENDPOINT_PATH = 'orders';

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_DETAIL = '%s/%s';

	const DATETIME_FORMAT = 'Y-m-d H:i:s';

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_TRACKING_NUMBER = '%s/%s/tracking-number/%s';

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
	 * @param \DateTimeInterface|null $deliveredAt
	 * @return bool
	 */
	public function status($orderId, $status, $confirmed = true, $trackingNumber = '', \DateTimeInterface $deliveredAt = null)
	{
		$requestData = [
			'status' => $status,
			'confirmed' => $confirmed
		];

		if ($deliveredAt !== null) {
			$requestData['delivered_at'] = $deliveredAt->format(self::DATETIME_FORMAT);
		}

		if (!empty($trackingNumber)) {
			$requestData['tracking_number'] = $trackingNumber;
		}

		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_DETAIL, self::ENDPOINT_PATH, $orderId), 'PUT', $requestData);
		return $response->getStatusCode() == 200;
	}

	/**
	 * Update tracking number
	 *
	 * @param integer $orderId
	 * @param string $trackingNumber
	 * @return boolean
	 */
	public function trackingNumber($orderId, $trackingNumber)
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_TRACKING_NUMBER, self::ENDPOINT_PATH, $orderId, $trackingNumber), 'PUT');
		return $response->getStatusCode() == 200;
	}
}
