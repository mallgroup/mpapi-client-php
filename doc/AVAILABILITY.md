## AVAILABILITY
```
<?php 
...
use MPAPI\Services\Products;
use MPAPI\Entity\Products\Product; 
use MPAPI\Entity\Availability;
...
```

#### Available methods: 
**PUT**  
You can update availability either for product or for variant of the product:
```
// initialize products synchronizer
$products = new Products($mpapiClient);
...
```

The availability entity has two constants for the status: STATUS_ACTIVE or STATUS_INACTIVE.
You will use them as a second parameter as in following example:
```
...
// create availability entity with 10 items in stock as the first parameter
$availability = new Availability(10, Availability::STATUS_ACTIVE);

// update product availability into MP API
$products->put('productId', $availability);

// update variant availability into MP API
$products->put('productId', $availability, 'variantId');

``` 

See more: [AvailabilityExample.php](../Example/AvailabilityExample.php)  
