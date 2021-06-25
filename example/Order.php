<?php declare(strict_types=1);

use MpApiClient\Common\Authenticators\ClientIdAuthenticator;
use MpApiClient\Filter\Filter;
use MpApiClient\Filter\FilterItem;
use MpApiClient\Filter\FilterOperatorEnum;
use MpApiClient\MpApiClient;
use MpApiClient\MpApiClientOptions;
use MpApiClient\Order\DTO\StatusRequest;
use MpApiClient\Order\DTO\ShippingLabelRequest;
use MpApiClient\Order\Entity\StatusEnum;

require '../vendor/autoload.php';

$options = new MpApiClientOptions(
    new ClientIdAuthenticator('my-client-id')
);
$client  = MpApiClient::createFromOptions('my-app-name', $options);

// TODO: finish examples

$orderId  = 12345;
$orderId2 = 12346;

// 3. Send query to order list endpoint without any filter
$orderList = $client->orders()->list(null);
echo json_encode($orderList, JSON_PRETTY_PRINT);

// 4. Send query to order list endpoint with filter where
// - `status` field is equal to `open`
// - `id` field is between 100 and 10000 (inclusive)
// - results are sorted by `id` field in descending direction
$filter = new Filter();
$filter->addFilterItem(FilterItem::create("status", StatusEnum::OPEN()->getValue(), FilterOperatorEnum::EQUAL()));
$filter->addFilterItem(FilterItem::createInterval("cod", "100", "10000"));
$filter->addSortColumn('id', Filter::DIRECTION_DESC);

$filteredOrderList = $client->orders()->list($filter);
// $filteredOrderList->enableAutoload(true);
echo json_encode($filteredOrderList, JSON_PRETTY_PRINT);

// 5. Get single order by ID
$orderDetail = $client->orders()->get($orderId);
echo json_encode($orderDetail, JSON_PRETTY_PRINT);

// 6. Get order statistics for past 14 days
$orderStats = $client->orders()->stats(14);
echo json_encode($orderStats, JSON_PRETTY_PRINT);

// 7. Confirm/acknowledge new changes on an order (unconfirmed orders can not have their status changed)
$client->orders()->confirmOrder($orderId);

// 8. Update order status
$statusRequest = new StatusRequest(StatusEnum::shipping());
$statusRequest->setTracking('ABC123456', 'https://tracking.company.com/id/ABC123456');
$client->orders()->setStatus($orderId, $statusRequest);

// 9. Set tracking for shipped order (should be set in one request during status update)
$client->orders()->setItemSerialNumbers($orderId, 1234567, 'SN12345', 'SN23456');

// 10. Get order shipping labels to print on the box for two orders
$labelRequest = new ShippingLabelRequest(ShippingLabelRequest::TYPE_PDF, 1, 4);
$labelRequest->addLabel($orderId, 2);
$labelRequest->addLabel($orderId2, 1);
$labels = $client->orders()->createShippingLabels($labelRequest);
echo $labels;
