<?php
use MPAPI\Services\Client;
use MPAPI\Services\Products;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use MPAPI\Entity\Availability;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('mp_mpapi_test_SAqqD_dGVzdHw0MDAw');
$logger = new Logger('loggerName');
$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));

// set logger into MP API client
$mpapiClient->setLogger($logger);
// initialize products synchronizer
$products = new Products($mpapiClient);

// create availability entity
$availability = new Availability('test2', 10, Availability::STATUS_ACTIVE);
// send update availability into MP API
$products->put($availability);