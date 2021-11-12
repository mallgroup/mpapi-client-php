# ArticleClient

## Client initialization

To see example of initialization, please look at [Implementation](../README.md#implementation) part of our [README](../README.md)

## Get list of products

Method expects [?Filter](../src/Filter/Filter.php) and returns [BasicProductList](../src/Article/Entity/BasicProductList.php) containing [BasicProduct](../src/Article/Entity/BasicProduct.php) entity.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$productList = $articleClient->listProducts(null);
echo json_encode($productList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
    "paging": {
        "total": 13,
        "pages": 1,
        "size": 13,
        "page": 1
    },
    "data": [
        {
            "id": "my-product-id",
            "productId": 100001234567,
            "title": "Product title",
            "status": "A",
            "stage": "live",
            "inStock": 45,
            "categoryId": "EG115",
            "price": 34,
            "purchasePrice": 0,
            "rrp": 34,
            "variantsCount": 3,
            "hasVariants": true
        },
        {
            "id": "my-product-id-2",
            "productId": 100001930989,
            "title": "Product title 2",
            "status": "A",
            "stage": "live",
            "inStock": 45,
            "categoryId": "EG115",
            "price": 34,
            "purchasePrice": 0,
            "rrp": 34,
            "variantsCount": 3,
            "hasVariants": true
        },
        {
            "id": "my-product-id-3",
            "productId": 100001930961,
            "title": "Product title 3",
            "status": "A",
            "stage": "live",
            "inStock": 45,
            "categoryId": "EG115",
            "price": 34,
            "purchasePrice": 0,
            "rrp": 34,
            "variantsCount": 0,
            "hasVariants": false
        },
        ...
    ]
}
```

## Create product

Method expects [ProductRequest](../src/Article/DTO/ProductRequest.php) and returns [Product](../src/Article/Entity/Product.php) entity.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
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
        new Media('https://cdn.my-domain.com/my-product-id-1.jpg', true),
        new Media('https://cdn.my-domain.com/my-product-id-energy-label.jpg', false, null, true, false),
    ),
);
$productRequest->setPrice(69);

// Add optional data
$productRequest->setDimensions(new Dimensions(2, 20, 5, 20));
$productRequest->setBrandId('BRAND_ID');
$productRequest->setBarcode('0000123456789');

// Create product
// - request returns full product detail, same as calling `getProduct` method
$createdProduct = $articleClient->createProduct($productRequest);
echo json_encode($createdProduct, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
    "stage": "live",
    "categoryId": "EG115",
    "vat": 20,
    "variants": [],
    "variableParameters": [],
    "partnerTitle": null,
    "brandId": "BRAND_ID",
    "weeeFee": null,
    "id": "my-product-id",
    "articleId": 100001234567,
    "title": "Product title",
    "url": "https:\/\/www.mall.cz\/id\/100001234567",
    "shortDesc": "Short product description",
    "longDesc": "Long product description with <strong>tags<\/strong>",
    "priority": 1,
    "barcode": "0000123456789",
    "price": 69,
    "purchasePrice": 0,
    "rrp": 69,
    "media": [
        {
            "url": "https:\/\/cdn.my-domain.com\/my-product-id-1.jpg",
            "main": true,
            "switch": null,
            "energyLabel": false,
            "informationList": false
        },
        {
            "url": "https:\/\/cdn.my-domain.com\/my-product-id-energy-label.jpg",
            "main": false,
            "switch": null,
            "energyLabel": true,
            "informationList": false
        }
    ],
    "promotions": [],
    "parameters": [],
    "dimensions": {
        "weight": 2,
        "width": 20,
        "height": 5,
        "length": 20
    },
    "availability": {
        "status": "A",
        "inStock": 1
    },
    "labels": [],
    "overrides": [],
    "recommended": [],
    "deliveryDelay": 3,
    "freeDelivery": false,
    "packageSize": "smallbox",
    "mallboxAllowed": false
}
```

## Update product

Method expects [ProductRequest](../src/Article/DTO/ProductRequest.php) and does not return anything.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
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
$articleClient->updateProduct($productRequest);
```

## Get product detail

Method expects `product` ID and returns [Product](../src/Article/Entity/Product.php) entity.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$productDetail = $articleClient->getProduct('my-product-id');
echo json_encode($productDetail, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
    "stage": "live",
    "categoryId": "EG115",
    "vat": 20,
    "variants": [],
    "variableParameters": [],
    "partnerTitle": null,
    "brandId": "BRAND_ID",
    "weeeFee": null,
    "id": "my-product-id",
    "articleId": 100001234567,
    "title": "Product title",
    "url": "https:\/\/www.mall.cz\/id\/100001234567",
    "shortDesc": "Short product description",
    "longDesc": "Long product description with <strong>tags<\/strong>",
    "priority": 1,
    "barcode": "0000123456789",
    "price": 69,
    "purchasePrice": 0,
    "rrp": 69,
    "media": [
        {
            "url": "https:\/\/cdn.my-domain.com\/my-product-id-1.jpg",
            "main": true,
            "switch": null,
            "energyLabel": false,
            "informationList": false
        },
        {
            "url": "https:\/\/cdn.my-domain.com\/my-product-id-energy-label.jpg",
            "main": false,
            "switch": null,
            "energyLabel": true,
            "informationList": false
        }
    ],
    "promotions": [],
    "parameters": [],
    "dimensions": {
        "weight": 2,
        "width": 20,
        "height": 5,
        "length": 20
    },
    "availability": {
        "status": "A",
        "inStock": 1
    },
    "labels": [],
    "overrides": [],
    "recommended": [],
    "deliveryDelay": 3,
    "freeDelivery": false,
    "packageSize": "smallbox",
    "mallboxAllowed": false
}
```

## Delete product

Method expects `product` ID and does not return anything.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$articleClient->deleteProduct('my-product-id');
```

## Get product availability

Method expects `product` ID and returns [Availability](../src/Article/Entity/Common/Availability.php) entity.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$productAvailability = $articleClient->getProductAvailability('my-product-id');
echo json_encode($productAvailability, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
    "status": "A",
    "inStock": 1
}
```

## Get product pricing

Method expects `product` ID and returns [Pricing](../src/Article/Entity/Common/Pricing.php) entity.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$productPricing = $articleClient->getProductPricing('my-product-id');
echo json_encode($productPricing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
  "price": 99.9,
  "rrp": 112,
  "purchasePrice": 80.5
}
```

## Update product pricing

Method expects `product` ID and [Pricing](../src/Article/Entity/Common/Pricing.php) entity and does not return anything.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$articleClient->updateProductPricing(
    'my-product-id',
    new Pricing(99.9, 112.0, 80.5)
);
```

---

## Get list of all variants for product

Method expects `product` id and [?Filter](../src/Filter/Filter.php) and returns [BasicVariantList](../src/Article/Entity/BasicVariantList.php) containing [BasicVariant](../src/Article/Entity/BasicVariant.php) entity.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$variantList = $articleClient->listProductVariants('my-product-id', null);
echo json_encode($variantList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
    "paging": {
        "total": 3,
        "pages": 1,
        "size": 3,
        "page": 1
    },
    "data": [
        {
            "id": "my-variant-id",
            "productId": 100001234567,
            "variantId": 100001992001,
            "title": "P2, adventury",
            "status": "A",
            "inStock": 6,
            "price": 34,
            "purchasePrice": 0,
            "rrp": 34
        },
        {
            "id": "my-variant-id-2",
            "productId": 100001234567,
            "variantId": 100001992002,
            "title": "P2, akčné - 1st person",
            "status": "A",
            "inStock": 6,
            "price": 34,
            "purchasePrice": 0,
            "rrp": 34
        },
        {
            "id": "my-variant-id-3",
            "productId": 100001234567,
            "variantId": 100001992003,
            "title": "P2, akčné - ostatné",
            "status": "A",
            "inStock": 7,
            "price": 34,
            "purchasePrice": 0,
            "rrp": 34
        }
    ]
}
```

## Create variant

Method expects `product` id and [VariantRequest](../src/Article/DTO/VariantRequest.php) and returns [Variant](../src/Article/Entity/Variant.php) entity.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$variantRequest = new VariantRequest(
    'my-variant-id',
    'Variant title',
    'Short variant description',
    'Long variant description with <strong>tags</strong>',
    1,
    20,
    new MediaIterator(
        new Media('https://cdn.my-domain.com/my-variant-id-1.jpg', true),
        new Media('https://cdn.my-domain.com/my-variant-id-energy-label.jpg', false, null, true, false),
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
$createdVariant = $articleClient->createVariant('my-product-id', $variantRequest);
echo json_encode($createdVariant, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
    "id": "my-variant-id",
    "articleId": 100001234567,
    "title": "Variant title",
    "url": "https:\/\/www.mall.cz\/id\/100001234567",
    "shortDesc": "Short variant description",
    "longDesc": "Long variant description with <strong>tags<\/strong>",
    "priority": 1,
    "barcode": "0000123456789",
    "price": 20,
    "purchasePrice": 0,
    "rrp": 20,
    "media": [
        {
            "url": "https:\/\/cdn.my-domain.com\/my-variant-id-1.jpg",
            "main": true,
            "switch": null,
            "energyLabel": false,
            "informationList": false
        },
        {
            "url": "https:\/\/cdn.my-domain.com\/my-variant-id-energy-label.jpg",
            "main": false,
            "switch": null,
            "energyLabel": true,
            "informationList": false
        }
    ],
    "promotions": [],
    "parameters": [
        {
            "id": "MP_PARAMETER",
            "values": [
                "a",
                "b",
                "c"
            ]
        }
    ],
    "dimensions": {
        "weight": 2,
        "width": 20,
        "height": 5,
        "length": 20
    },
    "availability": {
        "status": "A",
        "inStock": 1
    },
    "labels": [],
    "overrides": [],
    "recommended": [],
    "deliveryDelay": 3,
    "freeDelivery": false,
    "packageSize": "smallbox",
    "mallboxAllowed": false
}
```

## Update variant

Method expects `product` id and [VariantRequest](../src/Article/DTO/VariantRequest.php) and does not return anything.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$variantRequest = new VariantRequest(
    'my-variant-id',
    'Variant title',
    'Short variant description',
    'Long variant description with <strong>tags</strong>',
    1,
    20,
    new MediaIterator(
        new Media('https://cdn.my-domain.com/my-variant-id-1.jpg', true),
        new Media('https://cdn.my-domain.com/my-variant-id-energy-label.jpg', false, null, true, false),
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
$articleClient->updateVariant('my-product-id', $variantRequest);
```

## Get variant detail

Method expects `product` and `variant` IDs and returns [Variant](../src/Article/Entity/Variant.php) entity.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$variantDetail = $articleClient->getVariant('my-product-id', 'my-variant-id');
echo json_encode($variantDetail, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
    "id": "my-variant-id",
    "articleId": 100001234567,
    "title": "Variant title",
    "url": "https:\/\/www.mall.cz\/id\/100001234567",
    "shortDesc": "Short variant description",
    "longDesc": "Long variant description with <strong>tags<\/strong>",
    "priority": 1,
    "barcode": "0000123456789",
    "price": 20,
    "purchasePrice": 0,
    "rrp": 20,
    "media": [
        {
            "url": "https:\/\/cdn.my-domain.com\/my-variant-id-1.jpg",
            "main": true,
            "switch": null,
            "energyLabel": false,
            "informationList": false
        },
        {
            "url": "https:\/\/cdn.my-domain.com\/my-variant-id-energy-label.jpg",
            "main": false,
            "switch": null,
            "energyLabel": true,
            "informationList": false
        }
    ],
    "promotions": [],
    "parameters": [
        {
            "id": "MP_PARAMETER",
            "values": [
                "a",
                "b",
                "c"
            ]
        }
    ],
    "dimensions": {
        "weight": 2,
        "width": 20,
        "height": 5,
        "length": 20
    },
    "availability": {
        "status": "A",
        "inStock": 1
    },
    "labels": [],
    "overrides": [],
    "recommended": [],
    "deliveryDelay": 3,
    "freeDelivery": false,
    "packageSize": "smallbox",
    "mallboxAllowed": false
}
```

## Delete variant

Method expects `product` and `variant` IDs and does not return anything.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$articleClient->deleteVariant('my-product-id', 'my-variant-id');
```

## Get variant availability

Method expects `product` and `variant` IDs and returns [Availability](../src/Article/Entity/Common/Availability.php) entity.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$variantAvailability = $articleClient->getVariantAvailability('my-product-id', 'my-variant-id');
echo json_encode($variantAvailability, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
    "status": "A",
    "inStock": 1
}
```

## Get variant pricing

Method expects `product` and `variant` IDs and returns [Pricing](../src/Article/Entity/Common/Pricing.php) entity.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$variantPricing = $articleClient->getVariantPricing('my-product-id', 'my-variant-id');
echo json_encode($variantPricing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
  "price": 99.9,
  "rrp": 112,
  "purchasePrice": 80.5
}
```

## Update variant pricing

Method expects `product` and `variant` IDs and [Pricing](../src/Article/Entity/Common/Pricing.php) entity and does not return anything.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$articleClient->updateVariantPricing(
    'my-product-id',
    'my-variant-id',
    new Pricing(99.9, 112.0, 80.5)
);
```

---

## Update availability

Method expects [BatchAvailabilityIterator](../src/Article/DTO/BatchAvailabilityIterator.php) DTO and does not return anything.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$articleClient->updateBatchAvailability(
    new BatchAvailabilityIterator(
        new BatchAvailability('my-product-id', StatusEnum::ACTIVE(), 2),
        new BatchAvailability('my-variant-id', StatusEnum::ACTIVE(), 2),
    )
);
```

## Activate all products

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$articleClient->activateAllProducts();
```

## Activate selected products

Method expects variable amount of `product` IDs and does not return anything.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$articleClient->activateSelectedProducts('my-product-id-1', 'my-product-id-2', 'my-product-id-3');
```

### See more examples [here](../example/Article.php)
