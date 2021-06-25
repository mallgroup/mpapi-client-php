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
// Get media errors
//

try {
    $mediaErrors = $client->checks()->getMediaErrors();

    // Print all media errors as json object
    echo json_encode($mediaErrors, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get all media errors as array
    // [
    //   [
    //     'code' => 'MISSING_PACKAGE_DELIVERY',
    //     'attribute' => 'package_size',
    //     'value' => 'smallbox',
    //     'msg' => 'There is no delivery for \'smallbox\' package size.',
    //     'articles' => [
    //       '1047'
    //     ]
    //   ],
    //   ...
    // ]
    var_dump($mediaErrors->jsonSerialize());

    // Iterate over the returned list
    foreach ($mediaErrors as $mediaError) {
        echo 'Code: ' . $mediaError->getCode() . PHP_EOL;
        echo 'Attribute: ' . $mediaError->getAttribute() . PHP_EOL;
        echo 'Value: ' . $mediaError->getValue() . PHP_EOL;
        echo 'Msg: ' . $mediaError->getMsg() . PHP_EOL;
        echo 'Articles: ' . implode(', ', $mediaError->getArticles()) . PHP_EOL;
        echo PHP_EOL;
    }
} catch (MpApiException $e) {
    echo 'Unexpected error occurred while loading media errors: ' . $e->getMessage();
}

//
// Get delivery errors
//

try {
    $deliveryErrors = $client->checks()->getDeliveryErrors();

    // Print all delivery errors as json object
    echo json_encode($deliveryErrors, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get all delivery errors as array
    // [
    //   [
    //     'code' => 'MEDIA_VALIDATION_ERROR',
    //     'attribute' => 'media',
    //     'value' => 'https:\/\/cdn.my-company.cz\/unsupported-image\/large.jpg',
    //     'msg' => 'Unsupported mime type',
    //     'articles' => [
    //       '0234030'
    //     ]
    //   ],
    //   ...
    // ]
    var_dump($deliveryErrors->jsonSerialize());

    // Iterate over the returned list
    foreach ($deliveryErrors as $mediaError) {
        echo 'Code: ' . $mediaError->getCode() . PHP_EOL;
        echo 'Attribute: ' . $mediaError->getAttribute() . PHP_EOL;
        echo 'Value: ' . $mediaError->getValue() . PHP_EOL;
        echo 'Msg: ' . $mediaError->getMsg() . PHP_EOL;
        echo 'Articles: ' . implode(', ', $mediaError->getArticles()) . PHP_EOL;
        echo PHP_EOL;
    }
} catch (MpApiException $e) {
    echo 'Unexpected error occurred while loading delivery errors: ' . $e->getMessage();
}
