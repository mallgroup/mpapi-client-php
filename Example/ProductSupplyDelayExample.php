<?php
use MPAPI\Services\Client;
use MPAPI\Services\Products;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('your_client_id');
$logger = new Logger('loggerName');
$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));

// set logger into MP API client
$mpapiClient->setLogger($logger);

// your product id
$productId = 'pTU00_test';

// Initialize products service
$products = new Products($mpapiClient);

/**
 * #################################
 *  SETUP NEW PRODUCT SUPPLY DELAY
 * #################################
 */
// create object with actual date/time
$currentDate = new DateTime();
// modify date - add 10 days
$futureDate = $currentDate->modify('+ 10 days');

/**
 * It can be sent just end of validity
 */
$response = $products->supplyDelay($productId)->post($futureDate);
var_dump($response->getData());

/**
 * or it can be sent both dates (valid from and valid to)
 */
$response = $products->supplyDelay($productId)->post($futureDate, $currentDate);

/**
 * #######################################
 *  UPDATE EXISTING PRODUCT SUPPLY DELAY
 * #######################################
 */
$updatedValidTo = $futureDate->modify('+5 days');
$response = $products->supplyDelay($productId)->put($updatedValidTo);
var_dump($response);

/**
 * #############################
 *   GET PRODUCT SUPPLY DELAY
 * #############################
 */
$response = $products->supplyDelay($productId)->get();
var_dump($response);

/**
 * ###############################
 *   DELETE PRODUCT SUPPLY DELAY
 * ###############################
 */
$response = $products->supplyDelay($productId)->delete();
var_dump($response);
