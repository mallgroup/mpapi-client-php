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
// Get label list
//

try {
    $labelList = $client->label()->list();

    // Print all labels as json object
    echo json_encode($labelList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get all labels as array
    // [
    //   [
    //     'id' => 'SALE',
    //     'title' => 'Výprodej'
    //   ],
    //   ...
    // ]
    var_dump($labelList->jsonSerialize());

    // Iterate over the returned list
    foreach ($labelList as $label) {
        echo 'Label id: ' . $label->getId() . PHP_EOL;
        echo 'Title: ' . $label->getTitle() . PHP_EOL;
        echo PHP_EOL;
    }
} catch (MpApiException $e) {
    echo 'Unexpected error occurred while loading label list: ' . $e->getMessage();
}

