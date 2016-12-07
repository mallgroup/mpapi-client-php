## PRODUCT SUPPLY DELAY
```
<?php 
...
use MPAPI\Services\Products;
...

$products = new Products($mpapiClient);
$productId = 'yourProductCode';

$validFrom = new DateTime();
// "valid to" is optional parameter
$validTo = new DateTime();
$validTo->modify('+10 day');
...
``` 

### Available methods:
**GET**  
This method shows detail data about product supply delay.
```
...
$delayDetail = $products->supplyDelay($productId)->get();
...
``` 
The response contains array of product supply delay:
```
[
    "valid_from" => "2016-12-5 00:00:00",
    "valid_to" => "2018-12-10 12:00:00"
]
```

**POST**  
Use post method to create new product supply delay.
```
...
$delayCreatedBothDate = $products->supplyDelay($productId)->post($validTo, $validFrom);
...
``` 

**PUT**  
Use put method to update existing product supply delay.
```
...
$delayUpdated = $products->supplyDelay($productId)->put($updatedValidTo, $validFrom);
...
``` 

**DELETE**  
Use delete method to delete existing product supply delay.
```
...
$deleteDelay = $products->supplyDelay($productId)->delete();
...
``` 


##### See more:
> **/root/vendor/mallgroup/mpapi-client/Example/ProductSupplyDelayExample.php**