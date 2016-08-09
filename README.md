# Mall marketplace API Client

## Description 
MPAPI client is a tool created to help Internet Mall partners to easily connect to marketplace catalogue and order processing at Mall environment such as Mall.cz or Mall.sk. 
## Get MPAPI client 
We recommend to use [Composer](https://getcomposer.org/doc/00-intro.md "see https://getcomposer.org/doc/00-intro.md , if you have it not installed yet"). Once you have composer installed,  you can execute the following command in your project root to get the mpapi-client library:  
`composer require mallgroup/mpapi-client `

To check successful installation go to the vendor folder. You should see the mallgroup folder there.  
Be sure you include the autoloader: 
 
`require_once '/path/to/your-project/vendor/autoload.php';`
 
## Implementation 
To connect  your shop by MPAPI client is made as easy as possible, however we expect some basic knowledge of PHP5.  
You will need to connect to all the services located in /vendor/mallgroup/mpapi/src/Services as shown in example files in /vendor/mallgroup/mpapi/Example. The services provide functions to receive data from Mall environment as well as send, update or delete data. 
### Your client ID 
We use two different environments in Mall: testing and production. You will get two different client IDs for each environment so that you can test work with data without a risk of bad transactions at production. 
You will need the client Id as a parameter  for MPAPI client:  
`$mpapiClient = new Client('yourTestClientId');` 
### Logger 
MPAPI client has implemented a logger interface with a simple [PSR logger](https://packagist.org/packages/psr/log "https://packagist.org/packages/psr/log")  for errors and all important events. It is up to you, if you decide to implement any ready-to-use logging library e.g. [monolog] (https://packagist.org/packages/monolog/monolog "https://packagist.org/packages/monolog/monolog") as shown in the example bellow or you will implement your own logging.  
`$logger = new Logger('yourLoggerName');  
$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO)); 
$mpapiClient->setLogger($logger);`
 
See more in /path/to/your-project/vendor/mallgroup/mpapi-client/Example/LoggerExample.php. 
 
#### Basic Example of Implementation 
 
```
<?php 
use Monolog\Logger; 
use Monolog\Handler\StreamHandler;
use MPAPI\Services\Client;
use MPAPI\Services\NameOfService; // replace this with relevant service name
 
// include your composer dependencies 
require __DIR__ . '/../vendor/autoload.php'; 
 
$mpapiClient = new Client('yourTestClientId'); 
 
$logger = new Logger('yourLoggerName'); 
$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO)); 
 
// set logger into MP API client 
$mpapiClient->setLogger($logger); 

// create instance of the required service
$exampleService = new NameOfService($mpapiClient); 
...
```
For more examples how to use specific services see following links:  
* [Products](../blob/master/docs/PRODUCTS) – create, update, delete or get data.  
* [Availability](../blob/master/docs/AVAILABILITY) – update product or variant.  
* [Orders](../blob/master/docs/ORDERS) - get information about specific order, get all order IDs of open or unconfirmed orders, change order status.  
* [Deliveries](../blob/master/docs/DELIVERIES) - get, create or update delivery setup list.  
* [Labels](../blob/master/docs/LABELS) - get list of available labels.  
* [Categories](../blob/master/docs/CATEGORIES) - get all categories, search title with phrase or prefix, get available parameters for specific category.
    
