<?php
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use MPAPI\Services\Client;
use MPAPI\Services\Products;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('your_client_id', false);
$mpapiClient->setAutoDataCollecting(false);

if (class_exists('Logger')) {
	$logger = new Logger('loggerName');
	$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));
	// set logger into MP API client
	$mpapiClient->setLogger($logger);
}

$products = new Products($mpapiClient);

// #######################
// Get list of product IDs
// #######################
$productIds = $products->getPaginated(1, 5);
var_dump($productIds);
print('Current page: ' . $products->getPaging()->getPage() . "\n");
print('Total page count: ' . $products->getPaging()->getPageCount() . "\n");
print('Total items count: ' . $products->getPaging()->getItemsCount() . "\n");
print('Item on current page: ' . $products->getPaging()->getSize() . "\n");

// ####################################
// Get list of products with basic data
// Use filter to modify response
// ####################################
$products->setFilter(Products::FILTER_TYPE_BASIC);
var_dump($products->getPaginated(1, 2));
print('Current page: ' . $products->getPaging()->getPage() . "\n");
print('Total page count: ' . $products->getPaging()->getPageCount() . "\n");
print('Total items count: ' . $products->getPaging()->getItemsCount() . "\n");
print('Item on current page: ' . $products->getPaging()->getSize() . "\n");


$orders = new \MPAPI\Services\Orders($mpapiClient);
$ordersData = $orders->get()->getAllPaginated(1, 2);
var_dump($ordersData);
print('Current page: ' . $orders->getPaging()->getPage() . "\n");
print('Total page count: ' . $orders->getPaging()->getPageCount() . "\n");
print('Total items count: ' . $orders->getPaging()->getItemsCount() . "\n");
print('Item on current page: ' . $orders->getPaging()->getSize() . "\n");