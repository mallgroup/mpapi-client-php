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

// create entity for first product
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
	->setCategoryId('MP000')
	->setPriority(1)
	->setBarcode('0000619262110')
	->setPrice(100)
	->setVat(21)
	->setRrpPrice(95)
	->setBrandId('BRAND_ID')
	->setParameters(['MP_COLOR' => 'blue'])
	->setAvailability(['status' => Product::STATUS_ACTIVE, 'in_stock' => 10]);

// create entity for second product
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
		->setCategoryId('MP000')
		->setPriority(1)
		->setBarcode('0000619262110')
		->setPrice(100)
		->setVat(21)
		->setRrpPrice(95)
		->setBrandId('BRAND_ID')
		->setParameters(['MP_COLOR' => 'red'])
		->setAvailability(['status' => Product::STATUS_ACTIVE, 'in_stock' => 15]);

// add both product into batch queue
$productSynchronizer->add($product1)
	->add($product2);

// Create new products in batch
$productSynchronizer->post();
