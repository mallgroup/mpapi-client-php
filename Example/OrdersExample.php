<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use MPAPI\Services\Client;
use MPAPI\Services\Orders;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('mp_mpapi_test_SAqqD_dGVzdHw0MDAw');

$logger = new Logger('loggerName');
$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));
// set logger into MP API client
$mpapiClient->setLogger($logger);

// initialize orders synchronizer
$orders = new Orders($mpapiClient);

// get all open orders
$openOrders = $orders->get()->openOrders();
// print of open orders
var_dump($openOrders);

// get all open orders
$unconfirmedOrders = $orders->get()->unconfirmedOrders();
// print list of unconfirmed orders
var_dump($unconfirmedOrders);

if (!empty($openOrders)) {
	// get order detail
	/* @var $order MPAPI\Entity\Order */
	$order = $orders->get()->orderDetail($openOrders[0]);
	// print order detail
	var_dump($order->getData());

	// update order status
	$responseStatus = $orders->put()->status($order->getOrderId(), 'open');
	// true or exception
	var_dump($responseStatus);
}