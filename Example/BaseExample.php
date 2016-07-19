<?php
use MPAPI\Services\Client;
use MPAPI\Entity\RequestMethods;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('mp_vivantis_sk_dGVzdHwzMTAwdsdDSsd');
$response = $mpapiClient->sendRequest('products', RequestMethods::GET);
var_dump(json_decode($response->getBody()));