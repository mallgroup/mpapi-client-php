## Partner pickup point


#### Available methods:
```
<?php 
...
use MPAPI\Services\Deliveries;
... 

// delivery code of already defined delivery method
$deliveryCode = 'new_delivery2';

// create an instance of pickup point entity
$pickupPointEntity = new PickupPoint(); 
```

**POST**  
This method create partner's pickup point.

```
$pickupPointEntity->setTitle('First pickup point')
	              ->setCode('fpp')
	              ->setDistrictCode('PR')
	              ...
	
// create pickup point  
$createdPickupPoint = $deliveries->partner()->pickupPoints($deliveryCode)->create($pickupPointEntity);
```

**GET**  
```
// get list of partner's pickup points
$pickupPoints = $deliveries->partner()->pickupPoints($deliveryCode)->get();

//  get detail of partner's pickup point
$pickupPoint = $deliveries->partner()->pickupPoints($deliveryCode)->get(current($pickupPoints));
```

**PUT**  
Update partner's pickup point
```
// change pickup point title
$pickupPointEntity->setTitle('Pickup point changed title');

// update pickup point
$updateStatus = $deliveries->partner()->pickupPoints($deliveryCode)->update($pickupPointEntity);
```

**DELETE**  
You can delete partner's pickup point:
```
$deleteStatus = $deliveries->partner()->pickupPoints($deliveryCode)->delete($pickupPointEntity);
```
List of attributes:

__code*__ (string, max. 50 chars) - code of pickup point,  
__district_code*__ (string , max. 4 chars) - district code,  
__title*__ (string, max. 200 chars) - title of pickup point,  
__city*__ (string, max. 100 chars) - city,  
__street*__ (string, max. 100 chars) - street name,  
__zip*__ (string, max. 10 chars) - ZIP code,  
__email*__ (string, max. 200 chars) - email,  
__phone*__ (string, max. 15 chars) - phone,  
__height*__ (number, max. 8 lenght, max. 3 decimals) - height of acceptable package,  
__width*__ (number, max. 8 lenght, max. 3 decimals) - width of acceptable package, 
__length*__ (number, max. 8 lenght, max. 3 decimals) - length of acceptable package,  
__weight*__ (number, max. 8 lenght, max. 3 decimals) - weight of acceptable package,  
__lalitude*__ (number) - lalitude,  
__longitude*__ (number) - longitude,  
__note*__ (string, max. 500 chars) - pickup point note,   
__priority*__ (number, max. 3 lenght) - priority of pickup point,  
__opening_hours*__ (array) - opening hours,  
__payment_methods*__ (array) - Available payment methods,  

*Those attributes marked with * are required.* 


##### See more:
> **/root/vendor/mallgroup/mpapi-client/Example/PartnerPickupPointExample.php**