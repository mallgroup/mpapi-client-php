# ArticleClient

## Client initialization

To see example of initialization, please look at [Implementation](../README.md#implementation) part of our [README](../README.md)

## TODO: add missing product documentation



## Update variant

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
```



## Get variant detail

Method expects `product` and `variant` id's and returns [Variant](../src/Article/Entity/Variant.php) entity.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$variantDetail = $client->article()->getVariant('my-product-id', 'my-variant-id');
echo json_encode($variantDetail, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
    "id": "TR",
    "articleId": 100001234567,
    "title": "My product - variant",
    "url": "https:\/\/www.mall.cz\/id\/100001234567",
    "shortDesc": "short desc",
    "longDesc": "<p>long desc<\/p>",
    "priority": 1,
    "barcode": null,
    "price": 34,
    "purchasePrice": 0,
    "rrp": 34,
    "media": [
        {
            "url": "http:\/\/cdn.my-domain.com\/products\/100001234567\/media\/detail-001.jpg",
            "main": true,
            "switch": null,
            "energyLabel": false,
            "informationList": false
        },
        {
            "url": "http:\/\/cdn.my-domain.com\/products\/100001234567\/media\/detail-001.jpg",
            "main": true,
            "switch": null,
            "energyLabel": false,
            "informationList": false
        }
    ],
    "promotions": [],
    "parameters": [
        {
            "id": "GENRE_OF_GAME",
            "values": [
                "adventury"
            ]
        },
        {
            "id": "TYPE_CONSOLE",
            "values": [
                "Nintendo 3DS"
            ]
        }
    ],
    "dimensions": {
        "weight": 6,
        "width": 6,
        "height": 6,
        "length": 6
    },
    "availability": {
        "status": "A",
        "inStock": 6
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

Method expects `product` and `variant` id's and does not return anything.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$articleClient->article()->deleteVariant('my-product-id', 'my-variant-id');
```

## Get variant pricing

Method expects `product` and `variant` id's and returns [Pricing](../src/Article/Entity/Common/Pricing.php) entity.

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

Method expects `product` and `variant` id's and [Pricing](../src/Article/Entity/Common/Pricing.php) entity and does not return anything.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$articleClient->updateVariantPricing(
    'my-product-id',
    'my-variant-id',
    new Pricing(99.9, 112.0, 80.5)
);
```

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

Method expects dynamic amount of `product` id's and does not return anything.

```php
/** @var MpApiClient\Common\Interfaces\ArticleClientInterface $articleClient */
$articleClient->activateSelectedProducts('my-product-id-1', 'my-product-id-2', 'my-product-id-3');
```

### See more examples [here](../example/Article.php)
