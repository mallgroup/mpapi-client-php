## DISTRICTS


#### Available method:
```
<?php 
...
use MPAPI\Services\Deliveries;
... 

// create an instance of deliveries service  
$deliveries = new Deliveries($mpapiClient);  
```

**GET**  
```
// get list of districts
$districtCodes = $deliveries->districts()->get();
```

##### See more:
> **/root/vendor/mallgroup/mpapi-client/Example/PartnerPickupPointExample.php**