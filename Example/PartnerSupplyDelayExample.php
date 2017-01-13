<?php
use MPAPI\Services\Client;
use MPAPI\Services\Partner;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('your_client_id');
$logger = new Logger('loggerName');
$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));

// set logger into MP API client
$mpapiClient->setLogger($logger);

// Initialize partner service
$partner = new Partner($mpapiClient);

/**
 * #################################
 *  SETUP NEW PARTNER SUPPLY DELAY
 * #################################
 */
// create object with actual date/time
$validFrom = new DateTime();
$validTo = new DateTime();
// modify date - add 10 days
$validTo->modify('+10 day');

/**
 * You can send only end of validity
 */
$delayCreated = $partner->postSupplyDelay($validTo);
print('Setup partner supply delay: ');
var_dump($delayCreated);
print(PHP_EOL);

/**
 * or you can send both valid from and valid to date
 */
$delayCreated2 = $partner->postSupplyDelay($validTo, $validFrom);
print('Setup partner supply delay with both dates: ');
var_dump($delayCreated2);
print(PHP_EOL);

/**
 * #######################################
 *  UPDATE EXISTING PARTNER SUPPLY DELAY
 * #######################################
 */
$updatedValidTo = $validTo->modify('+5 day');
$delayUpdated = $partner->putSupplyDelay($updatedValidTo);
print('Update partner supply delay: ');
var_dump($delayUpdated);
print(PHP_EOL);

/**
 * #############################
 *   GET PARTNER SUPPLY DELAY
 * #############################
 */
$delayDetail = $partner->getSupplyDelay();
print('Get partner supply delay: ');
var_dump($delayDetail);
print(PHP_EOL);

/**
 * ###############################
 *   DELETE PARTNER SUPPLY DELAY
 * ###############################
 */
$deleteDelay = $partner->deleteSupplyDelay();
print('Delete partner supply delay: ');
var_dump($deleteDelay);
print(PHP_EOL);
