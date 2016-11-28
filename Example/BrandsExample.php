<?php
use MPAPI\Services\Client;
use MPAPI\Services\Brands;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('your_client_id');

$logger = new Logger('loggerName');
$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));
// set logger into MP API client
$mpapiClient->setLogger($logger);
$brands = new Brands($mpapiClient);

// // get all brands
$response = $brands->get()->categories();
var_dump($response);

// get brands by phrase
$response = $brands->get()->searchBrands('cal');
var_dump($response);