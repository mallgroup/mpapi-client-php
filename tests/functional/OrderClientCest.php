<?php declare(strict_types=1);

namespace MpApiClient\Tests\functional;

use Codeception\Util\Fixtures;
use DateTimeInterface;
use MpApiClient\Exception\MpApiException;
use MpApiClient\Exception\NotFoundException;
use MpApiClient\Filter\Filter;
use MpApiClient\Order\Entity\BasicOrderList;
use MpApiClient\Order\Entity\Branches;
use MpApiClient\Order\Entity\Customer;
use MpApiClient\Order\Entity\ItemIterator;
use MpApiClient\Order\Entity\Order;
use MpApiClient\Order\Entity\StatusEnum;
use MpApiClient\Order\OrderClient;
use MpApiClient\Tests\_support\FunctionalTester;
use MpApiClient\Tests\_support\Helper\Functional;

final class OrderClientCest
{

    private OrderClient $client;

    public function _before(FunctionalTester $I): void
    {
        // get new client before every test
        $this->client = new OrderClient($I->getGuzzleClient(), 'order-client-cest');
    }

    /**
     * @throws MpApiException
     */
    public function testStats(FunctionalTester $I): void
    {
        $stats = $this->client->stats();

        $I->assertIsInt($stats->getBlocked());
        $I->assertIsInt($stats->getOpen());
        $I->assertIsInt($stats->getShipping());
        $I->assertIsInt($stats->getShipped());
        $I->assertIsInt($stats->getCancelled());
        $I->assertIsInt($stats->getDelivered());
        $I->assertIsInt($stats->getLost());
    }

    /**
     * @throws MpApiException
     */
    public function testList(FunctionalTester $I): void
    {
        $orders = $this->client->list(null);

        $I->assertInstanceOf(BasicOrderList::class, $orders);
        $I->assertPaging($orders, new Filter());

        foreach ($orders as $order) {
            $I->assertIsInt($order->getId());
            $I->assertIsInt($order->getPurchaseId());
            $I->assertIsInt($order->getCustomerId());
            $I->assertIsString($order->getCustomer());
            $I->assertIsFloat($order->getCod());
            $I->assertIsString($order->getPaymentType());
            if ($order->getShipDate() !== null) {
                $I->assertInstanceOf(DateTimeInterface::class, $order->getShipDate());
            }
            if ($order->getTrackingNumber() !== null) {
                $I->assertIsString($order->getTrackingNumber());
            }
            if ($order->getTrackingUrl() !== null) {
                $I->assertIsString($order->getTrackingUrl());
            }
            if ($order->getDeliveredAt() !== null) {
                $I->assertInstanceOf(DateTimeInterface::class, $order->getDeliveredAt());
            }
            $I->assertInstanceOf(StatusEnum::class, $order->getStatus());
            $I->assertIsBool($order->isConfirmed());
            $I->assertIsBool($order->isTest());
            $I->assertIsBool($order->isMdp());
            $I->assertIsBool($order->isMdpClassic());
            $I->assertIsBool($order->isMdpSpectrum());
        }
    }

    public function testGetNotFound(FunctionalTester $I): void
    {
        $I->expectThrowable(NotFoundException::class, fn() => $this->client->get(Functional::getRandomInt()));
    }

    /**
     * @throws MpApiException
     */
    public function testGet(FunctionalTester $I): void
    {
        // Expected order to be returned, with all data types set correctly
        $orderArr = Fixtures::get('order');

        $order = $this->client->get(Fixtures::get('orderId'));
        $this->assertOrderClasses($I, $order);

        $I->assertEquals($orderArr['id'], $order->getId());
        $I->assertEquals($orderArr['purchase_id'], $order->getPurchaseId());
        $I->assertEquals($orderArr['currency'], $order->getCurrency());
        $I->assertEquals($orderArr['delivery_price'], $order->getDeliveryPrice());
        $I->assertEquals($orderArr['cod_price'], $order->getCodPrice());
        $I->assertEquals($orderArr['cod'], $order->getCod());
        $I->assertEquals($orderArr['discount'], $order->getDiscount());
        $I->assertEquals($orderArr['payment_type'], $order->getPaymentType());
        $I->assertEquals($orderArr['delivery_method'], $order->getDeliveryMethod());
        $I->assertEquals($orderArr['delivery_method_id'], $order->getDeliveryMethodId());
        $I->assertEquals($orderArr['branch_id'] ?? null, $order->getBranchId());

        $I->assertEquals($orderArr['branches']['overridden'], $order->getBranches()->isOverridden());
        $I->assertEquals($orderArr['branches']['branch_id'] ?? null, $order->getBranches()->getBranchId());
        $I->assertEquals($orderArr['branches']['branch_change_time'] ?? null, $order->getBranches()->getLastChange());
        $I->assertEquals($orderArr['branches']['secondary_branch_id'] ?? null, $order->getBranches()->getSecondaryBranchId());

        $I->assertEquals($orderArr['tracking_number'] ?? null, $order->getTrackingNumber());
        $I->assertEquals($orderArr['tracking_url'] ?? null, $order->getTrackingUrl());

        $I->assertEquals($orderArr['ship_date'] ?? null, $order->getShipDate());
        $I->assertEquals($orderArr['delivery_date'] ?? null, $order->getDeliveryDate());
        $I->assertEquals($orderArr['delivered_at'] ?? null, $order->getDeliveredAt());
        $I->assertEquals($orderArr['first_delivery_attempt'] ?? null, $order->getFirstDeliveryAttempt());

        $I->assertEquals($orderArr['address']['customer_id'], $order->getCustomer()->getCustomerId());
        $I->assertEquals($orderArr['address']['name'], $order->getCustomer()->getName());
        $I->assertEquals($orderArr['address']['company'] ?? null, $order->getCustomer()->getCompany());
        $I->assertEquals($orderArr['address']['phone'], $order->getCustomer()->getPhone());
        $I->assertEquals($orderArr['address']['email'], $order->getCustomer()->getEmail());
        $I->assertEquals($orderArr['address']['street'], $order->getCustomer()->getStreet());
        $I->assertEquals($orderArr['address']['city'], $order->getCustomer()->getCity());
        $I->assertEquals($orderArr['address']['zip'], $order->getCustomer()->getZip());
        $I->assertEquals($orderArr['address']['country'], $order->getCustomer()->getCountry());

        $I->assertEquals($orderArr['confirmed'], $order->isConfirmed());
        $I->assertEquals($orderArr['status'], $order->getStatus());

        $I->assertEquals($orderArr['items'][0]['id'], $order->getItems()->current()->getId());
        $I->assertEquals($orderArr['items'][0]['article_id'], $order->getItems()->current()->getArticleId());
        $I->assertEquals($orderArr['items'][0]['quantity'], $order->getItems()->current()->getQuantity());
        $I->assertEquals($orderArr['items'][0]['price'], $order->getItems()->current()->getPrice());
        $I->assertEquals($orderArr['items'][0]['vat'], $order->getItems()->current()->getVat());
        $I->assertEquals($orderArr['items'][0]['commission'] ?? null, $order->getItems()->current()->getCommission());
        $I->assertEquals($orderArr['items'][0]['title'], $order->getItems()->current()->getTitle());
        $I->assertEquals($orderArr['items'][0]['serial_numbers'], $order->getItems()->current()->getSerialNumbers());

        $I->assertEquals($orderArr['test'], $order->isTest());
        $I->assertEquals($orderArr['mdp'], $order->isMdp());
        $I->assertEquals($orderArr['mdp_classic'], $order->isMdpClassic());
        $I->assertEquals($orderArr['mdp_spectrum'], $order->isMdpSpectrum());
        $I->assertEquals($orderArr['ready_to_return'], $order->isReadyToReturn());
        $I->assertEquals($orderArr['shipped'] ?? null, $order->getShipped());
        $I->assertEquals($orderArr['open'] ?? null, $order->getOpen());
        $I->assertEquals($orderArr['blocked'] ?? null, $order->getBlocked());
        $I->assertEquals($orderArr['lost'] ?? null, $order->getLost());
        $I->assertEquals($orderArr['returned'] ?? null, $order->getReturned());
        $I->assertEquals($orderArr['cancelled'] ?? null, $order->getCancelled());
        $I->assertEquals($orderArr['delivered'] ?? null, $order->getDelivered());
        $I->assertEquals($orderArr['shipping'] ?? null, $order->getShipping());
        $I->assertEquals(0, $order->getUlozenkaStatusHistory()->count());
        $I->assertEquals($orderArr['ulozenka_status_history'], $order->getUlozenkaStatusHistory()->jsonSerialize());
    }

    public function _testConfirmOrder(): void
    {
        // TODO: implement me
    }

    public function _testSetStatus(): void
    {
        // TODO: implement me
    }

    public function _testSetTracking(): void
    {
        // TODO: implement me
    }

    public function _testSetItemSerialNumbers(): void
    {
        // TODO: implement me
    }

    public function _testCreateShippingLabels(): void
    {
        // TODO: implement me
    }

    /*
     * Assertion helpers
     */

    private function assertOrderClasses(FunctionalTester $I, Order $order): void
    {
        $I->assertInstanceOf(Order::class, $order);
        $I->assertInstanceOf(Branches::class, $order->getBranches());
        $I->assertInstanceOf(Customer::class, $order->getCustomer());
        $I->assertInstanceOf(StatusEnum::class, $order->getStatus());
        $I->assertInstanceOf(ItemIterator::class, $order->getItems());
    }

}
