<?php
use MPAPI\Services\Client;
use MPAPI\Services\Categories;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('your_client_id');

if (class_exists('Logger')) {
	$logger = new Logger('loggerName');
	$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));
	// set logger into MP API client
	$mpapiClient->setLogger($logger);
}

$categories = new Categories($mpapiClient);
// category and parameter IDs
$categoryId = 'some_category_id';
$paramId = 'some_param_id';

// // get all categories
$response = $categories->get()->categories();
var_dump($response);

// get categories by prefix
$response = $categories->get()->categoriesByPrefix('Lam');
var_dump($response);

// get categories by term
$response = $categories->get()->searchCategories('desky');
var_dump($response);

// get category parameters
$response = $categories->get()->categoryParameters($categoryId);
var_dump($response);

// get parameter values by parameter id
$response = $categories->get()->parameterValues($categoryId, $paramId);
var_dump($response);