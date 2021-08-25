# SupplyDelay client

## Client initialization

To see example of initialization, please look at [Implementation](../README.md#implementation) part of our [README](../README.md)

## Get partner supply delay

Method returns [SupplyDelay](../src/SupplyDelay/Entity/SupplyDelay.php) entity.

```php
/** @var MpApiClient\Common\Interfaces\SupplyDelayClientInterface $supplyDelayClient */
$supplyDelay = $supplyDelayClient->get();
echo json_encode($supplyDelay, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
  "validFrom": "2020-12-22 00:00:00",
  "validTo": "2021-01-06 08:00:00"
}
```

## Upsert partner supply delay

- Upsert is short for Update-Insert
- Performs update of existing entity or creates new one if none exists (this eliminates the need of `create` and `update` methods)

Method expects and returns [SupplyDelay](../src/SupplyDelay/Entity/SupplyDelay.php) entity.

```php
use MpApiClient\SupplyDelay\Entity\SupplyDelay;

/** @var MpApiClient\Common\Interfaces\SupplyDelayClientInterface $supplyDelayClient */
$supplyDelay = $supplyDelayClient->upsert(
    new SupplyDelay(
        new DateTime('now'), 
        new DateTime('now + 1month'),
    )
);
var_dump($supplyDelay);
```

Example above prints out

```json
{
  "validFrom": "2021-01-01 00:00:00",
  "validTo": "2021-02-01 00:00:00"
}
```

## Delete partner supply delay

```php
/** @var MpApiClient\Common\Interfaces\SupplyDelayClientInterface $supplyDelayClient */
$supplyDelayClient->delete();
```

## Get product supply delay

Method returns [SupplyDelay](../src/SupplyDelay/Entity/SupplyDelay.php) entity.

```php
/** @var MpApiClient\Common\Interfaces\SupplyDelayClientInterface $supplyDelayClient */
$supplyDelay = $supplyDelayClient->getForProduct('product-id');
echo json_encode($supplyDelay, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
  "validFrom": "2020-12-22 00:00:00",
  "validTo": "2021-01-06 08:00:00"
}
```

## Upsert product supply delay

- Upsert is short for Update-Insert
- Performs update of existing entity or creates new one if none exists (this eliminates the need of `create` and `update` methods)

Method expects and returns [SupplyDelay](../src/SupplyDelay/Entity/SupplyDelay.php) entity.

```php
use MpApiClient\SupplyDelay\Entity\SupplyDelay;

/** @var MpApiClient\Common\Interfaces\SupplyDelayClientInterface $supplyDelayClient */
$supplyDelay = $supplyDelayClient->upsertForProduct(
    'product-id',
    new SupplyDelay(
        new DateTime('now'), 
        new DateTime('now + 1month'),
    )
);
echo json_encode($supplyDelay, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
  "validFrom": "2021-01-01 00:00:00",
  "validTo": "2021-02-01 00:00:00"
}
```

## Delete product supply delay

```php
/** @var MpApiClient\Common\Interfaces\SupplyDelayClientInterface $supplyDelayClient */
$supplyDelayClient->deleteForProduct('product-id');
```

## Get variant supply delay

Method returns [SupplyDelay](../src/SupplyDelay/Entity/SupplyDelay.php) entity.

```php
/** @var MpApiClient\Common\Interfaces\SupplyDelayClientInterface $supplyDelayClient */
$supplyDelay = $supplyDelayClient->getForVariant('product-id', 'variant-id');
echo json_encode($supplyDelay, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
  "validFrom": "2020-12-22 00:00:00",
  "validTo": "2021-01-06 08:00:00"
}
```

## Upsert variant supply delay

- Upsert is short for Update-Insert
- Performs update of existing entity or creates new one if none exists (this eliminates the need of `create` and `update` methods)

Method expects and returns [SupplyDelay](../src/SupplyDelay/Entity/SupplyDelay.php) entity.

```php
use MpApiClient\SupplyDelay\Entity\SupplyDelay;

/** @var MpApiClient\Common\Interfaces\SupplyDelayClientInterface $supplyDelayClient */
$supplyDelay = $supplyDelayClient->upsertForVariant(
    'product-id', 
    'variant-id',
    new SupplyDelay(
        new DateTime('now'), 
        new DateTime('now + 1month'),
    )
);
echo json_encode($supplyDelay, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
  "validFrom": "2021-01-01 00:00:00",
  "validTo": "2021-02-01 00:00:00"
}
```

## Delete variant supply delay

```php
/** @var MpApiClient\Common\Interfaces\SupplyDelayClientInterface $supplyDelayClient */
$supplyDelayClient->deleteForVariant('product-id', 'variant-id');
```

### See more examples [here](../example/SupplyDelay.php)
