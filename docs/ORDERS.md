## ORDERS
```
<?php
...
use MPAPI\Services\Orders;
use MPAPI\Entity\Order;
...
// initialize orders synchronizer
$orders = new Orders($mpapiClient);
```

#### Available methods:
**GET**
You can get either information about specific order or information about all open/unconfirmed orders:
```
...
// get all open orders
$openOrders = $orders->get()->open();

...
// get all unconfirmed orders
$unconfirmedOrders = $orders->get()->unconfirmed();

...
// get order detail 
$response = $orders->get()->detail('yourOrderId');
```

The response contains order details:  
```
[
    "id": 89591350,
    "purchase_id": 89591351,
    "external_order_id": 75,
    "currency": "CZK",
    "delivery_price": 29,
    "cod_price": 30,
    "discount": 185,
    "delivery_method": "pplCz",
    "delivery_method_id": "21",
    "ship_date": "2015-10-05",
    "cod": 409,
    "address": [
        "name": "John Doe",
        "company": "Company J. D."
        "phone": "+420296245025",
        "email": "john@doe.tld",
        "street": "U Garáží 1611/1",
        "city": "Praha 7",
        "zip": "17000",
        "country": "CZ"
    ],
    "confirmed": true,
    "status": "delivered",
    "items": [
        [
            "id": "F192621",
            "quantity": 1,
            "price": 350,
            "vat": 21
        ]
    ]
]
```

**PUT**
You can set order status or confirm order:
```
...
// update order status
$order = $orders->get()->detail('yourOrderId');
```
You can use following statuses: open | cancelled | shipping | shipped | delivered | returned
```
$responseStatus = $orders->put()->status('yourOrderId', Order::STATUS_SHIPPING);
```

##### Example
> **/root/vendor/mallgroup/mpapi-client/Example/OrdersExample.php**