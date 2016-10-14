<?php
use MPAPI\Services\Client;
use MPAPI\Services\Variants;
use MPAPI\Entity\Product;
use MPAPI\Entity\Variant;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('your_client_id');
$logger = new Logger('loggerName');
$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));

// set logger into MP API client
$mpapiClient->setLogger($logger);

// your product and variant IDs
$productId = 'your_product_id';
$variantId = 'your_variant_id';

// initialize variants service
$variants = new Variants($mpapiClient);

/**
 * ############################
 * Get list of product variants
 * ############################
 */
$response = $variants->get($productId);
var_dump($response);

/**
 * ############################
 * Get variant detail
 * ############################
 */
$variantEntity = $variants->get($productId, $variantId);
var_dump($variantEntity->getData());


/**
 * ############################
 * Initialize entity for create,
 * update or delete variant
 * ############################
 */
$variant = new Variant();
$variant->setId('newVariantId');
$variant->setTitle('Title of your variant - black cover XL');
$variant->setShortdesc('Short decription of this article.');
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
$createStatus = $variants->post($productId, $variant);
print('Create variant: ');
var_export($createStatus);
print(PHP_EOL);

/**
 * ##########################
 * Update variant
 * ##########################
 */
$variant->setTitle('Changed variant title');
$updateStatus = $variants->put($productId, $variant);
print('Update variant: ');
var_export($updateStatus);
print(PHP_EOL);


/**
 * #########################
 * Delete variant
 * ##########################
 */
$deleteStatus = $variants->delete($productId, $variant->getId());
print('Delete variant: ');
var_export($deleteStatus);
print(PHP_EOL);
