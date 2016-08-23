<?php
use MPAPI\Services\Client;
use MPAPI\Services\Products;
use MPAPI\Entity\Product;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require __DIR__ . '/../vendor/autoload.php';

$mpApiClient = new Client('mp_mpapi_test_SAqqD_dGVzdHw0MDAw');

/**
 * Create instance of monolog logger
 */
$logger = new Logger('loggerName');
$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));

// set logger into MP API client
$mpApiClient->setLogger($logger);

// initialize product synchronization
$productSynchronizer = new Products($mpApiClient);

// create entity for the first product
$product1 = new Product();
$product1->setId('pTU00_test')
	->setTitle('Testing product title')
	->setShortdesc('
		Cu sea diceret quaestio, ad vocibus dignissim posidonium cum, ei sed convenire laboramus.
		Labore fabellas te has. Est ex veri dicant contentiones, eum ad moderatius sadipscing. Duo ex veritus conceptam definiebas.
	')
	->setLongdesc('
		Lorem ipsum dolor sit amet, ex tale atqui commune mel. Ad oratio utinam fastidii quo, idque copiosae nam ea, sed doctus omittam petentium cu.
		Et nec graecis percipit, in elitr viderer definiebas nec. Eu fuisset suavitate consectetuer eam, ne sit fuisset constituto consequuntur.
		Ea accusam dissentiunt eam, has ea nullam aliquam, cum zril lobortis constituam ad. Te idque choro aperiam cum.
		Eam at utamur admodum vituperata, cum an nobis facilisi. Ut mei gloriatur percipitur, essent malorum assueverit vim ad.
		Unum urbanitas no ius. Nam mentitum appetere an, qui dissentias voluptatibus id.
		Ius amet verterem cu. Paulo ceteros consetetur ne usu.
	')
	->addMedia('https://i.cdn.nrholding.net/16458154', true)
	->setCategoryId('MP002PL')
	->setPriority(1)
	->setBarcode('0000619262110')
	->setPrice(100)
	->setVat(21)
	->setRrpPrice(95)
	->setBrandId('SAMSUNG')
	->addParameter('MP_COLOR', 'blue')
	->addDimensions(30,90,50,35)
	->setStatus(Product::STATUS_ACTIVE)
	->setInstock(10);

// create entity for the second product
$product2 = new Product();
$product2->setId('pTU00_test2')
	->setTitle('Testing product title 2')
	->setShortdesc('
		Cu sea diceret quaestio, ad vocibus dignissim posidonium cum, ei sed convenire laboramus.
		Labore fabellas te has. Est ex veri dicant contentiones, eum ad moderatius sadipscing. Duo ex veritus conceptam definiebas.
	')
	->setLongdesc('
		Lorem ipsum dolor sit amet, ex tale atqui commune mel. Ad oratio utinam fastidii quo, idque copiosae nam ea, sed doctus omittam petentium cu.
		Et nec graecis percipit, in elitr viderer definiebas nec. Eu fuisset suavitate consectetuer eam, ne sit fuisset constituto consequuntur.
		Ea accusam dissentiunt eam, has ea nullam aliquam, cum zril lobortis constituam ad. Te idque choro aperiam cum.
		Eam at utamur admodum vituperata, cum an nobis facilisi. Ut mei gloriatur percipitur, essent malorum assueverit vim ad.
		Unum urbanitas no ius. Nam mentitum appetere an, qui dissentias voluptatibus id.
		Ius amet verterem cu. Paulo ceteros consetetur ne usu.
	')
	->addMedia('https://i.cdn.nrholding.net/16458154', true)
	->setCategoryId('MP002PL')
	->setPriority(1)
	->setBarcode('0000619262110')
	->setPrice(100)
	->setVat(21)
	->setRrpPrice(95)
	->setBrandId('LG')
	->addParameter('MP_COLOR', 'red')
	->setWeight(30)
	->setStatus(Product::STATUS_ACTIVE)
	->setInstock(15);

/**
 * During synchronization (POST, PUT, DELETE)
 * queues are cleared
 */

// add products into batch queue and send them
$productSynchronizer->add($product1)
	->add($product2)
	->post();

// add products into batch queue and delete them
$productSynchronizer->add($product1)
	->add($product2)
	->delete();
