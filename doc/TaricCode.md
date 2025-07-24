# TaricCode client

## Client initialization

To see example of initialization, please look at [Implementation](../README.md#implementation) part of our [README](../README.md)

## Get list of all CN (Combined Nomenclature) codes

Method returns [TaricCodeIterator](../src/TaricCode/Entity/TaricCodeIterator.php) containing [TaricCode](../src/TaricCode/Entity/TaricCode.php) entity.

```php
use MpApiClient\Common\Interfaces\TaricCodeClientInterface;

/** @var TaricCodeClientInterface $taricCodeClient */
$taricCodes = $taricCodeClient->list();
echo json_encode($taricCodes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
[
  {
    "id": "43031010"
  },
  {
    "id": "43031090"
  },
  {
    "id": "43039000"
  },
  ...
]
```

### See more examples [here](../example/TaricCode.php)
