<?php
use MPAPI\Services\Client;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use MPAPI\Services\Deliveries;
use MPAPI\Entity\PartnerDelivery;
use MPAPI\Entity\GeneralDelivery;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('mp_mpapi_test_SAqqD_dGVzdHw0MDAw');
$logger = new Logger('loggerName');
$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));

// set logger into MP API client
$mpapiClient->setLogger($logger);

/* @var $deliveries Deliveries */
$deliveries = new MPAPI\Services\Deliveries($mpapiClient);

// Get partner deliveries
$deliveriesList = $deliveries->partner()->get();
var_dump($deliveriesList);

// Get partner delivery detail
$deliveryDetail = $deliveries->partner()->get('new_delivery1');
var_dump($deliveryDetail);

$partnerDelivery = new PartnerDelivery();
$partnerDelivery->setCode('newDelivery2');
$partnerDelivery->setTitle('New delivery 2');
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

// Create new partner delivery
$response = $deliveries->partner()->post($partnerDelivery);
var_dump($response);

// Update partner delivery
$response = $deliveries->partner()->put($partnerDelivery);
var_dump($response);

// Delete all partner deliveries
$response = $deliveries->partner()->delete();
var_dump($response);

// Delete partner delivery
$response = $deliveries->partner()->delete('newDelivery2');
var_dump($response);
