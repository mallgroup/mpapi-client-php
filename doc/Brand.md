# BrandClient

## Client initialization

To see example of initialization, please look at [Implementation](../README.md#implementation) part of our [README](../README.md)

## Get list of all brands

Method returns [BrandIterator](../src/Brand/Entity/BrandIterator.php) containing [Brand](../src/Brand/Entity/Brand.php) entity.

```php
use MpApiClient\Common\Interfaces\BrandClientInterface;

/** @var BrandClientInterface $brandClient */
$brands = $brandClient->list();
echo json_encode($brands, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
[
  {
    "brand_id": "3M",
    "title": "3M"
  },
  {
    "brand_id": "AKASA",
    "title": "Akasa"
  },
  {
    "brandId": "ZYXEL",
    "title": "Zyxel"
  },
  ...
]
```

### See more examples [here](../example/Brand.php)
