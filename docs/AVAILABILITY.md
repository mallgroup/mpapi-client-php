#AVAILABILITY
```
<?php 
...
use MPAPI\Services\Products;
use MPAPI\Entity\Product; 
use MPAPI\Entity\Availability;
...
```

####Available methods: 
**PUT**  
You can update availability either for product or for variant of the product:
```
// initialize products synchronizer
$products = new Products($mpapiClient);
// create availability entity
$availability = new Availability(10, Availability::STATUS_ACTIVE);

// update product availability into MP API
$products->put(29237, $availability);

// update variant availability into MP API
$products->put(29237, $availability, 29239);

``` 

See more:
> **/root/vendor/mallgroup/mpapi-client/Example/AvailabilityExample.php**  
