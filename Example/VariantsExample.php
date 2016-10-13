<?php
use MPAPI\Services\Client;
use MPAPI\Services\Variants;
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

// your product ID
$productId = 'pTU00_te12';
$variantId = 'p50_white_ZY';

// initialize variants service
$variants = new Variants($mpapiClient);

/**
 * ############################
 * Get list of product variants
 * ############################
 */
$response = $variants->get()->variantsList($productId);
var_dump($response);

/**
 * ############################
 * Get variant detail
 * ############################
 */
$response = $variants->get()->detail($productId, $variantId);
var_dump($response->getData());


/**
 * ############################
 * Initialize entity for create,
 * update or delete variant
 * ############################
 */
$variant = new Variant();
$variant->setId('p50_white_GK');
$variant->setTitle('Title of Book - black cover XL');
$variant->setShortdesc('Short decription of this book.');
$variant->setLongdesc('This black book is about long description. It can also contains simple formatting like');
$variant->setPriority(1);
$variant->setBarcode('0000619262110');
$variant->setPrice(400);
$variant->setRrpPrice(229);
$variant->setDeliveryDelay(4);
$variant->addParameter("MP_COLOR", "blue");
$variant->addParameter("MP_TYPE", "wood");
$variant->addParameter("MP_TYPE", "iron");
$variant->addLabel('NEW', '2015-07-19 00:00:00', '2018-11-14 23:59:59');
$variant->addDimensions(25,95,45,30);
$variant->addMedia('http://i.cdn.nrholding.net/15880228', true);
$variant->addPromotion(1700, '2015-07-19 00:00:00', '2016-11-16 23:59:59');
$variant->setStatus(Product::STATUS_ACTIVE);
$variant->setInStock(10);
$variant->setRecommended([]);


/**
 * ##########################
 * Create new variant
 * ##########################
 */
$response = $variants->post($productId, $variant);
var_dump($response);


/**
 * ##########################
 * Update variant
 * ##########################
 */
$variant->setTitle($variant->getTitle() . ' - updated');
$response = $variants->put()->update($productId, $variant);
var_dump($response);


/**
 * #########################
 * Delete variant
 * ##########################
 */
$response = $variants->delete()->variant($productId, $variant->getId());
var_dump($response);
