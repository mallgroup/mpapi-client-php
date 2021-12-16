# OrderClient

## Client initialization

To see example of initialization, please look at [Implementation](../README.md#implementation) part of our [README](../README.md)

## Get list of orders

Method expects [?Filter](../src/Filter/Filter.php) and returns [BasicOrderList](../src/Order/Entity/BasicOrderList.php) containing [BasicOrder](../src/Order/Entity/BasicOrder.php) entity.

```php
/** @var MpApiClient\Common\Interfaces\OrderClientInterface $orderClient */
$orderList = $orderClient->list(null);
echo json_encode($orderList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
    "paging": {
        "total": 940,
        "pages": 10,
        "size": 40,
        "page": 10
    },
    "data": [
        {
            "id": 10085339302,
            "purchaseId": 100853393,
            "customerId": 1089641061,
            "customer": "Firstname Surname",
            "cod": 154,
            "paymentType": "A",
            "shipDate": "2021-11-25 00:00:00",
            "trackingNumber": null,
            "trackingUrl": null,
            "deliveredAt": null,
            "status": "open",
            "confirmed": false,
            "test": false,
            "mdp": true,
            "mdpSpectrum": true,
            "mdpClassic": false
        },
        {
            "id": 10085192603,
            "purchaseId": 100851926,
            "customerId": 1100012571,
            "customer": "Firstname Surname",
            "cod": 479,
            "paymentType": "A",
            "shipDate": "2021-11-24 00:00:00",
            "trackingNumber": null,
            "trackingUrl": null,
            "deliveredAt": null,
            "status": "open",
            "confirmed": false,
            "test": false,
            "mdp": true,
            "mdpSpectrum": true,
            "mdpClassic": false
        },
        {
            "id": 10084686702,
            "purchaseId": 100846867,
            "customerId": 1095774003,
            "customer": "Firstname Surname",
            "cod": 488,
            "paymentType": "A",
            "shipDate": "2021-11-19 00:00:00",
            "trackingNumber": null,
            "trackingUrl": null,
            "deliveredAt": null,
            "status": "open",
            "confirmed": false,
            "test": false,
            "mdp": true,
            "mdpSpectrum": true,
            "mdpClassic": false
        },
        ...
    ]
}
```

## Get order detail

Method expects `order` ID and returns [Order](../src/Order/Entity/Order.php) entity.

```php
/** @var MpApiClient\Common\Interfaces\OrderClientInterface $orderClient */
$orderDetail = $orderClient->get(12345678901);
echo json_encode($orderDetail, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
    "id": 12345678901,
    "purchaseId": 123456789,
    "currency": "CZK",
    "deliveryPrice": 29,
    "codPrice": 39,
    "cod": 1867,
    "discount": 0,
    "paymentType": "A",
    "deliveryMethod": "20",
    "deliveryMethodId": "23",
    "branchId": 23,
    "branches": {
        "branchId": 23,
        "secondaryBranchId": null,
        "lastChange": null
    },
    "trackingNumber": null,
    "trackingUrl": null,
    "shipDate": "2019-07-25 00:00:00",
    "deliveryDate": "2019-07-26 00:00:00",
    "deliveredAt": null,
    "firstDeliveryAttempt": null,
    "customer": {
        "customerId": 1101334728,
        "name": "Firstname Surname",
        "company": null,
        "phone": "+420721123456",
        "email": "a@a.com",
        "street": "Pražská 121",
        "city": "Pelhřimov",
        "zip": "39301",
        "country": "CZ"
    },
    "confirmed": false,
    "status": "open",
    "items": [
        {
            "id": "pCL00275",
            "articleId": 100001054382,
            "quantity": 1,
            "price": 1799,
            "vat": 21,
            "commission": 15,
            "title": "Chloé - EDP 75 ml",
            "serialNumbers": []
        }
    ],
    "test": false,
    "mdp": true,
    "mdpClassic": true,
    "mdpSpectrum": false,
    "readyToReturn": false,
    "shipped": null,
    "open": "2019-07-25 16:12:14",
    "blocked": "2019-07-25 16:07:31",
    "lost": null,
    "returned": null,
    "cancelled": null,
    "delivered": null,
    "shipping": null,
    "ulozenkaStatusHistory": [],
    "consignmentStatusHistory": []
}
```

## Get order statistics

Method expects `order` ID and returns [Stats](../src/Order/Entity/Stats.php) entity.

```php
/** @var MpApiClient\Common\Interfaces\OrderClientInterface $orderClient */
$orderDetail = $orderClient->stats(10);
echo json_encode($orderDetail, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
    "blocked": 49,
    "open": 8,
    "shipping": 0,
    "shipped": 0,
    "cancelled": 1,
    "delivered": 0,
    "lost": 0,
    "returned": 0
}
```

## Confirm order

Method expects `order` ID and does not return anything.

```php
/** @var MpApiClient\Common\Interfaces\OrderClientInterface $orderClient */
$orderClient->confirmOrder(1234567890);
```

## Change order status

Method expects `order` ID and [StatusRequest](../src/Order/DTO/StatusRequest.php) DTO and does not return anything.

```php
/** @var MpApiClient\Common\Interfaces\OrderClientInterface $orderClient */
$statusRequest = new StatusRequest(StatusEnum::shipping());
$statusRequest->setTracking('ABC123456', 'https://tracking.company.com/id/ABC123456');
$orderClient->setStatus(1234567890, $statusRequest);
```

## Set tracking for shipped order

Method expects `order` ID and [StatusRequest](../src/Order/DTO/StatusRequest.php) DTO and does not return anything.

```php
/** @var MpApiClient\Common\Interfaces\OrderClientInterface $orderClient */
$tracking = new Tracking('ABC123456', 'https://tracking.company.com/id/ABC123456');
$orderClient->setTracking(1234567890, $tracking);
```

## Set serial numbers for order item

Method expects `order` and `orderItem` IDs and variable amount of serial numbers and does not return anything.

```php
/** @var MpApiClient\Common\Interfaces\OrderClientInterface $orderClient */
$orderClient->setItemSerialNumbers(1234567890, 1234567, 'SN12345', 'SN23456');
```

## Print labels for multiple orders

Method expects [ShippingLabelRequest](../src/Order/DTO/ShippingLabelRequest.php) DTO and returns [Labels](../src/Order/Entity/Labels.php) entity.

```php
/** @var MpApiClient\Common\Interfaces\OrderClientInterface $orderClient */
$labelRequest = new ShippingLabelRequest(ShippingLabelRequest::TYPE_PDF, 1, 4);
$labelRequest->addLabel(123456666, 2);
$labelRequest->addLabel(123456777, 1);
$labels = $orderClient->createShippingLabels($labelRequest);
echo json_encode($labels, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
    "orders": [
        {
            "orderId": 123456666,
            "barcodes": [
                "14IS50856666*001001",
                "14IS50856666*001002"
            ]
        },
        {
            "orderId": 123456777,
            "barcodes": [
                "14IS50857777*001001"
            ]
        }
    ],
    "labelsRaw": "JVBERi0xLjQKJeLjz9MKMyAwI....PgpzdGFydHhyZWYKNTAyNTcKJSVFT0Y="
}
```

### See more examples [here](../example/Order.php)
