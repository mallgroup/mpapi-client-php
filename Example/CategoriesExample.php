<?php
use MPAPI\Services\Client;
use MPAPI\Services\Categories;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('mp_mpapi_test_SAqqD_dGVzdHw0MDAw');

$logger = new Logger('loggerName');
$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));
// set logger into MP API client
$mpapiClient->setLogger($logger);
$categories = new Categories($mpapiClient);

// // get all categories
$response = $categories->get()->getCategories();
var_dump($response);

// get categories by prefix
$response = $categories->get()->getCategoriesByPrefix('Lam');
var_dump($response);

// get categories by phrase
$response = $categories->get()->getSearchCategories('desky');
var_dump($response);

// get category parameters
$response = $categories->get()->getCategoryParameters('MP002PL');
var_dump($response);