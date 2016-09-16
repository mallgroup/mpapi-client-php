<?php
use MPAPI\Services\Client;
use MPAPI\Services\Deliveries;


require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('mp_mpapi_test_SAqqD_dGVzdHw0MDAw');
$deliveries = new Deliveries($mpapiClient);

/**
 * ###################################
 * Get list of partner's pickup points
 * ###################################
 */
$pickupPoints = $deliveries->partnerPickupPoints()->get();
// print all pickup point ids
var_dump($pickupPoints);exit;


/**
 * ###################################
 * Get detail of partner pickup point
 * ###################################
 */
/* @var \MPAPI\Entity\PickupPoint $pickupPoint */
$pickupPoint = $deliveries->partnerPickupPoints()->get(current($pickupPoints));
// print pickup point title
var_dump($pickupPoint->getTitle());
