## PARTNER DELIVERIES


#### All partner deliveries:
**GET**  
This method loads all partner deliveries.
```
<?php 
...
use MPAPI\Services\Deliveries;
... 

// create an instance of deliveries service  
$deliveries = new Deliveries($mpapiClient);  

// get partner deliveries  
$response = $deliveries->partner()->get();  
...  
```
The response contains an array of available partner deliveries:  
```
[
	"ids" => [
	    "newDelivery1",
	    "newDelivery2",
	    ...
	]
]
```

#### Detail of selected partner delivery:
**GET**  
This method shows detail data about selected partner delivery method.
```
<?php 
...
use MPAPI\Services\Deliveries;
...
// create an instance of deliveries service  
$deliveries = new Deliveries($mpapiClient);  

$response = $deliveries->partner()->get('PD1');  
```
The response contains an array of detail data:  
```
[
    "code" => "PD1",
    "title" => "Partner delivery 1",
    "delivery_method_id" => "1234",
    "partner_id" => "4000",
    "price" => 90,
    "cod_price" => 21,
    "free_limit" => 1000,
    "delivery_delay" => 2,
    "is_pickup_point" => true,
    "height" => [
      "min" => 0,
      "max" => 50
     ],
    "length" => [
      "min" => 0,
      "max" => 120
     ],
    "width" => [
      "min" => 0,
      "max" => 30
     ],
    "weight" => [
      "min" => 0,
      "max" => 20
     ],
     "priority" => 1
]
```

#### Create new partner delivery
**POST**  
Use post method to create new partner delivery.
```
...
// create one delivery
$delivery = new PartnerDelivery();
$delivery->setCode('newDelivery1');
         ->setTitle('New delivery 1');
         ->setPrice(90);
         ...

$deliveries = new Deliveries($mpapiClient);  
$response = $deliveries->partner()->post($delivery);
```

```
// create more deliveries
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

#### Update partner delivery
**PUT**  
To update deliveries, send put request for one or more deliveries: 
```
...
// to update one delivery
$delivery = new PartnerDelivery();
$delivery->setCode('newUpdatedDelivery1');
         ->setTitle('New updated delivery 1');
         ->setPrice(80);
         ...

$deliveries = new Deliveries($mpapiClient);  
$response = $deliveries->partner()->put($delivery);
```

```
// update more deliveries
$delivery1 = new PartnerDelivery();
$delivery1->setCode('newUpdatedDelivery1');
          ->setTitle('New updated delivery 1');
          ->setPrice(80);
          ...

$delivery2 = new PartnerDelivery();
$delivery2->setCode('newUpdatedDelivery2');
          ->setTitle('New updated delivery 2');
          ->setPrice(0);
          ...

$deliveries->add($delivery1)
           ->add($delivery2)
           ->partner()
           ->put()
```

#### Delete partner deliveries
**DELETE**  
You can delete just one delivery at a time or all deliveries together:
```
...
// delete one delivery
$delivery = new PartnerDelivery();
$delivery->setCode('newUpdatedDelivery1');
         ->setTitle('New updated delivery 1');
         ->setPrice(80);
         ...
$response = $deliveries->partner()->delete($delivery);

...
// delete all deliveries
$response = $deliveries->partner()->delete();
```


##### See more:
> **/root/vendor/mallgroup/mpapi-client/Example/DeliveriesExample.php**
> **/root/vendor/mallgroup/mpapi-client/Example/DeliveriesBatch.php**