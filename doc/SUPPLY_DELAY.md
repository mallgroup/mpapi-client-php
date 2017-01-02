## SUPPLY DELAY
```
<?php 
...
use MPAPI\Services\Products;
...

$products = new Products($mpapiClient);
$productId = 'yourProductId';
// for supply delay on variant
$variantId = 'yourVariantId';

// "valid from" is optional parameter
$validFrom = new DateTime();

$validTo = new DateTime();
$validTo->modify('+10 day');
...
``` 

### Available methods:
**GET**  
The method returns supply delay data.
```
...
// get supply delay for product
$delayProduct = $products->supplyDelay($productId)->get();

// get supply delay for variant
$delayVariant = $products->variants()->supplyDelay($productId, $variantId)->get();
...
``` 
The response contains start and end of the supply delay validity:
```
[
    "valid_from" => "2016-12-5 00:00:00",
    "valid_to" => "2018-12-10 12:00:00"
]
```

**POST**  
Use post method to create new supply delay. The second parameter is optional - current date and time will be used if no value sent.
```
...
// create supply delay for product
$newDelayProduct = $products->supplyDelay($productId)->post($validTo, $validFrom);

// create supply delay for variant
$newDelayVariant = $products->variants()->supplyDelay($productId, $variantId)->post($validTo, $validFrom);
...
``` 

**PUT**  
Use put method to update existing supply delay.
```
...
$updatedValidTo = $validTo->modify('+5 day');

// update supply delay for product
updatedDelayProduct = $products->supplyDelay($productId)->put($updatedValidTo);

// to change also valid from, use the value as a second parameter
updatedDelayProduct2 = $products->supplyDelay($productId)->put($updatedValidTo, $validFrom);

// update supply delay for variant
$updatedDelayVariant = $products->variants()->supplyDelay($productId, $variantId)->put($updatedValidTo);

// change both of the values
$updatedDelayVariant2 = $products->variants()->supplyDelay($productId, $variantId)->put($updatedValidTo, $validFrom);
...
``` 

**DELETE**  
Use delete method to remove supply delay.
```
...
// delete supply delay for product
$deleteDelay = $products->supplyDelay($productId, $variantId)->delete();

// delete supply delay for variant
$deleteDelay = $products->variants()->supplyDelay($productId, $variantId)->delete();
...
``` 


##### See more:
> **/root/vendor/mallgroup/mpapi-client/Example/ProductSupplyDelayExample.php**
> **/root/vendor/mallgroup/mpapi-client/Example/VariantSupplyDelayExample.php**
