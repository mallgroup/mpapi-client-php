## GENERAL DELIVERIES


#### All predefined deliveries:
**GET**  
This method loads all predefined deliveries
```
<?php 
...
use MPAPI\Services\Deliveries;
... 

$deliveries = new Deliveries($mpapiClient); 
// Get all predefined deliveries
$response = $deliveries->general()->get(); 
```

The response contains an array of all predefined deliveries:
```
[
  "ids": [
    "DHL",
    "CP",
    ...
  ]
]
```

#### Detail of one predefined delivery:
**GET**  
This method shown detail data about selected predefined delivery method.
```
<?php 
...
use MPAPI\Services\Deliveries;
... 

$deliveries = new Deliveries($mpapiClient); 
// Get all predefined deliveries
$response = $deliveries->general()->get('DHL'); 
```

The response contains an array of delivery data:
```
[
  "code": "DHL",
  "title": "DHL",
  "description": "test přeprava",
  "tracking_url": "https://www.dhl.cz",
  "price": 99,
  "cod_price": 50,
  "free_limit": 0,
  "delivery_delay": 2,
  "height": {
    "min": 0,
    "max": 30
  },
  "length": {
    "min": 0,
    "max": 90
  },
  "width": {
    "min": 0,
    "max": 100
  },
  "weight": {
    "min": 0,
    "max": 30
  }
]
```

#### Get list of general deliveries selected by partner
**GET**  
This method shown list of selected general deliveries by partner.
```
<?php 
...
use MPAPI\Services\Deliveries;
... 

$deliveries = new Deliveries($mpapiClient); 
// Get list of all activated general deliveries by partner
$response = $deliveries->general()->getActive(); 
```

The response contains an array of delivery data:
```
[
  "ids": [
    "DHL"
  ]
]
```

#### Activate general deliveries
**PUT**  
This method shown how to activate specific general deliveries
```
<?php 
...
use MPAPI\Services\Deliveries;
... 

$deliveries = new Deliveries($mpapiClient);
 
// create entity for first delivery
$generalDelivery1 = new GeneralDelivery();
$generalDelivery1->setCode('DHL');
// create entity for second delivery
$generalDelivery2 = new GeneralDelivery();
$generalDelivery2->setCode('CP');

// send deliveries in batch
$deliveries->add(generalDelivery1)
	->add(generalDelivery2)
	->general()
	->put();
	
// or send one by one
$deliveries->general()->put($generalDelivery1);
$deliveries->general()->put($generalDelivery2);
```

Service returns only true or false depends on result of API request.


#### Deactivate general deliveries
**DELETE**  
This method shown how to deactivate specific general deliveries
```
<?php 
...
use MPAPI\Services\Deliveries;
... 

$deliveries = new Deliveries($mpapiClient);
 
// create delivery entity for deactivation
$generalDelivery = new GeneralDelivery();
$generalDelivery->setCode('DHL');

// or send one by one
$deliveries->general()->delete($generalDelivery);
```

Service returns only true or false depends on result of API request.


#### Deactivate all general deliveries
**delete**  
This method shown how to deactivate all general deliveries activated by partner
```
<?php 
...
use MPAPI\Services\Deliveries;
... 

$deliveries = new Deliveries($mpapiClient);

// deactivate all general deliveries
$deliveries->general()->delete();
```

Service returns only true or false depends on result of API request. 


##### See more:
> **/root/vendor/mallgroup/mpapi-client/Example/DeliveriesExample.php**
> **/root/vendor/mallgroup/mpapi-client/Example/DeliveriesBatch.php**