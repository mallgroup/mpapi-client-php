<?php declare(strict_types=1);

use MpApiClient\Common\Authenticators\ClientIdAuthenticator;
use MpApiClient\Filter\Filter;
use MpApiClient\Filter\FilterItem;
use MpApiClient\Filter\FilterOperatorEnum;
use MpApiClient\MpApiClient;
use MpApiClient\MpApiClientOptions;

require '../vendor/autoload.php';

$options = new MpApiClientOptions(
    new ClientIdAuthenticator('my-client-id')
);
$client  = MpApiClient::createFromOptions('my-app-name', $options);

// TODO: finish examples (probably split to separate files for products and variants)
// --------------

$productId = 'sMO3372';
$variantId = 'sMO3372-52';

// 3. Send query to order list endpoint without any filter
$productList = $client->article()->listProducts(null);
echo json_encode($productList, JSON_PRETTY_PRINT);

// 4. Send query to product list endpoint with filter where
// - `category_id` field is equal to EB036
// - results are sorted always by `id` field in ascending direction and this can not be changed by filters
$filter = new Filter();
$filter->addFilterItem(FilterItem::create("_category_id", "EG115", FilterOperatorEnum::EQUAL()));
// Load all results and enable autoload, to iterate over all returned pages
$filteredProductList = $client->article()->listProducts($filter);
$filteredProductList->enableAutoload();
echo json_encode($filteredProductList, JSON_PRETTY_PRINT);

// 5. Get single product by ID
$productDetail = $client->article()->getProduct($productId);
echo json_encode($productDetail, JSON_PRETTY_PRINT);

// 6. Get product availability
$availability = $client->article()->getProductAvailability($productId);
echo json_encode($availability, JSON_PRETTY_PRINT);

// 7. List all variants for product
$variantList = $client->article()->listProductVariants($productId, null);
echo json_encode($variantList, JSON_PRETTY_PRINT);

// 8. Get variant detail
$variantDetail = $client->article()->getVariant($productId, $variantId);
echo json_encode($variantDetail, JSON_PRETTY_PRINT);

// 9. Get variant availability
$variantAvailability = $client->article()->getVariantAvailability($productId, $variantId);
echo json_encode($variantAvailability, JSON_PRETTY_PRINT);
