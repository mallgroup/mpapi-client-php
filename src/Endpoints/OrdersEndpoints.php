<?php
namespace MPAPI\Endpoints;

use GuzzleHttp\Psr7\Response;
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
	const ENDPOINT_BLOCKED = 'blocked';

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_OPEN = 'open';

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_SHIPPING = 'shipping';

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_SHIPPED = 'shipped';

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_DELIVERED = 'delivered';

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_RETURNED = 'returned';

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_CANCELLED = 'cancelled';

	/**
	 *
	 * @var string
	 */
	const ENDPOINT_UNCONFIRMED = 'unconfirmed';

	/**
	 *
	 * @var string
	 */
	const MERGE_ENDPOINTS = '%s/%s';

	/**
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 * Get list of open orders
	 *
	 * @param string $status
	 * @return array|null
	 */
	public function open($status = '')
	{
		$args = [];
		if ($status === Order::STATUS_OPEN) {
			$args['status'] = $status;
		}
		$response = $this->client->sendRequest(sprintf(self::MERGE_ENDPOINTS , self::ENDPOINT_PATH, self::ENDPOINT_OPEN), 'GET', [], $args);
		return $this->dataCollector($response);
	}

	/**
	 * Get list of blocked orders
	 *
	 * @return array|null
	 */
	public function blocked()
	{
		$response = $this->client->sendRequest(sprintf(self::MERGE_ENDPOINTS , self::ENDPOINT_PATH, self::ENDPOINT_BLOCKED), 'GET');
		return $this->dataCollector($response);
	}

	/**
	 * Get list of shipping orders
	 *
	 * @return array|null
	 */
	public function shipping()
	{
		$response = $this->client->sendRequest(sprintf(self::MERGE_ENDPOINTS , self::ENDPOINT_PATH, self::ENDPOINT_SHIPPING), 'GET');
		return $this->dataCollector($response);
	}

	/**
	 * Get list of shipped orders
	 *
	 * @return array|null
	 */
	public function shipped()
	{
		$response = $this->client->sendRequest(sprintf(self::MERGE_ENDPOINTS , self::ENDPOINT_PATH, self::ENDPOINT_SHIPPED), 'GET');
		return $this->dataCollector($response);
	}

	/**
	 * Get list of delivered orders
	 *
	 * @return array|null
	 */
	public function delivered()
	{
		$response = $this->client->sendRequest(sprintf(self::MERGE_ENDPOINTS , self::ENDPOINT_PATH, self::ENDPOINT_DELIVERED), 'GET');
		return $this->dataCollector($response);
	}

	/**
	 * Get list of returned orders
	 *
	 * @return array|null
	 */
	public function returned()
	{
		$response = $this->client->sendRequest(sprintf(self::MERGE_ENDPOINTS , self::ENDPOINT_PATH, self::ENDPOINT_RETURNED), 'GET');
		return $this->dataCollector($response);
	}

	/**
	 * Get list of cancelled orders
	 *
	 * @return array|null
	 */
	public function cancelled()
	{
		$response = $this->client->sendRequest(sprintf(self::MERGE_ENDPOINTS , self::ENDPOINT_PATH, self::ENDPOINT_CANCELLED), 'GET');
		return $this->dataCollector($response);
	}

	/**
	 * Get list of unconfirmed orders
	 *
	 * @return array|null
	 */
	public function unconfirmed()
	{
		$response = $this->client->sendRequest(sprintf(self::MERGE_ENDPOINTS , self::ENDPOINT_PATH, self::ENDPOINT_UNCONFIRMED), 'GET');
		return $this->dataCollector($response);
	}

	/**
	 * Get list of orders with basic detail
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
	 * @param integer $orderId
	 * @return Order|null
	 */
	public function detail($orderId)
	{
		$retval = [];
		$response = $this->client->sendRequest(sprintf(self::MERGE_ENDPOINTS, self::ENDPOINT_PATH, $orderId), 'GET');
		$responseData = json_decode($response->getBody(), true);
		if (isset($responseData['data']) && !empty($responseData['data'])) {
			$retval = new Order($responseData['data']);
		}
		return $retval;
	}

	/**
	 * Collect all orders from response
	 *
	 * @param Response $response
	 * @return array|null
	 */
	private function dataCollector(Response $response)
	{
		$dataCollector = new DataCollector($this->client, $response, false);
		return $dataCollector->setDataSection('ids')->getData();
	}
}
