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
$productId = 'pTU00_test1';
// your variant id
$variantId = 'p50_white_XL1';

// Initialize products service
$products = new Products($mpapiClient);

/**
 * #################################
 *  SETUP NEW VARIANT SUPPLY DELAY
 * #################################
 */
// create object with actual date/time
$validFrom = new DateTime();
$validTo = new DateTime();
// modify date - add 10 days
$validTo->modify('+12 day');

/**
 * You can also send only end of validity
 */
$delayCreated = $products->variants()->supplyDelay($productId, $variantId)->post($validTo);
print('Setup supply delay: ');
var_dump($delayCreated);
print(PHP_EOL);

/**
 * or you can send both valid from and valid to date
 */
$delayCreatedBothDate = $products->variants()->supplyDelay($productId, $variantId)->post($validTo, $validFrom);
print('Setup supply delay with both dates: ');
var_dump($delayCreatedBothDate);
print(PHP_EOL);

/**
 * #######################################
 *  UPDATE EXISTING VARIANT SUPPLY DELAY
 * #######################################
 */
$updatedValidTo = $validTo->modify('+5 day');
$delayUpdated = $products->variants()->supplyDelay($productId, $variantId)->put($updatedValidTo);
print('Update supply delay: ');
var_dump($delayUpdated);
print(PHP_EOL);


/**
 * #############################
 *   GET PRODUCT SUPPLY DELAY
 * #############################
 */
$delayDetail = $products->variants()->supplyDelay($productId, $variantId)->get();
print('Get supply delay: ');
var_dump($delayDetail);
print(PHP_EOL);

/**
 * ###############################
 *   DELETE VARIANT SUPPLY DELAY
 * ###############################
 */
$deleteDelay = $products->variants()->supplyDelay($productId, $variantId)->delete();
print('Delete supply delay: ');
var_dump($deleteDelay);
print(PHP_EOL);
