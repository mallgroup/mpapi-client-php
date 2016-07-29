##PRODUCTS
```
<?php 
...
use MPAPI\Services\Products;
use MPAPI\Entity\Product; 
use MPAPI\Entity\Variant; 
...
``` 
 
####Available methods: 
**GET**  
You can send request either with product ID as a parameter and get product detail or without any parameter and receive all your products list: 
```
...
$products = new Products($mpapiClient); 
// Get all products 
$response = $products->get(); 
 
// Get product detail 
$response = $products->get('123abc'); 
```
 
**DELETE**  
You can delete just one product at a time or more products together:
```
...
// delete one product
$products = new Products($mpapiClient); 
$response = $products->delete('123abc'); 

...
// delete more products 
$productsSynchronizer = new Products($mpapiClient); 
$productSynchronizer->add(new Product(['id' => '123abc'])) 
					->add(new Product(['id' => '456def'])) 
					->delete();
```
 
**POST**  
Use post method to create new products.
```
...
// create one product
$product = new Product();
$product->setId('pTU00_test')
		->setTitle('Testing product title')
		->setShortdesc('Some short description')
		...

$productsService = new Products($mpapiClient); 
$response = $productsService->post($product); 
```

```
// create more products
$product1 = new Product();
$product1->setId('pTU00_test')
		 ->setTitle('Testing product title')
		 ->setShortdesc('Some short description')
		...

$product2 = new Product();
$product2->setId('pTU00_test2')
		->setTitle('Testing product title 2')
		->setShortdesc('Short description')
		...

$productSynchronizer->add($product1) 
					->add($product2) 
					...
					->post();
```
 
**PUT**  
To update products, send put request for one or more products: 
```
...
// to update one product
$product = new Product();
$product->setId('pTU00_test')
		->setTitle('Testing product title')
		->setShortdesc('Some short description')
		...

$productsService = new Products($mpapiClient); 
$response = $productsService->put('pTU00_test', $product); 
```

```
// update more products
$product1 = new Product();
$product1->setId('pTU00_test')
	->setTitle('Testing product title')
	->setShortdesc('Some short description')
	...

$product2 = new Product();
$product2->setId('pTU00_test2')
	->setTitle('Testing product title 2')
	->setShortdesc('Short description')
	...

$productSynchronizer->add($product1) 
					->add($product2) 
					...
					->post();
```

See more:
> **/root/vendor/mallgroup/mpapi-client/Example/ProductsExample.php**  
> **/root/vendor/mallgroup/mpapi-client/Example/ProductBatchPostExample.php**.