<?php declare(strict_types=1);

namespace MpApiClient\Order;

use Closure;
use MpApiClient\Common\AbstractMpApiClient;
use MpApiClient\Common\Interfaces\OrderClientInterface;
use MpApiClient\Filter\Filter;
use MpApiClient\Filter\FilterItem;
use MpApiClient\Filter\FilterOperatorEnum;
use MpApiClient\Order\DTO\ShippingLabelRequest;
use MpApiClient\Order\DTO\StatusRequest;
use MpApiClient\Order\Entity\BasicOrderList;
use MpApiClient\Order\Entity\Labels;
use MpApiClient\Order\Entity\Order;
use MpApiClient\Order\Entity\Stats;
use MpApiClient\Order\Entity\Tracking;

final class OrderClient extends AbstractMpApiClient implements OrderClientInterface
{

    private const LIST   = '/v1/orders';
    private const STATS  = '/v1/orders/stats';
    private const LABELS = '/v1/orders/labels';

    private const DETAIL   = '/v1/orders/%d';
    private const TRACKING = '/v1/orders/%d/tracking';

    private const ITEM_SERIAL_NUMBERS = '/v1/orders/%d/items/%d/serial-numbers';

    public function list(?Filter $filter): BasicOrderList
    {
        $filter ??= new Filter();
        // client supports only list of basic orders (there is no reason to list IDs only from MPAPI)
        $filter->addFilterItem(FilterItem::create('filter', 'basic', FilterOperatorEnum::EMPTY()));

        return BasicOrderList::createWithCallback(
            Closure::fromCallable(
                fn(Filter $filter) => $this->sendQueryRequest(self::LIST, $filter->buildFilterQuery())
            ),
            $filter,
        );
    }

    public function get(int $orderId): Order
    {
        return Order::createFromApi(
            $this->sendJson('GET', sprintf(self::DETAIL, $orderId))['data']
        );
    }

    public function stats(int $days = 30): Stats
    {
        return Stats::createFromApi(
            $this->sendQueryRequest(self::STATS, ['days' => $days])['data']
        );
    }

    public function confirmOrder(int $orderId): void
    {
        $this->sendJson('PUT', sprintf(self::DETAIL, $orderId), ['confirmed' => true]);
    }

    public function setStatus(int $orderId, StatusRequest $request): void
    {
        $this->sendJson('PUT', sprintf(self::DETAIL, $orderId), $request->getArrayForApi());
    }

    public function setTracking(int $orderId, Tracking $tracking): void
    {
        $this->sendJson('PUT', sprintf(self::TRACKING, $orderId), $tracking->getArrayForApi());
    }

    public function setItemSerialNumbers(int $orderId, int $itemId, string ...$serialNumbers): void
    {
        $this->sendJson('PUT', sprintf(self::ITEM_SERIAL_NUMBERS, $orderId, $itemId), $serialNumbers);
    }

    public function createShippingLabels(ShippingLabelRequest $labelRequest): Labels
    {
        return Labels::createFromApi(
            $this->sendJson('POST', self::LABELS, $labelRequest->getArrayForApi())['data']
        );
    }

}
