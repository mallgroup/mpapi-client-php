<?php declare(strict_types=1);

use MpApiClient\Common\Authenticators\ClientIdAuthenticator;
use MpApiClient\Exception\MpApiException;
use MpApiClient\MpApiClient;
use MpApiClient\MpApiClientOptions;
use MpApiClient\Shop\Entity\ShopIdEnum;

require '../vendor/autoload.php';

$options = new MpApiClientOptions(
    new ClientIdAuthenticator('my-client-id')
);
$client  = MpApiClient::createFromOptions('my-app-name', $options);

//
// Get shop list
//

try {
    $shopList = $client->shop()->list();

    // Print all shops as json object
    echo json_encode($shopList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get all shops as array
    // [
    //   [
    //     'shopId' => 'SK10MA',
    //     'countryId' => 'SK',
    //     'name' => 'Mall.sk',
    //     'currencyIso' => 'EUR',
    //     'currencySymbol' => '€',
    //     'url' => 'https:\/\/mpapi.mall.sk'
    //   ],
    //   ...
    // ]
    var_dump($shopList->jsonSerialize());

    // Get one shop from the list using `getByShopId` method
    var_dump($shopList->getByShopId(ShopIdEnum::CZ10MA()));

    // Iterate over the returned list
    foreach ($shopList as $shop) {
        echo 'ShopId: ' . $shop->getShopId()->getValue() . PHP_EOL;
        echo 'CountryId: ' . $shop->getCountryId() . PHP_EOL;
        echo 'Name: ' . $shop->getName() . PHP_EOL;
        echo 'CurrencyIso: ' . $shop->getCurrencyIso() . PHP_EOL;
        echo 'CurrencySymbol: ' . $shop->getCurrencySymbol() . PHP_EOL;
        echo 'Url: ' . $shop->getUrl() . PHP_EOL;
        echo PHP_EOL;
    }
} catch (MpApiException $e) {
    echo 'Unexpected error occurred, while loading shop list: ' . $e->getMessage();
}
