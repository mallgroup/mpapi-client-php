# Label client

## Client initialization

To see example of initialization, please look at [Implementation](../README.md#implementation) part of our [README](../README.md)

## Get list of all labels

Method returns [LabelIterator](../src/Label/Entity/LabelIterator.php) containing [Label](../src/Label/Entity/Label.php) entity.

```php
use MpApiClient\Common\Interfaces\LabelClientInterface;

/** @var LabelClientInterface $labelClient */
$labels = $labelClient->list();
echo json_encode($labels, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
[
  {
    "id": "TIP2",
    "title": "Náš tip"
  },
  {
    "id": "SALE",
    "title": "Výprodej"
  },
  {
    "id": "FDEL",
    "title": "Doprava zdarma"
  },
  ...
]
```

### See more examples [here](../example/Label.php)
