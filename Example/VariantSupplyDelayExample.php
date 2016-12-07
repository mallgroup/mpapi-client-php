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
// your variant id
$variantId = 'vt0001';

// Initialize products service
$products = new Products($mpapiClient);

/**
 * #################################
 *  SETUP NEW VARIANT SUPPLY DELAY
 * #################################
 */
// create object with actual date/time
$currentDate = new DateTime();
// modify date - add 10 days
$futureDate = $currentDate->modify('+ 12 days');

/**
 * It can be sent just end of validity
 */
$response = $products->variants()->supplyDelay($productId, $variantId)->post($futureDate);
var_dump($response->getData());

/**
 * or it can be sent both dates (valid from and valid to)
 */
$response = $products->variants()->supplyDelay($productId, $variantId)->post($futureDate, $currentDate);

/**
 * #######################################
 *  UPDATE EXISTING VARIANT SUPPLY DELAY
 * #######################################
 */
$updatedValidTo = $futureDate->modify('+5 days');
$response = $products->variants()->supplyDelay($productId, $variantId)->put($updatedValidTo);
var_dump($response);

/**
 * #############################
 *   GET PRODUCT SUPPLY DELAY
 * #############################
 */
$response = $products->variants()->supplyDelay($productId, $variantId)->get();
var_dump($response);

/**
 * ###############################
 *   DELETE VARIANT SUPPLY DELAY
 * ###############################
 */
$response = $products->variants()->supplyDelay($productId, $variantId)->delete();
var_dump($response);
