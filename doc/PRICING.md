## PRICING
```
<?php 
...
use MPAPI\Services\Products;
use MPAPI\Entity\Products\Product; 
use MPAPI\Entity\Pricing;
...
```

#### Available methods:
**PUT**  
You can update pricing either for product or for variant of the product:
```
// initialize products synchronizer
$products = new Products($mpapiClient);

$pricing = new Pricing(100, 115, 130);

// update product pricing into MP API
$products->put('productId', $pricing);

// update variant pricing into MP API
$products->put('productId', $pricing, 'variantId');
```


See more:
> **/root/vendor/mallgroup/mpapi-client/Example/PricingExample.php**  
