## VARIANTS

```
<?php 
...
use MPAPI\Services\Client;
use MPAPI\Services\Variants;
use MPAPI\Entity\Products\Product;
use MPAPI\Entity\Products\Variant;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
...
``` 

```
// Initialize entity
$variant = new Variant($mpapiClient);
$variant->setId('newVariantId');
$variant->setTitle('Title of your variant');
...

// your product and variant IDs
$productId = 'your_product_id';
$variantId = 'your_variant_id';
``` 
 
#### Available methods: 
**GET**  
You can either get list of all variants for relevant product ID or send request with both product ID and variant ID to receive the variant detail: 
```
...
// Get variant detail
$variantEntity = $variants->get($productId, $variantId);

// Get list of product variants
$response = $variants->get($productId);
```
 
**POST**  
Use post method to create new variant.
```
$createStatus = $variants->post($productId, $variant);
```
For a large number of products you can use asynchronous request processing (also for PUT method)
```
$requestHash = $variants->asynchronous()->post($productId, $variant);

// check status of request processing
$processingStatus = $variants->getAsynchronouseStatus($requestHash);
```
 
**PUT**  
Use put method to update variant.
```
$variant->setTitle('Variant title new');
...
$updateStatus = $variants->put($productId, $variant);
```

**DELETE**  
Use delete method to delete variant:
```
$deleteStatus = $variants->delete($productId, $variantId);
```

List of attributes:

__id*__ (string, max. 20 chars) - id of variant,  
__article_id__ (number) - MALL id of variant,  
__title*__ (string, max. 200 chars) - title of variant,  
__shortdesc*__ (string, max. 2000 chars) - short description of the variant,  
__longdesc*__ (string, max. 13000 chars) - long description of the variant; it can contain simple formatting like \<strong\>bold text\</strong\>),  
__priority*__ (number, max. 10 chars) - priority to sort products' variants on the list - the higher number the higher priority,  
__barcode__ (string, 13 chars) - EAN code of variant,  
__price__ (number, max. 11 chars) - price,  
__purchase_price__ (number, max. 11 chars) - purchase price (price without margin),  
__rrp__ (number, max. 11 chars) - recommended retail price,  
__parameters__ (array) - an array of parameters; each parameter can contain one or more values, it is required to send values as an array of values, e.g. ['COLOR' => ['red'], 'SIZE' => ['S', 'M', 'L']],  
__media*__ (array) - variant media; supported types are: JPEG, GIF, PNG, the format of pictures can be either 4:3 (max. width 2000px) or 3:4 (max. height 2000px), max. size 1.5 MB; the picture will be updated only when the URL is different from the previous version - use some parameter, e.g. timestamp, in the URL to update your pictures; parameters:  
 - __url*__ (string, max. 200 chars) - the media URL is validated – the picture must be available from this URL when the variant is sent via API,  
 - __main*__ (boolean) - identifies the main picture; just one image has to be set main,  
 - __switch__ (string) default null - identifies the media used as a variant switch - put one of the variable parameters  

__promotions__ (array) - promotions data of variant. Promotion is highlighted on the product list/detail of product.  parameters:  
 - __price*__ (number) - promotion price,  
 - __from*__ (string, Y-m-d H:i:s) - date and time of promotion start,  
 - __to*__ (string, Y-m-d H:i:s) - date and time of promotion end,  

__labels__ (array) - labels data of the variant; labels are used for sorting products, each product can have assigned any number of valid labels; there are some standard labels - if you want to use special labels, they have to be created in cooperation with MALL: 
 - __label*__ (string, max. 32 chars) - code of the label,  
 - __from*__ (string, Y-m-d H:i:s) - date and time to start label's validity,  
 - __to*__ (string, Y-m-d H:i:s) - date and time to finish label's validity (Y-m-d H:i:s),  

__dimensions__ (array) - dimensions of the variant; structure:  
 - __weight__ (number, 3 decimal points float format) - weight in kg,  
 - __width__ (number, 1 decimal point float format) - width in cm,  
 - __height__ (number, 1 decimal point float format) - width in cm,  
 - __length__ (number, 1 decimal point float format) - length in cm  

__availability*__ (array) - availability of the variant. Structure:  
 - __status*__ (string) - status of variant availability  
 - __in_stock*__ (number) - amount of items available in stock (max. 9999)  

__recommended__ (array) - ids of recommended products or variants; max. limit of recommended products/variants is 30,  
__delivery_delay__ (number) - number of days the delivery will be delayed for the variant; value 0 means the item can be delivered the same day; if the value is the same for all variants, it is enough to use the attribute only in the product data structure.  
__free_delivery__ (boolean) - activate / deactivate free delivery for the whole purchase (package)

*Those attributes marked with * are required.* 

See more:
> **/root/vendor/mallgroup/mpapi-client/Example/VariantsExample.php**  
