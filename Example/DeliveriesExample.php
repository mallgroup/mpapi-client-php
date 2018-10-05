<?php
use MPAPI\Services\Client;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use MPAPI\Services\Deliveries;
use MPAPI\Entity\PartnerDelivery;
use MPAPI\Entity\GeneralDelivery;
use MPAPI\Entity\PackageSize;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('your_client_id');

if (class_exists('Logger')) {
	$logger = new Logger('loggerName');
	$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));
	// set logger into MP API client
	$mpapiClient->setLogger($logger);
}

/* @var Deliveries $deliveries */
$deliveries = new Deliveries($mpapiClient);
$availableTransports = $deliveries->transports()->getAvailableTransportsList();
$ids = array_keys($availableTransports);

// Get partner deliveries
$response = $deliveries->partner()->get();
var_dump($response);

$partnerDelivery = new PartnerDelivery();
$partnerDelivery->setCode((string) reset($ids));
$partnerDelivery->setTitle('New delivery 1');
$partnerDelivery->setPrice(90);
$partnerDelivery->setCodPrice(21);
$partnerDelivery->setFreeLimit(1000);
$partnerDelivery->setDeliveryDelay(2);
$partnerDelivery->setAsPickupPoint(false);
$partnerDelivery->setHeightMin(10);
$partnerDelivery->setHeightMax(20);
$partnerDelivery->setLengthMin(1);
$partnerDelivery->setLengthMax(2);
$partnerDelivery->setWidthMin(3);
$partnerDelivery->setWidthMax(4);
$partnerDelivery->setWeightMin(5);
$partnerDelivery->setWeightMax(6);
$partnerDelivery->setPriority(2);
// setup delivery package size limitation
$partnerDelivery->setPackageSize(PackageSize::BIGBOX);

// Create new partner delivery
$response = $deliveries->partner()->post($partnerDelivery);
var_dump($response);

// Update partner delivery
$response = $deliveries->partner()->put($partnerDelivery);
var_dump($response);

// Get partner delivery detail
$response = $deliveries->partner()->get('newDelivery1');
var_dump($response);

// Delete partner delivery
$response = $deliveries->partner()->delete($partnerDelivery);
var_dump($response);

// Delete all partner deliveries
$response = $deliveries->partner()->delete();
var_dump($response);

// Get general deliveries
$response = $deliveries->general()->get();
var_dump($response);

// Get general delivery detail
$response = $deliveries->general()->get('PPL');
var_dump($response);

// Get active general deliveries
$respnse = $deliveries->general()->getActive();
var_dump($response);

$generalDelivery = new GeneralDelivery();
$generalDelivery->setCode('CP');

// Update active general deliveries
$response = $deliveries->general()->put($generalDelivery);
var_dump($response);

// Delete active general delivery
$response = $deliveries->general()->delete($generalDelivery);
var_dump($response);

// Delete active general deliveries
$response = $deliveries->general()->delete();
var_dump($response);
