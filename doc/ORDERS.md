## ORDERS
```
<?php
...
use MPAPI\Services\Orders;  
use MPAPI\Entity\Order;  
...  
...  
// initialize orders synchronizer  
$orders = new Orders($mpapiClient);  
```

#### Available methods:  
**GET**  
You can get information about:  
 - specific order  
 - all orders  
 - list of orders by status  
 - statistics information for given period  

***Get order statistics***  
```
...  
// get order statistics; default period is 30 days  
$allOrders = $orders->get()->stats();  
```

```
...  
// get last 7 days order statistics  
$allOrders = $orders->get()->stats(7);  
```

***Get all orders***  
```
...  
// get all orders  
$allOrders = $orders->get()->all();  
```
The response contains basic data of all orders:  
```
[  
    [  
		"id": 12345675,  
		"purchase_id": 98653274,  
		"customer_id": 1111111111,  
		"customer": "John Doe",  
		"cod": 25,  
		"ship_date": "2016-12-10",  
		"delivered_at": "2018-02-14 08:13:00",  
		"status": "delivered",  
		"payment_type: "A",  
		"confirmed": true  
    ],  
    [  
		"id": 9876543,  
		"purchase_id": 12457896,  
		"customer_id": 1111111112,  
		"customer": "Jane Doe",  
		"cod": 0,  
		"ship_date": "2016-10-21",  
		"status": "cancelled",  
		"payment_type": "B"  
		"confirmed": false  
    ],  
    ...  
]  

...  
// get all open orders, it means all that are not close (that is delivered, returned, cancelled) and so they can have status from blocked to shipped  
$openOrders = $orders->get()->open();  

// get all blocked orders  
$blockedOrders = $orders->get()->blocked();  

...  
// get all shipping orders  
$shippingOrders = $orders->get()->shipping();  

...  
// get all shipped orders  
$shippedOrders = $orders->get()->shipped();  

...  
// get all delivered orders  
$deliveredOrders = $orders->get()->delivered();  

...  
// get all returned orders  
$returnedOrders = $orders->get()->returned();  

...  
// get all cancelled orders  
$cancelledOrders = $orders->get()->cancelled();  

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
    "id" => 89591350,  
    "purchase_id" => 89591351,  
    "external_order_id" => 75,  
    "currency" => "CZK",  
    "delivery_price" => 29,  
    "cod_price" => 30,  
    "discount" => 185,  
    "payment_type" => "B",  
    "delivery_method" => "pplCz",  
    "delivery_method_id" => "21",  
    "tracking_number": "T9999999999",  
    "ship_date" => "2015-10-05",  
    "delivered_at": "2018-02-14 08:13:00",  
    "cod" => 409,  
    "address" => [  
        "customer_id" => 1111111111,  
        "name" => "John Doe",  
        "company" => "Company J. D.",  
        "phone" => "+420296245025",  
        "email" => "john@doe.tld",  
        "street" => "U Garáží 1611/1",  
        "city" => "Praha 7",  
        "zip" => "17000",  
        "country" => "CZ"  
    ],  
    "confirmed" => true,  
    "status" => "delivered",  
    "items" => [  
        [  
            "id" => "F192621",  
            "article_id" => 100000249018,  
            "quantity" => 1,  
            "price" => 350,  
            "vat" => 21,  
            "commission" => 16  
        ]  
    ]  
]  
```

**PUT**  
You can confirm a specific order or set new order status.  
The order entity has following constants for relevant statuses:
    
STATUS_OPEN  
STATUS_CANCELLED  
STATUS_SHIPPING  
STATUS_SHIPPED  
STATUS_DELIVERED  
STATUS_RETURNED  

You will change the status of the order with its order ID as the first and status constant as the second parameter:  
```
...  
$responseStatus = $orders->put()->status('yourOrderId', Order::STATUS_SHIPPING);  
...  
```

When you want to set when the order was delivered to customer, use 5th parameter of status call.
Pass this only with Order::STATUS_DELIVERED, you will recieve 400 Bad request otherwise.

```
$responseStatus = $order->put->status($order->getOrderId(), Order::STATUS_DELIVERED, true, '', $dateTimeOfDelivery);
```

You will set the tracking number of the order with its order ID as the first and tracking number as the second parameter:  
```
...  
$responseStatus = $orders->put()->trackingNumber($order->getOrderId(), 'T9999999999');  
...  
```


##### See more:  
> **/root/vendor/mallgroup/mpapi-client/Example/OrdersExample.php**
