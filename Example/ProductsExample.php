<?php
use MPAPI\Services\Client;
use MPAPI\Services\Products;
use MPAPI\Entity\Product;
use MPAPI\Entity\Variant;
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
$product->addVariableParameters([
	"MP_COLOR"
]);
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

// Create new product
$response = $products->post($product);
var_dump($response);

// Update product
$response = $products->put('pTU00_test', $product);
var_dump($response);

// Delete product
$response = $products->delete('pTU00_test');
var_dump($response);
