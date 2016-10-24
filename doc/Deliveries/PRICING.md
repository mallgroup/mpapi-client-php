## PRICING
```
<?php
...
use MPAPI\Services\Deliveries;
use MPAPI\Entity\Deliveries\PricingLevels;
...
...
// initialize deliveries
$deliveries = new Deliveries($mpapiClient);
```

#### Available methods:
**GET**  
You can get information about pricing levels on the delivery:
```
...
// get delivery pricings
$pricings = $deliveries->pricing()->get('yourDeliveryCode');
```

The response contains pricing levels on the delivery:  
```
[
	[
	    "delivery_code" => 'yourDeliveryCode',
	    "partner_id" => 3000,
	    "type" => 'p',
	    "price" => 120,
	    "cod_price" => 40,
	    "limit" => 1000
    ], [
    	"delivery_code" => 'yourDeliveryCode',
	    "partner_id" => 3000,
	    "type" => 'p',
	    "price" => 99,
	    "cod_price" => 29,
	    "limit" => 2000
    ],
    ...
]
```

#### Create or update delivery pricings
**POST**
To update delivery pricing levels, send post request: 
```
...
$pricingLevels = new PricingLevels();
$pricingLevels->addLevel(PricingLevels::TYPE_PRICE, 100, 49, 1000);
$createStatus = $deliveries->pricing()->post('yourDeliveryCode', $pricingLevels);
```

#### Delete delivery pricings
**DELETE**  
You can delete all delivery pricings:
```
...
// delete all delivery pricings
$deleteStatus = $deliveries->pricing()->delete('yourDeliveryCode');
```

##### See more:
> **/root/vendor/mallgroup/mpapi-client/Example/PricingLevelsExample.php**