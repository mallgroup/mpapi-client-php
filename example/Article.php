<?php declare(strict_types=1);

use MpApiClient\Article\DTO\BatchAvailability;
use MpApiClient\Article\DTO\BatchAvailabilityIterator;
use MpApiClient\Article\DTO\ProductRequest;
use MpApiClient\Article\DTO\VariantRequest;
use MpApiClient\Article\DTO\VariantRequestIterator;
use MpApiClient\Article\Entity\Common\Availability;
use MpApiClient\Article\Entity\Common\Dimensions;
use MpApiClient\Article\Entity\Common\Media;
use MpApiClient\Article\Entity\Common\MediaIterator;
use MpApiClient\Article\Entity\Common\Parameter;
use MpApiClient\Article\Entity\Common\ParameterIterator;
use MpApiClient\Article\Entity\Common\Pricing;
use MpApiClient\Article\Entity\Common\StatusEnum;
use MpApiClient\Common\Authenticators\ClientIdAuthenticator;
use MpApiClient\Exception\MpApiException;
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

//
// Get product list
//

try {
    // Create a filter, to only return products with `category_id` = `EG115`
    $filter = new Filter();
    $filter->addFilterItem(FilterItem::create('_category_id', 'EG115', FilterOperatorEnum::EQUAL()));

    // list products with custom filter (filter is optional)
    $productList = $client->article()->listProducts($filter);

    // enable autoload, to iterate over all results, not only first page
    $productList->enableAutoload();

    // Print all products as json object
    echo json_encode($productList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get all product as array
    var_dump($productList->jsonSerialize());

    // Iterate over the returned list
    foreach ($productList as $product) {
        echo 'Title: ' . $product->getTitle() . PHP_EOL;
        echo 'Id: ' . $product->getProductId() . PHP_EOL;
        echo 'Product id: ' . $product->getProductId() . PHP_EOL;
        echo 'Category id: ' . $product->getCategoryId() . PHP_EOL;
        echo 'Stage: ' . $product->getStage()->getValue() . PHP_EOL;
        echo 'Status: ' . $product->getStatus()->getValue() . PHP_EOL;
        echo 'In stock: ' . $product->getInStock() . PHP_EOL;
        echo 'Rrp: ' . $product->getRrp() . PHP_EOL;
        echo 'Price: ' . $product->getPrice() . PHP_EOL;
        echo 'Purchase price: ' . $product->getPurchasePrice() . PHP_EOL;
        echo 'Variants count: ' . $product->getVariantsCount() . PHP_EOL;
        echo PHP_EOL;
    }
} catch (MpApiException $e) {
    echo 'Unexpected error occurred, while loading product list: ' . $e->getMessage();
}

//
// Create product
//

try {
    // Create basic product request
    $productRequest = new ProductRequest(
        'my-product-id',
        'Product title',
        'Short product description',
        'Long product description with <strong>tags</strong>',
        'EG115',
        20,
        1,
    );

    // Add data required for product creation
    $productRequest->setAvailability(new Availability(StatusEnum::ACTIVE(), 1));
    $productRequest->setMedia(
        new MediaIterator(
            new Media('https://cdn.my-domain.com/my-product-id-1.jpeg', true),
            new Media('https://cdn.my-domain.com/my-product-id-energy-label.jpeg', false, null, true, false),
        ),
    );
    $productRequest->setPrice(69);

    // Add optional data
    $productRequest->setBrandId('BRAND_ID');
    $productRequest->setBarcode('0000123456789');

    // To create product with variants, variants may be specified during product creation using VariantRequest and VariantRequestIterator
    $productRequest->setVariants(new VariantRequestIterator());

    // Create product
    // - request returns full product detail, same as calling `getProduct` method
    $createdProduct = $client->article()->createProduct($productRequest);

    // Print product as json object
    echo json_encode($createdProduct, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get product as array
    var_dump($createdProduct->jsonSerialize());
} catch (MpApiException | Exception $e) {
    echo 'Unexpected error occurred, during product creation: ' . $e->getMessage();
}

//
// Update product
//

try {
    // Create basic product request with all mandatory data
    $productRequest = new ProductRequest(
        'my-product-id',
        'Product title',
        'Short product description',
        'Long product description with <strong>tags</strong>',
        'EG115',
        20,
        1,
    );

    // Add optional data
    $productRequest->setBrandId('BRAND_ID');
    $productRequest->setBarcode('0000123456789');

    // Update product
    // - API returns same data that were sent in, which is not the same as data returned by `getProduct` method
    // - that's why client does not return anything (you already have data you sent in `$productRequest` variable)
    $client->article()->updateProduct($productRequest);
} catch (MpApiException $e) {
    echo 'Unexpected error occurred, during product update: ' . $e->getMessage();
}

//
// Get product detail
//

try {
    $productDetail = $client->article()->getProduct('my-product-id');

    // Print product as json object
    echo json_encode($productDetail, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get product as array
    var_dump($productDetail->jsonSerialize());

    // Print some product data
    echo 'Title: ' . $productDetail->getTitle() . PHP_EOL;
    echo 'Id: ' . $productDetail->getId() . PHP_EOL;
    echo 'Article id: ' . $productDetail->getArticleId() . PHP_EOL;
    echo 'Stage: ' . $productDetail->getStage()->getValue() . PHP_EOL;
    echo 'Status: ' . $productDetail->getAvailability()->getStatus() . PHP_EOL;
    echo PHP_EOL;
} catch (MpApiException | Exception $e) {
    echo 'Unexpected error occurred, while loading product detail: ' . $e->getMessage();
}

//
// Delete product
//

try {
    $client->article()->deleteProduct('my-product-id');
} catch (MpApiException $e) {
    echo 'Unexpected error occurred, during product deletion: ' . $e->getMessage();
}

//
// Get product availability
//

try {
    $productAvailability = $client->article()->getProductAvailability('my-product-id');

    // Print product availability as json object
    echo json_encode($productAvailability, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get product availability as array
    var_dump($productAvailability->jsonSerialize());

    // Print product availability data
    echo 'Status: ' . $productAvailability->getStatus() . PHP_EOL;
    echo 'In stock: ' . $productAvailability->getInStock() . PHP_EOL;
    echo PHP_EOL;
} catch (MpApiException $e) {
    echo 'Unexpected error occurred, while loading product availability: ' . $e->getMessage();
}

//
// Get product pricing
//

try {
    $productPricing = $client->article()->getProductPricing('my-product-id');

    // Print product pricing as json object
    echo json_encode($productPricing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get product pricing as array
    var_dump($productPricing->jsonSerialize());

    // Print product pricing data
    echo 'Rrp: ' . $productPricing->getRrp() . PHP_EOL;
    echo 'Price: ' . $productPricing->getPrice() . PHP_EOL;
    echo 'Purchase price: ' . $productPricing->getPurchasePrice() . PHP_EOL;
    echo PHP_EOL;
} catch (MpApiException $e) {
    echo 'Unexpected error occurred, while loading product pricing: ' . $e->getMessage();
}

//
// Update product pricing
//

try {
    $client->article()->updateProductPricing(
        'my-product-id',
        new Pricing(99.9, 112.0, 80.5)
    );
} catch (MpApiException $e) {
    echo 'Unexpected error occurred, during product pricing update: ' . $e->getMessage();
}

//
// List all variants for product
//

try {
    $variantList = $client->article()->listProductVariants('my-product-id', null);

    // Print all variants as json object
    echo json_encode($variantList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get all variants as array
    var_dump($variantList->jsonSerialize());

    // Iterate over the returned list
    foreach ($variantList as $variant) {
        echo 'Title: ' . $variant->getTitle() . PHP_EOL;
        echo 'Id: ' . $variant->getProductId() . PHP_EOL;
        echo 'Product id: ' . $variant->getProductId() . PHP_EOL;
        echo 'Variant id: ' . $variant->getVariantId() . PHP_EOL;
        echo 'Status: ' . $variant->getStatus()->getValue() . PHP_EOL;
        echo 'In stock: ' . $variant->getInStock() . PHP_EOL;
        echo 'Rrp: ' . $variant->getRrp() . PHP_EOL;
        echo 'Price: ' . $variant->getPrice() . PHP_EOL;
        echo 'Purchase price: ' . $variant->getPurchasePrice() . PHP_EOL;
        echo PHP_EOL;
    }
} catch (MpApiException $e) {
    echo 'Unexpected error occurred, while loading variant list: ' . $e->getMessage();
}

//
// Create variant
//

try {
    // Create variant request
    $variantRequest = new VariantRequest(
        'my-variant-id',
        'Variant title',
        'Short variant description',
        'Long variant description with <strong>tags</strong>',
        1,
        20,
        new MediaIterator(
            new Media('https://cdn.my-domain.com/my-variant-id-1.jpeg', true),
            new Media('https://cdn.my-domain.com/my-variant-id-energy-label.jpeg', false, null, true, false),
        ),
        new ParameterIterator(
            Parameter::create('MP_PARAMETER', 'a', 'b', 'c'),
        ),
    );

    // Add data required for variant creation
    $variantRequest->setAvailability(new Availability(StatusEnum::ACTIVE(), 1));

    // Add optional data
    $variantRequest->setDimensions(new Dimensions(2, 20, 5, 20));
    $variantRequest->setBarcode('0000123456789');

    // Create variant
    // - request returns full variant detail, same as calling `getVariant` method
    $createdVariant = $client->article()->createVariant('my-product-id', $variantRequest);

    // Print variant as json object
    echo json_encode($createdVariant, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get variant as array
    var_dump($createdVariant->jsonSerialize());
} catch (MpApiException | Exception $e) {
    echo 'Unexpected error occurred, during variant creation: ' . $e->getMessage();
}

//
// Update variant
//

try {
    // Create variant request
    $variantRequest = new VariantRequest(
        'my-variant-id',
        'Variant title',
        'Short variant description',
        'Long variant description with <strong>tags</strong>',
        1,
        20,
        new MediaIterator(
            new Media('https://cdn.my-domain.com/my-variant-id-1.jpeg', true),
            new Media('https://cdn.my-domain.com/my-variant-id-energy-label.jpeg', false, null, true, false),
        ),
        new ParameterIterator(
            Parameter::create('MP_PARAMETER', 'a', 'b', 'c'),
        ),
    );

    // Add optional data
    $variantRequest->setDimensions(new Dimensions(2, 20, 5, 20));
    $variantRequest->setBarcode('0000123456789');

    // Update variant
    // - API returns same data that were sent in, which is not the same as data returned by `getVariant` method
    // - that's why client does not return anything (you already have data you sent in `$variantRequest` variable)
    $client->article()->updateVariant('my-product-id', $variantRequest);
} catch (MpApiException $e) {
    echo 'Unexpected error occurred, during variant update: ' . $e->getMessage();
}

//
// Get variant detail
//

try {
    $variantDetail = $client->article()->getVariant('my-product-id', 'my-variant-id');

    // Print variant as json object
    echo json_encode($variantDetail, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get variant as array
    var_dump($variantDetail->jsonSerialize());

    // Print some variant data
    echo 'Title: ' . $variantDetail->getTitle() . PHP_EOL;
    echo 'Id: ' . $variantDetail->getId() . PHP_EOL;
    echo 'Article id: ' . $variantDetail->getArticleId() . PHP_EOL;
    echo 'Status: ' . $variantDetail->getAvailability()->getStatus() . PHP_EOL;
    echo PHP_EOL;
} catch (MpApiException | Exception $e) {
    echo 'Unexpected error occurred, while loading variant detail: ' . $e->getMessage();
}

//
// Delete variant
//

try {
    $client->article()->deleteVariant('my-product-id', 'my-variant-id');
} catch (MpApiException $e) {
    echo 'Unexpected error occurred, during variant deletion: ' . $e->getMessage();
}

//
// Get variant availability
//

try {
    $variantAvailability = $client->article()->getVariantAvailability('my-product-id', 'my-variant-id');

    // Print variant availability as json object
    echo json_encode($variantAvailability, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get variant availability as array
    var_dump($variantAvailability->jsonSerialize());

    // Print variant availability data
    echo 'Status: ' . $variantAvailability->getStatus() . PHP_EOL;
    echo 'In stock: ' . $variantAvailability->getInStock() . PHP_EOL;
    echo PHP_EOL;
} catch (MpApiException $e) {
    echo 'Unexpected error occurred, while loading variant availability: ' . $e->getMessage();
}

//
// Get variant pricing
//

try {
    $variantPricing = $client->article()->getVariantPricing('my-product-id', 'my-variant-id');

    // Print variant pricing as json object
    echo json_encode($variantPricing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get variant pricing as array
    var_dump($variantPricing->jsonSerialize());

    // Print variant pricing data
    echo 'Rrp: ' . $variantPricing->getRrp() . PHP_EOL;
    echo 'Price: ' . $variantPricing->getPrice() . PHP_EOL;
    echo 'Purchase price: ' . $variantPricing->getPurchasePrice() . PHP_EOL;
    echo PHP_EOL;
} catch (MpApiException $e) {
    echo 'Unexpected error occurred, while loading variant pricing: ' . $e->getMessage();
}

//
// Update variant pricing
//

try {
    $client->article()->updateVariantPricing(
        'my-product-id',
        'my-variant-id',
        new Pricing(99.9, 112.0, 80.5)
    );
} catch (MpApiException $e) {
    echo 'Unexpected error occurred, during variant pricing update: ' . $e->getMessage();
}

//
// Update availability
//

try {
    $client->article()->updateBatchAvailability(
        new BatchAvailabilityIterator(
            new BatchAvailability('my-product-id', StatusEnum::ACTIVE(), 2),
            new BatchAvailability('my-variant-id', StatusEnum::ACTIVE(), 2),
        )
    );
} catch (MpApiException $e) {
    echo 'Unexpected error occurred, during batch availability update: ' . $e->getMessage();
}

//
// Activate all products
//

try {
    $client->article()->activateAllProducts();
} catch (MpApiException $e) {
    echo 'Unexpected error occurred, during activation of all products: ' . $e->getMessage();
}

//
// Activate selected products
//

try {
    $client->article()->activateSelectedProducts('my-product-id-1', 'my-product-id-2', 'my-product-id-3');
} catch (MpApiException $e) {
    echo 'Unexpected error occurred, during activation of selected products: ' . $e->getMessage();
}
