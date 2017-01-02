## PRODUCTS

```
<?php 
...
use MPAPI\Services\Products;
use MPAPI\Entity\Product; 
use MPAPI\Entity\Variant; 
...
``` 
 
#### Available methods: 
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

List of attributes:

__id*__ (string, max. 50 chars) - id of product,  
__category_id*__ (string , max. 10 chars) - category id,  
__brand_id__ (string , max. 20 chars) - brand id, strongly recommended to use; iIf you use brand id, the final title is composed of brand id + title,  
__title*__ (string, max. 200 chars) - title of product,  
__shortdesc*__ (string, max. 2000 chars) - short description of the product,  
__longdesc*__ (string, max. 13000 chars) - long description of the product; it can contain simple formatting like \<strong\>bold text\</strong\>),  
__priority*__ (number, max. 10 chars) - priority to sort products (or products' variants) on the list - the higher number the higher priority,  
__barcode*__ (string, 13 chars) - EAN code of the product/variant; if the product has variants, use this attribute only in the variant data structure,  
__price*__ (number, max. 11 chars) - promotion price,  
__vat*__ (number, max. 13 chars) - VAT rate in percentage,  
__rrp__ (number, max. 11 chars) - recommended retail price; if the product has variants, use this attribute only in the variant data structure,  
__parameters__ (array) - an array of parameters; these parameters extend variant parameters if they are defined; each parameter can contain one or more values, it is required to send values as an array of values, e.g. ['COLOR' => ['red'], 'SIZE' => ['S', 'M', 'L']],  
__media*__ (array) - product media; supported types are: JPEG, GIF, PNG, the format of pictures can be either 4:3 (max. width 2000px) or 3:4 (max. height 2000px), max. size 1.5 MB; the picture will be updated only when the URL is different from the previous version - use some parameter, e.g. timestamp, in the URL to update your pictures; if the product has variants, use this attribute only in the variant data structure: url* (string, max. 200 chars) - the media URL is validated – the picture must be available from this URL when the product is sent via API, main* (boolean) - identifies the main product picture visible on the product list; just one image has to be set main,  
__promotions__ (array) - promotions data of product/variant. Promotion is highlighted on the product list/detail of product (if the product has variants, use this attribute only in the variant data structure). price* (number) - promotion price, from* (string, Y-m-d H:i:s) - date and time of promotion start, to* (string, Y-m-d H:i:s) - date and time of promotion end,  
__labels__ (array) - labels data of product/variant; labels are used for sorting products, each product can have assigned any number of valid labels; there are some standard labels - if you want to use special labels, they have to be created in cooperation with MALL: label* (string, max. 32 chars) - code of the label, from* (string, Y-m-d H:i:s) - date and time to start label's validity, to* (string, Y-m-d H:i:s) - date and time to finish label's validity (Y-m-d H:i:s),  
__variants__ (array) - if the product has variants, array of variants is used with the same structure as product,  
__variable_parameters__ (array) - variable parameters of variants (e.g. ['MP_COLOR', 'MP_SIZE']), required only if the product has variants,  
__dimensions__ (array) - dimensions of the product or variant; if the product has variants, use this attribute only in the variant data structure: weight (number, 3 decimal points float format) - weight in kg, width (number, 1 decimal point float format) - width in cm, height (number, 1 decimal point float format) - width in cm, Length (number, 1 decimal point float format) - width in cm,  
__availability*__ (array) - availability of the product/variant (if the product has variants, use this attribute only in the variant data structure): status* (string) - status of product availability, in_stock* (number) - amount of items available in stock (max. 9999),  
__recommended__ (array) - ids of recommended products; if the product has variants, use this attribute only in the variant data structure); max. limit of recommended products / variants is 30,  
__delivery_delay__ (number) - number of days the delivery will be delayed for the product or variant; value 0 means the item can be delivered the same day; if the product has variants and they have different value, use this attribute in the variant data structure; if the value is the same for all variants, it is enough to use the attribute only in the product data structure.  

*Those attributes marked with * are required.* 

See more:
> **/root/vendor/mallgroup/mpapi-client/Example/ProductsExample.php**  
> **/root/vendor/mallgroup/mpapi-client/Example/ProductBatchPostExample.php**.
