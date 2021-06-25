# Shop client

## Client initialization

To see example of initialization, please look at [Implementation](../README.md#implementation) part of our [README](../README.md)

## Get list of all shops

Method returns [ShopIterator](../src/Shop/Entity/ShopIterator.php) containing [Shop](../src/Shop/Entity/Shop.php) entity.

```php
use MpApiClient\Common\Interfaces\ShopClientInterface;

/** @var ShopClientInterface $shopClient */
$shops = $shopClient->list();
echo json_encode($shops, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
[
  {
    "shopId": "SK10MA",
    "countryId": "SK",
    "name": "Mall.sk",
    "currencyIso": "EUR",
    "currencySymbol": "€",
    "url": "https:\/\/mpapi.mall.sk"
  },
  {
    "shopId": "CZ10MA",
    "countryId": "CZ",
    "name": "Mall.cz",
    "currencyIso": "CZK",
    "currencySymbol": "Kč",
    "url": "https:\/\/mpapi.mall.cz"
  },
  ...
]
```

### See more examples [here](../example/Shop.php)
