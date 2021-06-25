# Checks client

## Client initialization

To see example of initialization, please look at [Implementation](../README.md#implementation) part of our [README](../README.md)

## Get delivery errors

Method returns [CheckErrorIterator](../src/Checks/Entity/ErrorIterator.php) containing [CheckError](../src/Checks/Entity/Error.php) entity.

```php
use MpApiClient\Common\Interfaces\ChecksClientInterface;

/** @var ChecksClientInterface $checksClient */
$deliveryErrors = $checksClient->getDeliveryErrors();
echo json_encode($deliveryErrors, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
[
  {
    "code": "MISSING_PACKAGE_DELIVERY",
    "attribute": "package_size",
    "value": "smallbox",
    "msg": "There is no delivery for 'smallbox' package size.",
    "articles": [
      "1047"
    ]
  }
]
```

## Get media errors

Method returns [CheckErrorIterator](../src/Checks/Entity/ErrorIterator.php) containing [CheckError](../src/Checks/Entity/Error.php) entity.

```php
use MpApiClient\Common\Interfaces\ChecksClientInterface;

/** @var ChecksClientInterface $checksClient */
$mediaErrors = $checksClient->getMediaErrors();
echo json_encode($mediaErrors, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
[
  {
    "code": "MEDIA_VALIDATION_ERROR",
    "attribute": "media",
    "value": "https:\/\/cdn.my-company.cz\/non-existing-image\/large.jpg",
    "msg": "cURL error 28: Operation timed out after 0 milliseconds with 0 out of 0 bytes received (see http:\/\/curl.haxx.se\/libcurl\/c\/libcurl-errors.html)",
    "articles": [
      "0180869"
    ]
  },
  {
    "code": "MEDIA_VALIDATION_ERROR",
    "attribute": "media",
    "value": "https:\/\/cdn.my-company.cz\/image-with-big-dimensions\/large.jpg",
    "msg": "Sent media exceeded allowed value of 2000px. Your dimensions for media are 2480px x 945px.",
    "articles": [
      "0234030"
    ]
  },
  {
    "code": "MEDIA_VALIDATION_ERROR",
    "attribute": "media",
    "value": "https:\/\/cdn.my-company.cz\/very-large-image\/large.jpg",
    "msg": "Image size exceeded. Allowed image size is 2MB.",
    "articles": [
      "0234030"
    ]
  },
  {
    "code": "MEDIA_VALIDATION_ERROR",
    "attribute": "media",
    "value": "https:\/\/cdn.my-company.cz\/unsupported-image\/large.jpg",
    "msg": "Unsupported mime type",
    "articles": [
      "0234030"
    ]
  },
  ...
]
```

### See more examples [here](../example/Checks.php)
