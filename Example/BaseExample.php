<?php
use MPAPI\Services\Client;
use MPAPI\Entity\RequestMethods;

require __DIR__ . '/../vendor/autoload.php';

// initialize API client
$mpApiClient = new Client('nonExistsClientId');

// first request with default exception handler
$mpApiClient->sendRequest('products', RequestMethods::GET);