## VARIANT SUPPLY DELAY
```
<?php 
...
use MPAPI\Services\Products;
...

$products = new Products($mpapiClient);
$productId = 'yourProductCode';
$variantId = 'yourVariantCode';

$validFrom = new DateTime();
// "valid to" is optional parameter
$validTo = new DateTime();
$validTo->modify('+10 day');
...
``` 

### Available methods:
**GET**  
This method shows detail data about variant supply delay.
```
...
$delayDetail = $products->supplyDelay($productId, $variantId)->get();
...
``` 
The response contains array of variant supply delay:
```
[
    "valid_from" => "2016-12-5 00:00:00",
    "valid_to" => "2018-12-10 12:00:00"
]
```

**POST**  
Use post method to create new variant supply delay.
```
...
$delayCreatedBothDate = $products->supplyDelay($productId, $variantId)->post($validTo, $validFrom);
...
``` 

**PUT**  
Use put method to update existing variant supply delay.
```
...
$delayUpdated = $products->supplyDelay($productId, $variantId)->put($updatedValidTo, $validFrom);
...
``` 

**DELETE**  
Use delete method to delete existing variant supply delay.
```
...
$deleteDelay = $products->supplyDelay($productId, $variantId)->delete();
...
``` 


##### See more:
> **/root/vendor/mallgroup/mpapi-client/Example/VariantSupplyDelayExample.php**