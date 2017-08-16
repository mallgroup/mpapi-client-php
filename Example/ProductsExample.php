<?php
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use MPAPI\Entity\Products\Product;
use MPAPI\Entity\Products\Variant;
use MPAPI\Exceptions\ForceTokenException;
use MPAPI\Services\Client;
use MPAPI\Services\Products;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('your_client_id', false);

if (class_exists('Logger')) {
	$logger = new Logger('loggerName');
	$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));
	// set logger into MP API client
	$mpapiClient->setLogger($logger);
}

$products = new Products($mpapiClient);

// #######################
// Get list of product IDs
// #######################
$productIds = $products->get();
var_dump($productIds);

// ####################################
// Get list of products with basic data
// Use filter to modify response
// ####################################
$products->setFilter(Products::FILTER_TYPE_BASIC);
var_dump($products->get());

// ###################
// Get product detail
// ###################
$response = $products->get($productIds[0]);
var_dump($response->getData());

$product = new Product();
$product->setId('pTU00_test');
$product->setTitle('Updated product!');
$product->setShortdesc('Short decription of book with black cover.');
$product->setLongdesc('This black book is about long description. It can also contains simple formatting like');
$product->setCategoryId('MP002PL');
$product->setPriority(1);
$product->setBarcode('0000619262110');
$product->setPrice(200);
$product->setVat(10);
$product->setRrpPrice(0);
$product->setDeliveryDelay(3);
$product->addMedia('http://i.cdn.nrholding.net/15880228', true);
$product->addPromotion(1700, '2015-07-19 00:00:00', '2018-11-15 23:59:59');
$product->addParameter('MP_COLOR', 'blue');
$product->addVariableParameters([
	'MP_COLOR'
]);
$product->addDimensions(30,90,50,35);
$product->setStatus(Product::STATUS_ACTIVE);
$product->setInStock(10);
$product->addLabel('SALE', '2015-07-19 00:00:00', '2018-11-14 23:59:59');
$product->setDeliverySetup(null);
$product->setRecommended([]);
$product->setBrandId('Samsung');
$product->setFreeDelivery(true);

// add Variants
$variant = new Variant();
$variant->setId('p50_white_XL');
$variant->setTitle('Title of Book - black cover XL');
$variant->setShortdesc('Short decription of this book.');
$variant->setLongdesc('This black book is about long description. It can also contains simple formatting like');
$variant->setPriority(1);
$variant->setBarcode('0000619262110');
$variant->setPrice(400);
$variant->setRrpPrice(229);
$variant->setDeliveryDelay(4);
$variant->addParameter('MP_COLOR', 'blue');
$variant->addParameter('MP_TYPE', 'wood');
$variant->addParameter('MP_TYPE', 'iron');
$variant->addLabel('NEW', '2015-07-19 00:00:00', '2018-11-14 23:59:59');
$variant->addDimensions(25,95,45,30);
$variant->addMedia('http://i.cdn.nrholding.net/15880228', true);
$variant->addMedia('http://i.cdn.nrholding.net/15880229', false, 'MP_COLOR');
$variant->addPromotion(1700, '2015-07-19 00:00:00', '2018-11-16 23:59:59');
$variant->setStatus(Product::STATUS_ACTIVE);
$variant->setInStock(10);
$variant->setRecommended([]);

$product->addVariant($variant);

try {
	// Create new product
	$response = $products->post($product);
	var_dump($response);

	// Update product
	$response = $products->put('pTU00_test', $product);
	var_dump($response);
} catch (\Exception $ex) {
	var_dump($ex->getMessage());
}

// Product with big different price
try {
	$product->setVariableParameters([]);
	$product->setVariants([]);
	$product->setPrice(110);
	$response = $products->put('pTU00_test', $product);
} catch (ForceTokenException $ex) {
	print('Product update failed. To confirm price difference use force token: ');
	var_export($ex->getForceToken());
	print(PHP_EOL);
}

// ####################################
// Update product in asynchronous mode
// ####################################
try {
	$products->asynchronous()->put('pTU00_test', $product);
	foreach ($products->getRequestHash() as $hash) {
		print(sprintf('Asynchronous request (hash %s) result:', $hash));
		var_dump($products->getAsynchronouseStatus($hash));
	}
} catch (\Exception $ex) {
	var_dump($ex->getMessage());
}

// Delete product
$response = $products->delete('pTU00_test');
var_dump($response);
