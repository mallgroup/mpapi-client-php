<?php declare(strict_types=1);

use MpApiClient\Common\Authenticators\ClientIdAuthenticator;
use MpApiClient\Exception\MpApiException;
use MpApiClient\Filter\Filter;
use MpApiClient\Filter\FilterItem;
use MpApiClient\Filter\FilterOperatorEnum;
use MpApiClient\MpApiClient;
use MpApiClient\MpApiClientOptions;
use MpApiClient\Order\DTO\ShippingLabelRequest;
use MpApiClient\Order\DTO\StatusRequest;
use MpApiClient\Order\Entity\StatusEnum;
use MpApiClient\Order\Entity\Tracking;

require '../vendor/autoload.php';

$options = new MpApiClientOptions(
    new ClientIdAuthenticator('my-client-id')
);
$client  = MpApiClient::createFromOptions('my-app-name', $options);

//
// Get order list
//

try {
    // Create a filter where:
    // - `status` field is equal to `open`
    // - `id` field is between 100 and 10000 (inclusive)
    // - results are sorted by `id` field in descending direction
    $filter = new Filter();
    $filter->addFilterItem(FilterItem::create('status', StatusEnum::OPEN()->getValue(), FilterOperatorEnum::EQUAL()));
    $filter->addFilterItem(FilterItem::createInterval('cod', '100', '10000'));
    $filter->addSortColumn('id', Filter::DIRECTION_DESC);

    // list orders with custom filter (filter is optional)
    $orderList = $client->orders()->list($filter);

    // enable autoload, to iterate over all results, not only first page
    $orderList->enableAutoload();

    // Print all orders as json object
    echo json_encode($orderList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get all orders as array
    var_dump($orderList->jsonSerialize());

    // Iterate over the returned list
    foreach ($orderList as $order) {
        echo 'Id: ' . $order->getId() . PHP_EOL;
        echo 'Purchase id: ' . $order->getPurchaseId() . PHP_EOL;
        echo 'Customer id: ' . $order->getCustomerId() . PHP_EOL;
        echo 'Customer: ' . $order->getCustomer() . PHP_EOL;
        echo 'Status: ' . $order->getStatus()->getValue() . PHP_EOL;
        echo 'Tracking number: ' . $order->getTrackingNumber() . PHP_EOL;
        echo 'Tracking url: ' . $order->getTrackingUrl() . PHP_EOL;
        echo 'Payment type: ' . $order->getPaymentType() . PHP_EOL;
        echo 'COD: ' . $order->getCod() . PHP_EOL;
        echo 'MDP: ' . $order->isMdp() ? 'true' : 'false' . PHP_EOL;
        echo PHP_EOL;
    }
} catch (MpApiException | Exception $e) {
    echo 'Unexpected error occurred while loading order list: ' . $e->getMessage();
}

//
// Get order detail
//

try {
    $orderDetail = $client->orders()->get(1234567890);

    // Print order as json object
    echo json_encode($orderDetail, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get order as array
    var_dump($orderDetail->jsonSerialize());

    // Print some order data
    echo 'Customer id: ' . $orderDetail->getCustomer()->getCustomerId() . PHP_EOL;
    echo 'Customer Name: ' . $orderDetail->getCustomer()->getName() . PHP_EOL;
    echo 'Payment type: ' . $orderDetail->getPaymentType() . PHP_EOL;
    echo 'Tracking url: ' . $orderDetail->getTrackingUrl() . PHP_EOL;
    echo 'Currency: ' . $orderDetail->getCurrency() . PHP_EOL;
    echo 'COD: ' . $orderDetail->getCod() . PHP_EOL;
    echo 'Status: ' . $orderDetail->getStatus()->getValue() . PHP_EOL;
    echo PHP_EOL;
} catch (MpApiException | Exception $e) {
    echo 'Unexpected error occurred while loading order detail: ' . $e->getMessage();
}

//
// Get order statistics
//

try {
    $orderStats = $client->orders()->stats(10);

    // Print order statistics as json object
    echo json_encode($orderStats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get order statistics as array
    var_dump($orderStats->jsonSerialize());

    // Print order statistics
    echo 'Blocked: ' . $orderStats->getBlocked() . PHP_EOL;
    echo 'Open: ' . $orderStats->getOpen() . PHP_EOL;
    echo 'Shipping: ' . $orderStats->getShipping() . PHP_EOL;
    echo 'Shipped: ' . $orderStats->getShipped() . PHP_EOL;
    echo 'Cancelled: ' . $orderStats->getCancelled() . PHP_EOL;
    echo 'Delivered: ' . $orderStats->getDelivered() . PHP_EOL;
    echo 'Lost: ' . $orderStats->getLost() . PHP_EOL;
    echo 'Returned: ' . $orderStats->getReturned() . PHP_EOL;
    echo PHP_EOL;
} catch (MpApiException $e) {
    echo 'Unexpected error occurred while loading order statistics: ' . $e->getMessage();
}

//
// Confirm order
// - unconfirmed orders can not have their status changed
//

try {
    $client->orders()->confirmOrder(1234567890);
} catch (MpApiException $e) {
    echo 'Unexpected error occurred during order confirmation: ' . $e->getMessage();
}

//
// Change order status
//

try {
    $statusRequest = new StatusRequest(StatusEnum::shipping());
    $statusRequest->setConfirmed(true); // order may be confirmed at the same time the status is being changed
    $statusRequest->setTracking('ABC123456', 'https://tracking.company.com/id/ABC123456');
    $client->orders()->setStatus(1234567890, $statusRequest);
} catch (MpApiException $e) {
    echo 'Unexpected error occurred during order status change: ' . $e->getMessage();
}

//
// Set tracking for shipped order
// - should be set in one request during status update, not additionally!
//

try {
    $tracking = new Tracking('ABC123456', 'https://tracking.company.com/id/ABC123456');
    $client->orders()->setTracking(1234567890, $tracking);
} catch (MpApiException $e) {
    echo 'Unexpected error occurred during order status change: ' . $e->getMessage();
}

//
// Set serial numbers for order item
//

try {
    $client->orders()->setItemSerialNumbers(1234567890, 1234567, 'SN12345', 'SN23456');
} catch (MpApiException $e) {
    echo 'Unexpected error occurred while setting order item serial numbers: ' . $e->getMessage();
}

//
// Create shipping labels for order
//

try {
    $labelRequest = new ShippingLabelRequest(ShippingLabelRequest::TYPE_PDF, 1, 4);
    $labelRequest->addLabel(123456666, 2);
    $labelRequest->addLabel(10083920202, 1);
    $labels = $client->orders()->createShippingLabels($labelRequest);

    // Print labels as json object
    echo json_encode($labels, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get labels as array
    var_dump($labels->jsonSerialize());

    // Iterate order list and show parcel barcodes for every order
    foreach ($labels->getOrders() as $labelsOrder) {
        echo 'Order id: ' . $labelsOrder->getOrderId() . PHP_EOL;
        echo 'Barcodes: ' . implode(', ', $labelsOrder->getBarcodes()) . PHP_EOL;
        echo PHP_EOL;
    }

    // Print raw base64 encoded PDF or ZPL document
    echo $labels->getLabelsRaw();
} catch (MpApiException $e) {
    echo 'Unexpected error occurred during order labels creation: ' . $e->getMessage();
}
