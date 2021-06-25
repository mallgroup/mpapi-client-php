<?php declare(strict_types=1);

use MpApiClient\Common\Authenticators\ClientIdAuthenticator;
use MpApiClient\Exception\MpApiException;
use MpApiClient\MpApiClient;
use MpApiClient\MpApiClientOptions;
use MpApiClient\SupplyDelay\Entity\SupplyDelay;

require '../vendor/autoload.php';

$options = new MpApiClientOptions(
    new ClientIdAuthenticator('my-client-id')
);
$client  = MpApiClient::createFromOptions('my-app-name', $options);

//
// Get global supply delay
//

try {
    $supplyDelay = $client->supplyDelay()->get();

    // Print supply delay as json object
    echo json_encode($supplyDelay, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get supply delay as array
    // [
    //   'validFrom' => '2021-01-01 00:00:00',
    //   'validTo' => '2021-02-01 00:00:00',
    // ]
    var_dump($supplyDelay->jsonSerialize());

    // Show formatted supply delay validity dates
    echo 'Valid from: ' . $supplyDelay->getValidFrom()->format(DATE_RFC3339) . PHP_EOL;
    echo 'Valid to: ' . $supplyDelay->getValidTo()->format(DATE_RFC3339) . PHP_EOL;
    echo PHP_EOL;
} catch (MpApiException | Exception $e) {
    echo 'Unexpected error occurred while loading supply delay: ' . $e->getMessage();
}

//
// Create or update global supply delay
//

try {
    // Created supply delay is returned back
    $supplyDelay = $client->supplyDelay()->upsert(
        new SupplyDelay(
            new DateTime('now'),
            new DateTime('now + 1month'),
        )
    );

    // Print supply delay as json object
    echo json_encode($supplyDelay, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get supply delay as array
    // [
    //   'validFrom' => '2021-01-01 00:00:00',
    //   'validTo' => '2021-02-01 00:00:00',
    // ]
    var_dump($supplyDelay->jsonSerialize());

    // Show formatted supply delay validity dates
    echo 'Valid from: ' . $supplyDelay->getValidFrom()->format(DATE_RFC3339) . PHP_EOL;
    echo 'Valid to: ' . $supplyDelay->getValidTo()->format(DATE_RFC3339) . PHP_EOL;
    echo PHP_EOL;
} catch (MpApiException | Exception $e) {
    echo 'Unexpected error occurred while creating/updating supply delay: ' . $e->getMessage();
}

//
// Delete global supply delay
//

try {
    // Method should return nothing if delete was successful
    $client->supplyDelay()->delete();
} catch (MpApiException $e) {
    echo 'Unexpected error occurred while deleting supply delay: ' . $e->getMessage();
}

//
// Get product supply delay
//

try {
    $supplyDelay = $client->supplyDelay()->getForProduct('product-id');

    // Print supply delay as json object
    echo json_encode($supplyDelay, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get supply delay as array
    // [
    //   'validFrom' => '2021-01-01 00:00:00',
    //   'validTo' => '2021-02-01 00:00:00',
    // ]
    var_dump($supplyDelay->jsonSerialize());

    // Show formatted supply delay validity dates
    echo 'Valid from: ' . $supplyDelay->getValidFrom()->format(DATE_RFC3339) . PHP_EOL;
    echo 'Valid to: ' . $supplyDelay->getValidTo()->format(DATE_RFC3339) . PHP_EOL;
    echo PHP_EOL;
} catch (MpApiException | Exception $e) {
    echo 'Unexpected error occurred while loading product supply delay: ' . $e->getMessage();
}

//
// Create or update product supply delay
//

try {
    // Created supply delay is returned back
    $supplyDelay = $client->supplyDelay()->upsertForProduct(
        'product-id',
        new SupplyDelay(
            new DateTime('now'),
            new DateTime('now + 1month'),
        )
    );

    // Print supply delay as json object
    echo json_encode($supplyDelay, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get supply delay as array
    // [
    //   'validFrom' => '2021-01-01 00:00:00',
    //   'validTo' => '2021-02-01 00:00:00',
    // ]
    var_dump($supplyDelay->jsonSerialize());

    // Show formatted supply delay validity dates
    echo 'Valid from: ' . $supplyDelay->getValidFrom()->format(DATE_RFC3339) . PHP_EOL;
    echo 'Valid to: ' . $supplyDelay->getValidTo()->format(DATE_RFC3339) . PHP_EOL;
    echo PHP_EOL;
} catch (MpApiException | Exception $e) {
    echo 'Unexpected error occurred while creating/updating product supply delay: ' . $e->getMessage();
}

//
// Delete product supply delay
//

try {
    // Method should return nothing if delete was successful
    $client->supplyDelay()->deleteForProduct('product-id');
} catch (MpApiException $e) {
    echo 'Unexpected error occurred while deleting product supply delay: ' . $e->getMessage();
}

//
// Get variant supply delay
//

try {
    $supplyDelay = $client->supplyDelay()->getForVariant('product-id', 'variant-id');

    // Print supply delay as json object
    echo json_encode($supplyDelay, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get supply delay as array
    // [
    //   'validFrom' => '2021-01-01 00:00:00',
    //   'validTo' => '2021-02-01 00:00:00',
    // ]
    var_dump($supplyDelay->jsonSerialize());

    // Show formatted supply delay validity dates
    echo 'Valid from: ' . $supplyDelay->getValidFrom()->format(DATE_RFC3339) . PHP_EOL;
    echo 'Valid to: ' . $supplyDelay->getValidTo()->format(DATE_RFC3339) . PHP_EOL;
    echo PHP_EOL;
} catch (MpApiException | Exception $e) {
    echo 'Unexpected error occurred while loading variant supply delay: ' . $e->getMessage();
}

//
// Create or update variant supply delay
//

try {
    // Created supply delay is returned back
    $supplyDelay = $client->supplyDelay()->upsertForVariant(
        'product-id',
        'variant-id',
        new SupplyDelay(
            new DateTime('now'),
            new DateTime('now + 1month'),
        )
    );

    // Print supply delay as json object
    echo json_encode($supplyDelay, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get supply delay as array
    // [
    //   'validFrom' => '2021-01-01 00:00:00',
    //   'validTo' => '2021-02-01 00:00:00',
    // ]
    var_dump($supplyDelay->jsonSerialize());

    // Show formatted supply delay validity dates
    echo 'Valid from: ' . $supplyDelay->getValidFrom()->format(DATE_RFC3339) . PHP_EOL;
    echo 'Valid to: ' . $supplyDelay->getValidTo()->format(DATE_RFC3339) . PHP_EOL;
    echo PHP_EOL;
} catch (MpApiException | Exception $e) {
    echo 'Unexpected error occurred while creating/updating variant supply delay: ' . $e->getMessage();
}

//
// Delete product supply delay
//

try {
    // Method should return nothing if delete was successful
    $client->supplyDelay()->deleteForVariant('product-id', 'variant-id');
} catch (MpApiException $e) {
    echo 'Unexpected error occurred while deleting variant supply delay: ' . $e->getMessage();
}
