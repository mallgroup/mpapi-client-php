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
	 * @var string
	 */
	const TRACKING_URL_KEY = 'tracking_url';

	/**
	 * @var string
	 */
	const TRACKING_NUMBER_KEY = 'tracking_number';

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_TRACKING_NUMBER = '%s/%s/tracking-number/%s';

	/**
	 * @var string
	 */
	const ENDPOINT_TRACKING= '%s/%s/tracking';

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
	 * @throws \MPAPI\Exceptions\ClientIdException
	 * @throws \MPAPI\Exceptions\ForceTokenException
	 */
	public function trackingNumber($orderId, $trackingNumber)
	{
		$requestData = [
			self::TRACKING_NUMBER_KEY => $trackingNumber
		];
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_TRACKING, self::ENDPOINT_PATH, $orderId), 'PUT', $requestData);
		return $response->getStatusCode() == 200;
	}

	/**
	 * Update order tracking url
	 *
	 * @param $orderId
	 * @param $trackingUrl
	 * @return bool
	 * @throws \MPAPI\Exceptions\ClientIdException
	 * @throws \MPAPI\Exceptions\ForceTokenException
	 */
	public function trackingUrl($orderId, $trackingUrl)
	{
		$requestData = [
			self::TRACKING_URL_KEY => $trackingUrl
		];
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_TRACKING, self::ENDPOINT_PATH, $orderId), 'PUT',$requestData);
		return $response->getStatusCode() == 200;
	}
}
