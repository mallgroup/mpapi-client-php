## DELIVERIES


#### Available methods:
**GET**  
This method loads all created delivery methods and setups
```
<?php 
...
use MPAPI\Services\DeliveryMethods;

...
// create instance of delivery methods service
$deliveryMethods = new DeliveryMethods($mpapiClient); 
// Get all delivery methods
$response = $deliveryMethods->get();
... 
```

The response contains array of available labels:
```
[
    "delivery_methods": [
      [
        "id": "testDelivery1",
        "title": "Test delivery - 1",
        "price": 90,
        "cod_price": 21,
        "free_limit": 1000,
        "delivery_delay": 3,
        "is_pickup_point": false
      ],
      [
        "id": "testDelivery2",
        "title": "Test delivery - 2",
        "price": 120,
        "cod_price": 21,
        "free_limit": 0,
        "delivery_delay": 0,
        "is_pickup_point": false
      ]
      ...
    ],
    "delivery_setups": [
      [
        "id": "testDelivery1",
        "pricing": [
         [
            "id": "testDelivery1",
            "price": 90,
            "cod_price": 21,
            "free_limit": 1000,
            "delivery_delay": 3
         ],
         [
            "id": "testDelivery2",
            "price": 110,
            "cod_price": 10,
            "free_limit": 1200,
            "delivery_delay": 4
         ]
         ...
        ]
      ]
      ...
    ]
]
```

**PUT**  
Method for create or update delivery methods and setups.  
For creating or updating delivery methods and setups it is have to create entity for delivery method and setups.
```
// Create delivery method entity
$deliveryMethod1 = new MPAPI\Entity\DeliveryMethod();
$deliveryMethod1->setId('partnerDeliveryId')
				->setTitle('Delivery method title') // it will show on mall website
				->setPrice('100') // delivery price
				->setCodPrice('30') // cash on delivery surcharge
				->setFreeLimit('1000') // limit for allowing free delivery (0 for disable free delivery)
				->setDeliveryDelay(3) // delivery delay (in days)
				->setAsPickupPoint(true); // marking delivery method as pickup point

// Create delivery setups entity
$deliverySetup = new DeliverySetup();
$deliverySetup->setId('deliverySetupId')
			  ->setPrice(0)
			  ->setCodPrice(0)
			  ->setFreeLimit(2000)
			  ->setDeliveryDelay(4);

// insert delivery setup into delivery method
$deliveryMethod1->addSetup($deliverySetup);
				
$deliveryMethod2 = new MPAPI\Entity\DeliveryMethod();
$deliveryMethod2->setId('partnerDeliveryId2')
				->setTitle('Delivery method 2 title') // it will show on mall website
				->setPrice('60') // delivery price
				->setCodPrice('15') // cash on delivery surcharge
				->setFreeLimit('1500') // limit for allowing free delivery (0 for disable free delivery)
				->setDeliveryDelay(2) // delivery delay (in days)
				->setAsPickupPoint(false); // marking delivery method as pickup point 

// Create or update delivery methods or settings
$response = $deliveryMethods->add($deliveryMethod1)
							->add($deliveryMethod2)
							->put();
... 
```


##### Example
> **/root/vendor/mallgroup/mpapi-client/Example/DeliveriesExample.php**