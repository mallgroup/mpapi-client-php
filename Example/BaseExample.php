<?php
use MPAPI\Services\Client;
use MPAPI\Entity\RequestMethods;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require __DIR__ . '/../vendor/autoload.php';

// initialize API client
$mpApiClient = new Client('mp_mpapi_test_SAqqD_dGVzdHw0MDAw');

/**
 * Create instance of monolog logger
 */
$logger = new Logger('loggerName');
$logger->pushHandler(new StreamHandler('/var/log/elog.log', Logger::INFO));

// set logger into MP API client
$mpApiClient->setLogger($logger);

// first request with default exception handler
$mpApiClient->sendRequest('products', RequestMethods::GET);