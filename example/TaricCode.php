<?php declare(strict_types=1);

use MpApiClient\Common\Authenticators\ClientIdAuthenticator;
use MpApiClient\Exception\MpApiException;
use MpApiClient\MpApiClient;
use MpApiClient\MpApiClientOptions;

require '../vendor/autoload.php';

$options = new MpApiClientOptions(
    new ClientIdAuthenticator('my-client-id')
);
$client = MpApiClient::createFromOptions('my-app-name', $options);

//
// Get list of all CN (Combined Nomenclature) codes
//

try {
    $taricCodeList = $client->taricCode()->list();

    // Print all CN codes as json object
    echo json_encode($taricCodeList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get all CN codes as array
    // [
    //   [
    //     'id' => '22030010',
    //   ],
    //   ...
    // ]
    var_dump($taricCodeList->jsonSerialize());

    // Iterate over the returned list
    foreach ($taricCodeList as $taricCode) {
        echo 'CN code id: ' . $taricCode->getId() . PHP_EOL;
        echo PHP_EOL;
    }
} catch (MpApiException $e) {
    echo 'Unexpected error occurred while loading CN code list: ' . $e->getMessage();
}
