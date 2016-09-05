<?php
use MPAPI\Services\Client;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use MPAPI\Services\Deliveries;
use MPAPI\Entity\PartnerDelivery;
use MPAPI\Entity\GeneralDelivery;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('your_client_id');
$logger = new Logger('loggerName');
$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));

// set logger into MP API client
$mpapiClient->setLogger($logger);

/* @var $deliveries Deliveries */
$deliveries = new MPAPI\Services\Deliveries($mpapiClient);

// Create entity for the first partner delivery
$partnerDelivery1 = new PartnerDelivery();
$partnerDelivery1->setCode('newDelivery1');
$partnerDelivery1->setTitle('New delivery 1');
$partnerDelivery1->setPrice(90);
$partnerDelivery1->setCodPrice(21);
$partnerDelivery1->setFreeLimit(1000);
$partnerDelivery1->setDeliveryDelay(2);
$partnerDelivery1->setAsPickupPoint(false);
$partnerDelivery1->setHeightMin(10);
$partnerDelivery1->setHeightMax(20);
$partnerDelivery1->setLengthMin(1);
$partnerDelivery1->setLengthMax(2);
$partnerDelivery1->setWidthMin(3);
$partnerDelivery1->setWidthMax(4);
$partnerDelivery1->setWeightMin(5);
$partnerDelivery1->setWeightMax(6);
$partnerDelivery1->setPriority(2);

// Create entity for the second partner delivery
$partnerDelivery2 = new PartnerDelivery();
$partnerDelivery2->setCode('newDelivery2');
$partnerDelivery2->setTitle('New delivery 2');
$partnerDelivery2->setPrice(29);
$partnerDelivery2->setCodPrice(0);
$partnerDelivery2->setFreeLimit(1000);
$partnerDelivery2->setDeliveryDelay(1);
$partnerDelivery2->setAsPickupPoint(true);
$partnerDelivery2->setHeightMin(1);
$partnerDelivery2->setHeightMax(100);
$partnerDelivery2->setLengthMin(1);
$partnerDelivery2->setLengthMax(80);
$partnerDelivery2->setWidthMin(1);
$partnerDelivery2->setWidthMax(80);
$partnerDelivery2->setWeightMin(0);
$partnerDelivery2->setWeightMax(6);
$partnerDelivery2->setPriority(1);

/**
 * During synchronization (POST, PUT, DELETE)
 * queues are cleared
 */

// Add partner deliveries into batch queue and send them
$deliveries->add($partnerDelivery1)
	->add($partnerDelivery2)
	->partner()
	->post();

// Add partner deliveries into batch queue and update them
$deliveries->add($partnerDelivery1)
	->add($partnerDelivery2)
	->partner()
	->put();

// Create entity for the first general delivery to activation
$generalDelivery1 = new GeneralDelivery();
$generalDelivery1->setCode('CP');

// Create entity for the second general delivery to activation
$generalDelivery2 = new GeneralDelivery();
$generalDelivery2->setCode('PPL');

// Add general deliveries into batch queue and send them
$deliveries->add($generalDelivery1)
	->add($generalDelivery2)
	->general()
	->put();

// Add general deliveries into batch queue and delete them
$deliveries->add($generalDelivery1)
	->add($generalDelivery2)
	->general()
	->delete();
