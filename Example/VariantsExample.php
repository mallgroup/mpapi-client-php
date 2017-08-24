<?php
use MPAPI\Services\Client;
use MPAPI\Services\Variants;
use MPAPI\Entity\Products\Product;
use MPAPI\Entity\Products\Variant;
use MPAPI\Exceptions\ForceTokenException;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('your_client_id');

if (class_exists('Logger')) {
	$logger = new Logger('loggerName');
	$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));
	// set logger into MP API client
	$mpapiClient->setLogger($logger);
}

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
 * ############################################
 * Get list of product variants with basic data
 * ############################################
 */
$variants->setFilter(Variants::FILTER_TYPE_BASIC);
$response = $variants->get($productId);
var_dump($response);

// Remove used filter
$variants->removeFilter();

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
// add main media
$variant->addMedia('http://i.cdn.nrholding.net/15880228', true);
// add media used as variant switch
$variant->addMedia('http://i.cdn.nrholding.net/15880229', false, true);
// add ordinary media (with no special usage)
$variant->addMedia('http://i.cdn.nrholding.net/15880230');
$variant->addPromotion(1700, '2015-07-19 00:00:00', '2018-11-16 23:59:59');
$variant->setStatus(Product::STATUS_ACTIVE);
$variant->setInStock(10);
$variant->setRecommended([]);
// enable free delivery
$variant->setFreeDelivery(true);


/**
 * ##########################
 * Create new variant
 * ##########################
 */
$createStatus = $variants->post($productId, $variant);
print('Variant created: ');
var_export($createStatus);
print(PHP_EOL);

/**
 * ##########################
 * Update variant
 * ##########################
 */
$variant->setTitle('Changed variant title');
// disable free delivery
$variant->setFreeDelivery(false);
$updateStatus = $variants->put($productId, $variant);
print('Variant updated: ');
var_export($updateStatus);
print(PHP_EOL);

// Variant with big different price.
try {
	$variant->setPrice(2000);
	$variants->put($productId, $variant);
} catch (ForceTokenException $ex) {
	print('Variant update failed. To confirm price difference use force token: ');
	// get force token
	$forceToken = $ex->getForceToken();
	var_export($forceToken);
	print(PHP_EOL);
	// set token to the client args and repeat variant update
	$mpapiClient->setArgument(Product::ARG_FORCE_TOKEN, $forceToken);
	$response = $variants->put($productId, $variant);
}

/**
 * #########################
 * Delete variant
 * ##########################
 */
$deleteStatus = $variants->delete($productId, $variant->getId());
print('Variant deleted: ');
var_export($deleteStatus);
print(PHP_EOL);
