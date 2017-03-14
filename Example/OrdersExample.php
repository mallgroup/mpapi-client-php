<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use MPAPI\Services\Client;
use MPAPI\Services\Orders;
use MPAPI\Entity\Order;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('mp_mpapi_test_SAqqD_dGVzdHw0MDAw');

$logger = new Logger('loggerName');
$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));
// set logger into MP API client
$mpapiClient->setLogger($logger);

// initialize orders synchronizer
$orders = new Orders($mpapiClient);

// get all orders except statuses: returned, delivered, cancelled
$openOrders = $orders->get()->open();
// print of open orders
foreach ($openOrders as $orderId) {
	print('Open order: ' . $orderId . PHP_EOL);
}

// get all blocked orders
$blockedOrders = $orders->get()->blocked();
// print of blocked orders
foreach ($blockedOrders as $orderId) {
	print('Blocked order: ' . $orderId . PHP_EOL);
}

// get all shipping orders
$shippingOrders = $orders->get()->shipping();
// print of shipping orders
foreach ($shippingOrders as $orderId) {
	print('Shipping order: ' . $orderId . PHP_EOL);
}

// get all shipped orders
$shippedOrders = $orders->get()->shipped();
// print of shipped orders
foreach ($shippedOrders as $orderId) {
	print('Shipped order: ' . $orderId . PHP_EOL);
}

// get all delivered orders
$deliveredOrders = $orders->get()->delivered();
// print of delivered orders
foreach ($deliveredOrders as $orderId) {
	print('Delivered order: ' . $orderId . PHP_EOL);
}

// get all returned orders
$returnedOrders = $orders->get()->returned();
// print of returned orders
foreach ($returnedOrders as $orderId) {
	print('Returned order: ' . $orderId . PHP_EOL);
}

// get all cancelled orders
$cancelledOrders = $orders->get()->cancelled();
// print of cancelled orders
foreach ($cancelledOrders as $orderId) {
	print('Cancelled order: ' . $orderId . PHP_EOL);
}

// get all unconfirmed orders
$unconfirmedOrders = $orders->get()->unconfirmed();
// print list of unconfirmed orders
foreach ($unconfirmedOrders as $orderId) {
	print('Unconfirmed order: ' . $orderId . PHP_EOL);
}

// get all orders data
$ordersList = $orders->get()->all();
// print list of all orders data
var_dump($ordersList);

if (!empty($openOrders)) {
	// get order detail
	/* @var MPAPI\Entity\Order $order */
	$order = $orders->get()->detail($openOrders[0]);
	// print order detail
	var_dump($order->getData());

	/**
	 * ##################################
	 * Update order status
	 * ##################################
	 */
	$responseStatus = $orders->put()->status($order->getOrderId(), Order::STATUS_SHIPPING);
	print('New order status: ');
	var_dump($responseStatus);
	print(PHP_EOL);

	/**
	 * ##################################
	 * Set tracking number
	 * ##################################
	 */
	$responseStatus = $orders->put()->trackingNumber($order->getOrderId(), 'T9999999999');
	print('Order tracking number: ');
	var_dump($responseStatus);
	print(PHP_EOL);
}