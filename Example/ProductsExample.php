<?php
use MPAPI\Services\Client;
use MPAPI\Services\Products;
use MPAPI\Entity\Product;
use \MPAPI\Entity\Variant;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('mp_mpapi_test_SAqqD_dGVzdHw0MDAw');
$logger = new Logger('loggerName');
$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));

// set logger into MP API client
$mpapiClient->setLogger($logger);

$products = new Products($mpapiClient);
// Get products
$response = $products->get();
var_dump($response);
// Get detail products
$response = $products->get(32059);
var_dump($response->getData());

$data = [
	"id" => "pTU00_test",
	"title" => "Dont delete this product!",
	"shortdesc" => "Short decription of this book.",
	"longdesc" => "Stuha, kterou je každý z trojice balónků uvázán, aby se nevypustil. Očividně je uvázaná dostatečně pevně, protože balónky skutečně neucházejí. To ale není nic zvláštního. Překvapit by však mohl fakt, že nikdo, snad krom toho, kdo balónky k obloze vypustil, netuší, jakou má ona stuha barvu.",
	"category_id" => "MP002PL",
	"priority" => 1,
	"barcode" => "0000619262110",
	"price" => 200,
	"vat" => 10,
	"rrp" => 0,
	"media" => [
		"url" => "http=>//i.cdn.nrholding.net/15880228",
		"main" => true
	],
	"promotions" => [],
	"variants" => [

		"id" => "p50_white_XL",
		"title" => "Title of Book - black cover XL",
		"shortdesc" => "Short decription of book with black cover.",
		"longdesc" => "This black book is about long description. It can also contains simple formatting like",
		"priority" => 1,
		"barcode" => "0000619262110",
		"price" => 400,
		"rrp" => 229,
		"parameters" => [
			"MP_COLOR" => "blue"
		],
		"media" => [

			"url" => "http://i.cdn.nrholding.net/15880228",
			"main" => true

		],
		"promotions" => [

			"price" => 1700,
			"from" => "2015-07-19 00:00:00",
			"to" => "2018-11-14 23:59:59"

		],
		"availability" => [
			"status" => "A",
			"in_stock" => 1
		],
		"recommended" =>
			"pTU00_test"


	],
	"parameters" => [
		"MP_COLOR" => "blue"
	],
	"variable_parameters" => [
		"MP_COLOR"
	],
	"availability" => [
		"status" => "A",
		"in_stock" => 22
	],
	"labels" => [

		"label" => "SALE",
		"from" => "2015-07-19 00:00:00",
		"to" => "2018-11-14 23:59:59"

	],
	"delivery_setup" => null,
	"recommended" => [],
	"brand_id" => "Samsung"
];

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
$product->addMedia('http://i.cdn.nrholding.net/15880228', true);
$product->addPromotion(1700, '2015-07-19 00:00:00', '2016-11-15 23:59:59');
$product->addParameter("MP_COLOR", "blue");
$product->addVariableParameters(["MP_COLOR"]);
$product->setStatus(Product::STATUS_ACTIVE);
$product->setInStock(10);
$product->addLabel('SALE', '2015-07-19 00:00:00', '2018-11-14 23:59:59');
$product->setDeliverySetup(null);
$product->setRecommended([]);
$product->setBrandId('Samsung');

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
$variant->addParameter("MP_COLOR", "blue");
$variant->addParameter("MP_TYPE", "wood");
$variant->addParameter("MP_TYPE", "iron");
$variant->addMedia('http://i.cdn.nrholding.net/15880228', true);
$variant->addPromotion(1700, '2015-07-19 00:00:00', '2016-11-16 23:59:59');
$variant->setStatus(Product::STATUS_ACTIVE);
$variant->setInStock(10);
$variant->setRecommended([]);

$product->addVariant($variant);
$products->add($product);

// Create new product
$response = $products->post();
var_dump($response);

// Update product
$products->add($product);
$response = $products->put('pTU00_test');
var_dump($response);

// Delete product
$response = $products->delete('pTU00_test');
var_dump($response);
