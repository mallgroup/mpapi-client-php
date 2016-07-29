#Mall marketplace API Client

##Description 
MPAPI client is a tool created to help Internet Mall partners to easily connect to marketplace catalogue and order processing at Mall environment such as Mall.cz or Mall.sk. 
##Get MPAPI client 
We recommend to use [Composer](https://getcomposer.org/doc/00-intro.md "see https://getcomposer.org/doc/00-intro.md , if you have it not installed yet"). Once you have composer installed,  you can execute the following command in your project root to get the library: 
composer require nrholding/mpapi 
To check successful installation go to the vendor folder. You should see the nrholding folder there.  
Be sure you include the autoloader: 
 
`require_once '/path/to/your-project/vendor/autoload.php';`
 
##Implementation 
To connect  your shop by MPAPI client is made as easy as possible, however we expect some basic knowledge of PHP5.  
You will need to connect to all the services located in /vendor/nrholding/mpapi/src/Services as shown in example files in /vendor/nrholding/mpapi/Example. The services provide functions to receive data from Mall environment as well as send, update or delete data. 
###Your client ID 
We use two different environments in Mall: test for testing and prod for production. You will get two different client IDs for each environment so that you can test work with data without a risk of bad transactions at production. 
You will need the client Id as a parameter  for MPAPI client:  
`$mpapiClient = new Client('yourTestClientId');` 
###Logger 
MPAPI client has implemented a logger interface with a simple [PSR logger](https://packagist.org/packages/psr/log "https://packagist.org/packages/psr/log")  for errors and all important events. It is up to you, if you decide to implement any advanced logging library (e.g. [monolog] (https://packagist.org/packages/monolog/monolog "https://packagist.org/packages/monolog/monolog") or you will be happy with this basic logging.  
`$logger = new Logger('yourLoggerName');  
$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO)); 
$mpapiClient->setLogger($logger);`
 
See more in /path/to/your-project/Example/LoggerExample.php. 
 
####Basic Example of Implementation 
 
```
<?php 
use MPAPI\Services\Client; 
use MPAPI\Services\NameOfService; 
use Monolog\Logger; 
use Monolog\Handler\StreamHandler; 
 
// include your composer dependencies 
require __DIR__ . '/../vendor/autoload.php'; 
 
$mpapiClient = new Client('yourTestClientId'); 
 
$logger = new Logger('yourLoggerName'); 
$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO)); 
 
// set logger into MP API client 
$mpapiClient->setLogger($logger); 
$exampleService = new NameOfService($mpapiClient); 
...
```
    
##Product 
```
<?php 
use MPAPI\Entity\Product; 
use MPAPI\Entity\Variant; 
... 
$productsServiceExample = new Products($mpapiClient); 
$productEntityExample = new Product(); 
...
``` 
 
####Available methods: 
GET   
You can either send request with product ID as a parameter and get product detail: 
`$response = $products->get('123abc');`
Or without any parameter and receive all your products list: 
`$response = $products->get();`
 
DELETE  
`$response = $products->delete('123abc');`
 
POST  
`$response = $products->post();`
 
PUT (update product data) 
`$response = $products->put('pTU00_test', $productEntityExample);`
 
 
 
 
 
 