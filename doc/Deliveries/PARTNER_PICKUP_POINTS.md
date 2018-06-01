## PARTNER PICKUP POINTS


#### Available methods:
```
<?php 
...
use MPAPI\Entity\PackageSize;
use MPAPI\Entity\PickupPoint;
use MPAPI\Services\Deliveries;
... 

// create an instance of deliveries service  
$deliveries = new Deliveries($mpapiClient);  

// delivery code of already defined delivery method
$deliveryCode = 'new_delivery2';

// create an instance of pickup point entity
$pickupPointEntity = new PickupPoint(); 
```

**POST**  
This method creates partner's pickup point.

```
$pickupPointEntity->setTitle('First pickup point')
	              ->setCode('fpp')
	              ->setDistrictCode('PR')
	              ->setPackageSize(PackageSize::BIGBOX)
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
__street*__ (string, max. 100 chars) - street and number,  
__zip*__ (string, max. 10 chars) - ZIP code,  
__email*__ (string, max. 200 chars) - email,  
__phone*__ (string, max. 15 chars) - phone number,  
__height*__ (number, max. 8 lenght, max. 3 decimals) - max. height of acceptable package,  
__width*__ (number, max. 8 lenght, max. 3 decimals) - max. width of acceptable package,  
__length*__ (number, max. 8 lenght, max. 3 decimals) - max. length of acceptable package,  
__weight*__ (number, max. 8 lenght, max. 3 decimals) - max. weight of acceptable package,  
__latitude*__ (number) - latitude,  
__longitude*__ (number) - longitude,  
__note__ (string, max. 500 chars) - additional information,  
__priority__ (number, max. 3 lenght) - priority of pickup point,  
__opening_hours*__ (array) - opening hours,  
__payment_methods*__ (array) - available payment methods  
__package_size__ (string) - size limit of the package that a branch can accept - there are just two options smallbox and bigbox  

*Those attributes marked with * are required.* 


##### See more:
> **/root/vendor/mallgroup/mpapi-client/Example/PartnerPickupPointExample.php**