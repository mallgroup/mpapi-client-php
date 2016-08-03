<?php
use MPAPI\Services\Client;
use MPAPI\Services\DeliverySettings;
use MPAPI\Entity\DeliveryMethod;
use MPAPI\Entity\DeliverySetup;
use MPAPI\Entity\DeliveryPricing;

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
$deliverySetup = new DeliverySetup('deliverySetupId1');
// create delivery pricing entity
$deliveryPricing = new DeliveryPricing();
$deliveryPricing->setId('deliveryMethod2Id')
				->setPrice(100)
				->setCodPrice(0)
				->setFreeLimit(500)
				->setDeliveryDelay(3);
// add delivery pricing into delivery setup
$deliverySetup->addPricing($deliveryPricing);
// add delivery pricing instance directly into delivery setup
$deliverySetup->addPricing([
	DeliveryPricing::KEY_ID => 'deliveryMethod2Id',
	DeliveryPricing::KEY_PRICE => 200,
	DeliveryPricing::KEY_COD_PRICE => 20,
	DeliveryPricing::KEY_FREE_LIMIT => 1500,
	DeliveryPricing::KEY_DELIVERY_DELAY => 2
]);

// include delivery setup into delivery methods
$deliveryMethod2->addDeliverySetup($deliverySetup);

// include delivery method into delivery settings service
$deliverySettings->add($deliveryMethod1)
				->add($deliveryMethod2)
				->put();
