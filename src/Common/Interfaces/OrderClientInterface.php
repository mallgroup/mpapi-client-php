<?php declare(strict_types=1);

namespace MpApiClient\Common\Interfaces;

use Exception;
use MpApiClient\Exception\MpApiException;
use MpApiClient\Filter\Filter;
use MpApiClient\Order\DTO\ShippingLabelRequest;
use MpApiClient\Order\DTO\StatusRequest;
use MpApiClient\Order\Entity\BasicOrderList;
use MpApiClient\Order\Entity\Order;
use MpApiClient\Order\Entity\Stats;
use MpApiClient\Order\Entity\Tracking;

interface OrderClientInterface
{

    /**
     * @throws MpApiException
     * @throws Exception
     */
    public function list(?Filter $filter): BasicOrderList;

    /**
     * @throws MpApiException
     * @throws Exception
     */
    public function get(int $orderId): Order;

    /**
     * @throws MpApiException
     */
    public function stats(int $days = 30): Stats;

    /**
     * Mark order as confirmed (acknowledged by partner)
     * @throws MpApiException
     */
    public function confirmOrder(int $orderId): void;

    /**
     * Update status of confirmed order
     * @throws MpApiException
     * @see OrderClient::confirmOrder()
     */
    public function setStatus(int $orderId, StatusRequest $request): void;

    /**
     * Update tracking for non-MDP order in OrderStatusEnum::SHIPPED status
     * @throws MpApiException
     */
    public function setTracking(int $orderId, Tracking $tracking): void;

    /**
     * @param string ...$serialNumbers
     * @throws MpApiException
     */
    public function setItemSerialNumbers(int $orderId, int $itemId, string ...$serialNumbers): void;

    /**
     * @param ShippingLabelRequest $labelRequest
     * @return string base64 encoded raw label content (PDF or ZPL file)
     * @throws MpApiException
     */
    public function createShippingLabels(ShippingLabelRequest $labelRequest): string;

}
