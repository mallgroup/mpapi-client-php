<?php
use MPAPI\Services\Client;

require __DIR__ . '/../vendor/autoload.php';

// initialize API client
$mpApiClient = new Client('your_client_id');

if ($mpApiClient->validatePartner() == true) {
	print('Partner is valid' . PHP_EOL);
} else {
	print('Unknown or inactive partner' . PHP_EOL);
}
