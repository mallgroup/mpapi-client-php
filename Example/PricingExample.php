<?php

use MPAPI\Services\Client;
use MPAPI\Services\Products;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use MPAPI\Entity\Pricing;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('your_client_id');

if (class_exists('Logger')) {
	$logger = new Logger('loggerName');
	$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));
	// set logger into MP API client
	$mpapiClient->setLogger($logger);
}

// initialize products synchronizer
$products = new Products($mpapiClient);

// create pricing entity
$pricing = new Pricing(100, 115, 130);

// send update product pricing into MP API
$products->put(29237, $pricing);

// send update variant pricing into MP API
$products->put(29237, $pricing, 29239);
