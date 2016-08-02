<?php
use MPAPI\Services\Client;
use MPAPI\Services\DeliverySettings;
use MPAPI\Entity\DeliveryMethod;
use MPAPI\Entity\DeliverySetup;

require __DIR__ . '/../vendor/autoload.php';

// initialize API client
$mpApiClient = new Client('mp_vivantis_sk_dGVzc3R8MzAw');

// initialize delivery settings service
$deliverySettings = new DeliverySettings($mpApiClient);

// load all existing delivery settings
$response = $deliverySettings->get();
// print response data
var_dump($response);


// create new delivery method without delivery setups
$deliveryMethod1 = new DeliveryMethod();
$deliveryMethod1->setId('deliveryMethod1Id')
				->setTitle('Partner delivery method title')
				->setPrice(99)
				->setCodPrice(20)
				->setFreeLimit(1000)
				->setDeliveryDelay(2)
				->setPickupPoint(false);

// create delivery method with delivery setups
$deliveryMethod2 = new DeliveryMethod();
$deliveryMethod2->setId('deliveryMethod2Id')
				->setTitle('Delivery method with setups')
				->setPrice(120)
				->setCodPrice(0)
				->setFreeLimit(0)
				->setDeliveryDelay(1)
				->setPickupPoint(false);
// create delivery setup
$deliverySetup1 = new DeliverySetup();
$deliverySetup1->setId('deliverySetupId1')
				->setPrice(100)
				->setCodPrice(0)
				->setFreeLimit(500)
				->setDeliveryDelay(3);
$deliverySetup2 = new DeliverySetup();
$deliverySetup2->setId('deliverySetupId2')
				->setPrice(200)
				->setCodPrice(20)
				->setFreeLimit(1500)
				->setDeliveryDelay(2);

// include delivery setups into delivery methods
$deliveryMethod2->addDeliverySetup($deliverySetup1)
				->addDeliverySetup($deliverySetup2);


// include delivery method into delivery settings service
$deliverySettings->add($deliveryMethod1)
				->add($deliveryMethod2)
				->put();
