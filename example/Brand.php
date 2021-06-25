<?php declare(strict_types=1);

use MpApiClient\Common\Authenticators\ClientIdAuthenticator;
use MpApiClient\Exception\MpApiException;
use MpApiClient\MpApiClient;
use MpApiClient\MpApiClientOptions;

require '../vendor/autoload.php';

$options = new MpApiClientOptions(
    new ClientIdAuthenticator('my-client-id')
);
$client  = MpApiClient::createFromOptions('my-app-name', $options);

//
// Get brand list
//

try {
    $brandList = $client->brand()->list();

    // Print all brands as json object
    echo json_encode($brandList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get all brands as array
    // [
    //   [
    //     'brandId' => 'BRAND',
    //     'title' => 'Brand title'
    //   ],
    //   ...
    // ]
    var_dump($brandList->jsonSerialize());

    // Iterate over the returned list
    foreach ($brandList as $brand) {
        echo 'Brand id: ' . $brand->getBrandId() . PHP_EOL;
        echo 'Title: ' . $brand->getTitle() . PHP_EOL;
        echo PHP_EOL;
    }
} catch (MpApiException $e) {
    echo 'Unexpected error occurred while loading brand list: ' . $e->getMessage();
}

