<?php
use MPAPI\Services\Client;
use MPAPI\Services\Labels;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('api_marketplace_test_client_id');
$labels = new Labels($mpapiClient);
$response = $labels->get();

var_dump($response);