<?php
namespace MPAPI\Endpoints;

use MPAPI\Services\Client;
use MPAPI\Lib\DataCollector;
use MPAPI\Entity\Order;

/**
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class OrdersEndpoints extends AbstractEndpoints
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
	const ENDPOINT_OPEN = '%s/open';

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_UNCONFIRMED = '%s/unconfirmed';

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_DETAIL = '%s/%s';

	/**
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 * Get list of open orders
	 *
	 * @return array|null
	 */
	public function open()
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_OPEN, self::ENDPOINT_PATH), 'GET');
		$dataCollector = new DataCollector($this->client, $response, false);
		return $dataCollector->setDataSection('ids')->getData();
	}

	/**
	 * Get list of unconfirmed orders
	 *
	 * @return array|null
	 */
	public function unconfirmed()
	{
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_UNCONFIRMED, self::ENDPOINT_PATH), 'GET');
		$dataCollector = new DataCollector($this->client, $response, false);
		return $dataCollector->setDataSection('ids')->getData();
	}

	/**
	 * Get list of orders data
	 *
	 * @return array
	 */
	public function all()
	{
		$response = $this->client->sendRequest(self::ENDPOINT_PATH, 'GET');
		$dataCollector = new DataCollector($this->client, $response, false);
		return $dataCollector->getData();
	}


	/**
	 * Get order detail
	 *
	 * @return Order|null
	 */
	public function detail($orderId)
	{
		$retval = [];
		$response = $this->client->sendRequest(sprintf(self::ENDPOINT_DETAIL, self::ENDPOINT_PATH, $orderId), 'GET');
		$responseData = json_decode($response->getBody(), true);
		if (isset($responseData['data']) && !empty($responseData['data'])) {
			$retval = new Order($responseData['data']);
		}
		return $retval;
	}
}
