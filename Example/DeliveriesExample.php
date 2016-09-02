<?php
use MPAPI\Services\Client;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use MPAPI\Services\Deliveries;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('mp_mpapi_test_SAqqD_dGVzdHw0MDAw');
$logger = new Logger('loggerName');
$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));

// set logger into MP API client
$mpapiClient->setLogger($logger);

/* @var $deliveries Deliveries */
$deliveries = new MPAPI\Services\Deliveries($mpapiClient);

// get partner deliveries
$deliveryList = $deliveries->partner()->get()->deliveries();

var_dump($deliveryList);

$deliveryDetail = $deliveries->partner()->get()->detail('new_delivery1');
var_dump($deliveryDetail);