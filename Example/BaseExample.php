<?php
use MPAPI\Services\Client;

require __DIR__ . '/../vendor/autoload.php';

// initialize API client
$mpApiClient = new Client('mp_mpapi_test_SAqqD_dGVzdHw0MDAw');

if ($mpApiClient->validatePartner() == true) {
	print('Partner is valid' . PHP_EOL);
} else {
	print('Unknown or inactive partner' . PHP_EOL);
}
