<?php
use MPAPI\Services\Client;
use MPAPI\Services\Labels;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('mp_mpapi_test_SAqqD_dGVzdHw0MDAw');
$labels = new Labels($mpapiClient);
$response = $labels->get();

var_dump($response);