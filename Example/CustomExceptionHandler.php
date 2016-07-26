<?php
use MPAPI\Services\Client;
use MPAPI\Entity\RequestMethods;

require __DIR__ . '/../vendor/autoload.php';

// initialize API client
$mpApiClient = new Client('nonExistsClientId');

// specify custom excepation handling
$mpApiClient->setExceptionHandler(function (\Exception $exception) {
	// write exception into log file
	file_put_contents('exceptions.log', date('Y-m-d H:i:s') . ': ' . $exception->getMessage() . PHP_EOL, FILE_APPEND);
});

// send request with custom exception handler
$mpApiClient->sendRequest('products', RequestMethods::GET);