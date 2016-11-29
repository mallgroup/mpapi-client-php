## BRANDS

### Available methods:
**GET**  
This service has only one method, this method provides list of brands.
```
<?php 
...
use MPAPI\Services\Brands;

...

$brands = new Brands($mpapiClient);
...
``` 

#### All BRANDS
Get list of brands.
```
...
$response = $brands->get()->brands();
... 
```

The response contains array of brands:
```
 [
   [
    "brand_id" => "BRAND 1",
    "title" => "Brand 1 - title"
  ],
  [
    "brand_id" => "BRAND 2",
    "title" => "Brand 2 - title"
  ],
  ...
]

```

#### Search in brands
Search brands by term in title:
```
...
$response = $brands->get()->searchBrands('BRAND'); 
... 
```

The response contains an array of found brands:
```
 [
   [
    "brand_id" => "BRAND 1",
    "title" => "Brand 1 - title"
  ],
  [
    "brand_id" => "BRAND 2",
    "title" => "Brand 2 - title"
  ],
  ...
]

```

##### See more:
> **/root/vendor/mallgroup/mpapi-client/Example/BrandsExample.php**