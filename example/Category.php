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
// Get category list
//

try {
    $categoryList = $client->category()->list();

    // Print all categories as json object
    echo json_encode($categoryList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get all categories as array
    // [
    //   [
    //     'categoryId': 'EA001',
    //     'title': 'Kuchynské batérie'
    //   ],
    //   ...
    // ]
    var_dump($categoryList->jsonSerialize());

    // Iterate over the returned list
    foreach ($categoryList as $category) {
        echo 'Category id: ' . $category->getCategoryId() . PHP_EOL;
        echo 'Title: ' . $category->getTitle() . PHP_EOL;
        echo PHP_EOL;
    }
} catch (MpApiException $e) {
    echo 'Unexpected error occurred while loading category list: ' . $e->getMessage();
}

//
// Get category parameters
//

try {
    $categoryParams = $client->category()->getParameters('EA001');

    // Print all parameters as json object
    echo json_encode($categoryParams, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get all parameters as array
    var_dump($categoryParams->jsonSerialize());

    // Iterate over the returned list
    foreach ($categoryParams as $param) {
        echo 'Param id: ' . $param->getParamId() . PHP_EOL;
        echo 'Title: ' . $param->getTitle() . PHP_EOL;
        echo 'Unit: ' . $param->getUnit() . PHP_EOL;
        echo 'Value count: ' . $param->getValues()->count() . PHP_EOL;
        echo PHP_EOL;
    }
} catch (MpApiException $e) {
    echo 'Unexpected error occurred while loading category parameters: ' . $e->getMessage();
}

//
// Get category tree
//

try {
    $categoryTree = $client->category()->tree(ShopIdEnum::CZ10MA());

    // Print entire tree as json object
    echo json_encode($categoryTree, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get entire tree as array
    var_dump($categoryTree->jsonSerialize());

    // Iterating over entire tree requires recursion (not shown here)
    foreach ($categoryTree as $treeItem) {
        echo 'Title: ' . $treeItem->getTitle() . PHP_EOL;
        echo 'Visible: ' . (int) $treeItem->isCategoryVisible() . PHP_EOL;
        echo 'Items count: ' . $treeItem->getItems()->count() . PHP_EOL;
        echo 'Menu items count: ' . $treeItem->getItems()->count() . PHP_EOL;
        echo PHP_EOL;
    }
} catch (MpApiException $e) {
    echo 'Unexpected error occurred while loading category tree: ' . $e->getMessage();
}
