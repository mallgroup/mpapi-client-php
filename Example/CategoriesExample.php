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
// $response = $categories->get()->getCategories();
// // var_dump($response);

// get categories by prefix
$prefix = 'MP';
$response = $categories->get()->getCategoriesByPrefix($prefix);
var_dump($response);

// get categories by phrase
$phrase = 'book';
$response = $categories->get()->getSearchCategories($phrase);
var_dump($response);

// get category parameters
$categoryId = 'MP002PL';
$response = $categories->get()->getCategoryParameters($categoryId);
var_dump($response);