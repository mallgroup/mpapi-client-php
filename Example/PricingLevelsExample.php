<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use MPAPI\Entity\Deliveries\PricingLevels;
use MPAPI\Services\Client;
use MPAPI\Services\Deliveries;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('your_client_id');

if (class_exists('Logger')) {
	$logger = new Logger('loggerName');
	$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));
	// set logger into MP API client
	$mpapiClient->setLogger($logger);
}

/* @var Deliveries $deliveries  */
$deliveries = new Deliveries($mpapiClient);

// delivery code of already defined delivery method
$deliveryCode = 'new_delivery2';

/**
 * ##################################
 * Create or update delivery pricing
 * ##################################
 */
$pricingLevels = new PricingLevels();
$pricingLevels->addLevel(PricingLevels::TYPE_PRICE, 100, 49, 1000);
$createStatus = $deliveries->pricing()->post($deliveryCode, $pricingLevels);
print('Delivery pricing levels created: ');
var_dump($createStatus);
print(PHP_EOL);

/**
 * ##################################
 * Get delivery pricing list
 * ##################################
 */
$response = $deliveries->pricing()->get($deliveryCode);
var_dump($response);

/**
 * ##################################
 * Delete delivery pricing
 * ##################################
 */
$deleteStatus = $deliveries->pricing()->delete($deliveryCode);
print('Delivery pricing levels deleted: ');
var_export($deleteStatus);
print(PHP_EOL);
