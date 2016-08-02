#ORDERS
```
<?php
...
use MPAPI\Services\Orders;
use MPAPI\Entity\Order;
...
```

####Available methods:
**GET**
You can get information about order or information about all open/unconfirmed orders:
```
...
// initialize orders synchronizer
$orders = new Orders($mpapiClient);
// get all open orders
$openOrders = $orders->get()->open();

...
// get all unconfirmed orders
$unconfirmedOrders = $orders->get()->unconfirmed();

...
// get order detail
if (!empty($openOrders)) {
	// get order detail
	$order = $orders->get()->detail($openOrders[0]);
}
```

**PUT**
You can set order status or confirm order:
```
...
// initialize orders synchronizer
$orders = new Orders($mpapiClient);

...
// update order status
if (!empty($openOrders)) {
	$order = $orders->get()->detail($openOrders[0]);
	$responseStatus = $orders->put()->status($order->getOrderId(), Order::STATUS_SHIPPING);
}
```

See more:
> **/root/vendor/mallgroup/mpapi-client/Example/OrdersExample.php**