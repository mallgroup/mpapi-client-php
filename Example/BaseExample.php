<?php
use MPAPI\Services\Client;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('');
$response = $mpapiClient->sendRequest('products', 'GET');

var_dump(json_decode($response->getBody()));