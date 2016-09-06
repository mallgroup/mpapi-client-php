## PARTNER DELIVERIES


#### Available methods:
**GET**  
This method loads all partner deliveries.
```
<?php 
...
use MPAPI\Services\Deliveries;
... 

// Create an instance of deliveries service
$deliveries = new Deliveries($mpapiClient);  

// Get partner deliveries
$response = $deliveries->partner()->get();
...

```
The response contains an array of available partner deliveries:
```
{
    "ids": [
        "newDelivery1",
        "newDelivery2",
        ...
    ]
}
```

**POST**  
Use post method to create new partner delivery.
```
...
// Create one delivery
$delivery = new PartnerDelivery();
$delivery->setCode('newDelivery1');
         ->setTitle('New delivery 1');
         ->setPrice(90);
         ...

$deliveries = new Deliveries($mpapiClient);  
$response = $deliveries->partner()->post($delivery);
```

```
// Create more deliveries
$delivery1 = new PartnerDelivery();
$delivery1->setCode('newDelivery1');
          ->setTitle('New delivery 1');
          ->setPrice(90);
          ...

$delivery2 = new PartnerDelivery();
$delivery2->setCode('newDelivery2');
          ->setTitle('New delivery 2');
          ->setPrice(29);
          ...

$deliveries->add($delivery1)
           ->add($delivery2)
           ->partner()
           ->post();
```

##### See more:
> **/root/vendor/mallgroup/mpapi-client/Example/DeliveriesExample.php**
> **/root/vendor/mallgroup/mpapi-client/Example/DeliveriesBatch.php**