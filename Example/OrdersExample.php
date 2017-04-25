<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use MPAPI\Services\Client;
use MPAPI\Services\Orders;
use MPAPI\Entity\Order;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('mp_mpapi_test_SAqqD_dGVzdHw0MDAw');

if (class_exists('Logger')) {
	$logger = new Logger('loggerName');
	$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));
	// set logger into MP API client
	$mpapiClient->setLogger($logger);
}

// initialize orders synchronizer
$orders = new Orders($mpapiClient);

// ##################################
// Get orders statistics
// ##################################
$statistics = $orders->get()->stats();
print('Order statistics last 30 days:');
var_dump($statistics);
$last7Days = $orders->get()->stats(7);
print('Order statistics last 7 days:');
var_dump($last7Days);

// #####################################
// Get list of order IDs in status open
// #####################################
$openOrders = $orders->get()->open();
// print open orders
foreach ($openOrders as $orderId) {
	print('Open order: ' . $orderId . PHP_EOL);
}

// ####################################
// Get list of orders with basic data
// Use filter to modify response
// ####################################
$openOrdersBasicData = $orders->setFilter(Orders::FILTER_TYPE_BASIC)->get()->open();
var_dump($openOrdersBasicData);
// to get only ids you can remove the filter
$orders->removeFilter();

// get all blocked orders
$blockedOrders = $orders->get()->blocked();
// print blocked orders
foreach ($blockedOrders as $orderId) {
	print('Blocked order: ' . $orderId . PHP_EOL);
}

// get all shipping orders
$shippingOrders = $orders->get()->shipping();
// print shipping orders
foreach ($shippingOrders as $orderId) {
	print('Shipping order: ' . $orderId . PHP_EOL);
}

// get all shipped orders
$shippedOrders = $orders->get()->shipped();
// print shipped orders
foreach ($shippedOrders as $orderId) {
	print('Shipped order: ' . $orderId . PHP_EOL);
}

// get all delivered orders
$deliveredOrders = $orders->get()->delivered();
// print delivered orders
foreach ($deliveredOrders as $orderId) {
	print('Delivered order: ' . $orderId . PHP_EOL);
}

// get all returned orders
$returnedOrders = $orders->get()->returned();
// print returned orders
foreach ($returnedOrders as $orderId) {
	print('Returned order: ' . $orderId . PHP_EOL);
}

// get all cancelled orders
$cancelledOrders = $orders->get()->cancelled();
// print cancelled orders
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