<?php
use MPAPI\Services\Client;
use MPAPI\Services\Deliveries;
use MPAPI\Entity\PickupPoint;


require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('mp_mpapi_test_SAqqD_dGVzdHw0MDAw');
$deliveries = new Deliveries($mpapiClient);
// delivery code of already defined delivery method
$deliveryCode = 'new_delivery2';

/**
 * ##################################
 * Get list of district codes
 * ##################################
 */
$districtCodes = $deliveries->districts()->get();
var_dump($districtCodes);

/**
 * ##################################
 * Create pickup point
 * ##################################
 */
/* @var \MPAPI\Entity\PickupPoint $pickupPointEntity */
$pickupPointEntity = new PickupPoint();
$pickupPointEntity->setTitle('First pickup point')
	->setCode('fpp')
	->setDistrictCode('PR')
	->setCity('Praha')
	->setStreet('Hlavní 1')
	->setZip('17001')
	->setEmail('pickuppoint@store.com')
	->setPhone('606000000')
	->setHeightLimit(200)
	->setWidthLimit(150)
	->setLengthLimit(300)
	->setWeightLimit(100)
	->setLatitude(32.2154)
	->setLongitude(12.1154)
	->setNote('Pickup point is ready for handicapped')
	->setPriority(1)
	->setOpeningHours([
		[
			"day_from" => "Mon",
			"day_to" => "Fri",
			"hour_from" => "09:00",
			"hour_to" => "20:00"

		], [
			"day_from" => "Sat",
			"hour_from" => "09:00",
			"hour_to" => "16:00"
		]
	])
	->setPaymentMethods(["Visa", "MasterCard"]);
$createdPickupPoint = $deliveries->partner()->pickupPoints($deliveryCode)->create($pickupPointEntity);
var_dump($createdPickupPoint);

/**
 * ###################################
 * Get list of partner's pickup points
 * ###################################
 */
$pickupPoints = $deliveries->partner()->pickupPoints($deliveryCode)->get();
// print all pickup point ids
var_dump($pickupPoints);

/**
 * ###################################
 * Get detail of partner pickup point
 * ###################################
 */
/* @var \MPAPI\Entity\PickupPoint $pickupPoint */
$pickupPoint = $deliveries->partner()->pickupPoints($deliveryCode)->get(current($pickupPoints));
// print pickup point title
var_dump($pickupPoint->getTitle());

/**
 * ##################################
 * Update partner pickup point
 * ##################################
 */
// change pickup point title
$pickupPointEntity->setTitle('Pickup point changed title');
$updateStatus = $deliveries->partner()->pickupPoints($deliveryCode)->update($pickupPointEntity);
var_dump($updateStatus);


/**
 * #################################
 * Delete partner pickup point
 * #################################
 */
$deleteStatus = $deliveries->partner()->pickupPoints($deliveryCode)->delete($pickupPointEntity);
var_dump($deleteStatus);
