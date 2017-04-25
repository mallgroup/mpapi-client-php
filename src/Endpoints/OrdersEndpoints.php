<?php
namespace MPAPI\Endpoints;

use GuzzleHttp\Psr7\Response;
use MPAPI\Entity\Order;
use MPAPI\Lib\DataCollector;
use MPAPI\Services\Client;
use MPAPI\Services\Orders;

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
	const ENDPOINT_STATS = 'stats';

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
	 * @return array
	 */
	public function open()
	{
		$response = $this->client->sendRequest(sprintf(self::MERGE_ENDPOINTS, self::ENDPOINT_PATH, self::ENDPOINT_OPEN), 'GET');
		return $this->dataCollector($response);
	}

	/**
	 * Get list of blocked orders
	 *
	 * @return array
	 */
	public function blocked()
	{
		$response = $this->client->sendRequest(sprintf(self::MERGE_ENDPOINTS, self::ENDPOINT_PATH, self::ENDPOINT_BLOCKED), 'GET');
		return $this->dataCollector($response);
	}

	/**
	 * Get list of shipping orders
	 *
	 * @return array
	 */
	public function shipping()
	{
		$response = $this->client->sendRequest(sprintf(self::MERGE_ENDPOINTS, self::ENDPOINT_PATH, self::ENDPOINT_SHIPPING), 'GET');
		return $this->dataCollector($response);
	}

	/**
	 * Get list of shipped orders
	 *
	 * @return array
	 */
	public function shipped()
	{
		$response = $this->client->sendRequest(sprintf(self::MERGE_ENDPOINTS, self::ENDPOINT_PATH, self::ENDPOINT_SHIPPED), 'GET');
		return $this->dataCollector($response);
	}

	/**
	 * Get list of delivered orders
	 *
	 * @return array
	 */
	public function delivered()
	{
		$response = $this->client->sendRequest(sprintf(self::MERGE_ENDPOINTS, self::ENDPOINT_PATH, self::ENDPOINT_DELIVERED), 'GET');
		return $this->dataCollector($response);
	}

	/**
	 * Get list of returned orders
	 *
	 * @return array
	 */
	public function returned()
	{
		$response = $this->client->sendRequest(sprintf(self::MERGE_ENDPOINTS, self::ENDPOINT_PATH, self::ENDPOINT_RETURNED), 'GET');
		return $this->dataCollector($response);
	}

	/**
	 * Get list of cancelled orders
	 *
	 * @return array
	 */
	public function cancelled()
	{
		$response = $this->client->sendRequest(sprintf(self::MERGE_ENDPOINTS, self::ENDPOINT_PATH, self::ENDPOINT_CANCELLED), 'GET');
		return $this->dataCollector($response);
	}

	/**
	 * Get list of unconfirmed orders
	 *
	 * @return array
	 */
	public function unconfirmed()
	{
		$response = $this->client->sendRequest(sprintf(self::MERGE_ENDPOINTS, self::ENDPOINT_PATH, self::ENDPOINT_UNCONFIRMED), 'GET');
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
	 * @param int $orderId
	 * @return Order|array
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
	 * Get statistics
	 *
	 * @param int $days = 30
	 * @return array
	 */
	public function stats($days = 30)
	{
		$retval = [];
		// set days filter
		$this->client->setArgument('days', (int)$days);
		// send request
		$response = $this->client->sendRequest(sprintf(self::MERGE_ENDPOINTS, self::ENDPOINT_PATH, self::ENDPOINT_STATS), 'GET');
		$responseData = json_decode($response->getBody(), true);

		if (isset($responseData['data'])) {
			$retval = $responseData['data'];
		}
		return $retval;
	}

	/**
	 * Collect all orders from response
	 *
	 * @param Response $response
	 * @return array
	 */
	private function dataCollector(Response $response)
	{
		$dataCollector = new DataCollector($this->client, $response, false);
		$filter = $this->client->getArgument('filter');
		if ($filter ===  Orders::FILTER_TYPE_BASIC) {
			$dataSection = null;
		} else {
			$dataSection = 'ids';
		}
		return $dataCollector->setDataSection($dataSection)->getData();
	}
}
