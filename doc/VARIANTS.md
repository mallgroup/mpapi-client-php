## VARIANTS

```
<?php 
...
use MPAPI\Services\Client;
use MPAPI\Services\Variants;
use MPAPI\Entity\Product;
use MPAPI\Entity\Variant;
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

__id*__ (string, max. 50 chars) - id of variant,  
__title*__ (string, max. 200 chars) - title of variant,  
__shortdesc*__ (string, max. 2000 chars) - short description of the variant,  
__longdesc*__ (string, max. 5000 chars) - long description of the variant; it can contain simple formatting like \<strong\>bold text\</strong\>),  
__priority*__ (number, max. 10 chars) - priority to sort products' variants on the list - the higher number the higher priority,  
__barcode__ (string, 13 chars) - EAN code of variant,  
__price*__ (number, max. 11 chars) - promotion price,   
__rrp__ (number, max. 11 chars) - recommended retail price,  
__parameters__ (array) - an array of parameters; each parameter can contain one or more values, for more values it is required to send values as an array of values, e.g. ['COLOR' => 'red', 'SIZE' => ['S', 'M', 'L']],  
__media*__ (array) - product media; supported types are: JPEG, GIF, PNG, the format of pictures can be either 4:3 (max. width 2000px) or 3:4 (max. height 2000px), max. size 1.5 MB; the picture will be updated only when the URL is different from the previous version - use some parameter, e.g. timestamp, in the URL to update your pictures; url* (string, max. 200 chars) - the media URL is validated – the picture must be available from this URL when the variant is sent via API, main* (boolean) - identifies the main product picture visible on the product list; just one image has to be set main,  
__promotions__ (array) - promotions data of variant. Promotion is highlighted on the product list/detail of product. price* (number) - promotion price, from* (string, Y-m-d H:i:s) - date and time of promotion start, to* (string, Y-m-d H:i:s) - date and time of promotion end,  
__labels__ (array) - labels data of the variant; labels are used for sorting products, each product can have assigned any number of valid labels; there are some standard labels - if you want to use special labels, they have to be created in cooperation with MALL: label* (string, max. 32 chars) - code of the label, from* (string, Y-m-d H:i:s) - date and time to start label's validity, to* (string, Y-m-d H:i:s) - date and time to finish label's validity (Y-m-d H:i:s),      
__dimensions__ (array) - dimensions of the variant; structure: weight (number, 3 decimal points float format) - weight in kg, width (number, 1 decimal point float format) - width in cm, height (number, 1 decimal point float format) - width in cm, Length (number, 1 decimal point float format) - width in cm,  
__availability*__ (array) - availability of variant. Structure: id* (string) - id of the variant, status* (string) - status of variant availability, in_stock* (number) - amount of items available in stock (max. 9999),  
__recommended__ (array) - ids of recommended products; max. limit of recommended products / variants is 30,  
__delivery_delay__ (number) - number of days the delivery will be delayed for the variant; delivery delay can be extend with [supply delay](https://github.com/mallgroup/mpapi-client-php/blob/master/doc/VARIANT_SUPPLY_DELAY.md); value 0 means the item can be delivered the same day; if the value is the same for all variants, it is enough to use the attribute only in the product data structure.  

*Those attributes marked with * are required.* 

See more:
> **/root/vendor/mallgroup/mpapi-client/Example/VariantsExample.php**  