<?php
use MPAPI\Services\Client;
use MPAPI\Services\Checks;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('mp_mpapi_test_SAqqD_dGVzdHw0MDAw');

if (class_exists('Logger')) {
	$logger = new Logger('loggerName');
	$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));
	// set logger into MP API client
	$mpapiClient->setLogger($logger);
}

$checks = new Checks($mpapiClient);

// get all deliveries error
foreach ($checks->deliveries()->errors() as $error){
	echo 'Code:';
	var_dump($error->getCode());

	echo 'Msg:';
	var_dump($error->getMessage());

	echo 'Attribute:';
	var_dump($error->getAttribute());

	echo 'Value:';
	var_dump($error->getValue());

	echo 'Articles:';
	var_dump($error->getArticles());
};
