<?php declare(strict_types=1);

namespace MpApiClient\Tests\functional;

use DateTime;
use DateTimeInterface;
use MpApiClient\Exception\MpApiException;
use MpApiClient\Exception\NotFoundException;
use MpApiClient\SupplyDelay\Entity\SupplyDelay;
use MpApiClient\SupplyDelay\SupplyDelayClient;
use MpApiClient\Tests\_support\FunctionalTester;

final class SupplyDelayClientCest
{

    private SupplyDelayClient $client;

    public function _before(FunctionalTester $I): void
    {
        // get new client before every test
        $this->client = new SupplyDelayClient($I->getGuzzleClient(), 'supply-delay-client-cest');
    }

    public function testGetNotFound(FunctionalTester $I): void
    {
        $I->expectThrowable(NotFoundException::class, fn() => $this->client->get());
    }

    /**
     * @depends testGetNotFound
     * @throws MpApiException
     */
    public function testUpsert(FunctionalTester $I): void
    {
        $supplyDelay        = new SupplyDelay(
            (new DateTime('now'))->setTime(0, 0), // remove microseconds, because API does not use them and comparison would fail
            (new DateTime('now + 1 month'))->setTime(0, 0),
        );
        $supplyDelayFromApi = $this->client->upsert($supplyDelay);
        $this->assertSupplyDelayClasses($I, $supplyDelayFromApi);

        $I->assertEquals($supplyDelay->getValidTo(), $supplyDelayFromApi->getValidTo());
        $I->assertEquals($supplyDelay->getValidFrom(), $supplyDelayFromApi->getValidFrom());
    }

    /**
     * @depends testUpsert
     * @throws MpApiException
     */
    public function testGet(FunctionalTester $I): void
    {
        $supplyDelay = $this->client->get();
        $this->assertSupplyDelayClasses($I, $supplyDelay);
    }

    /**
     * @depends testGet
     * @throws MpApiException
     */
    public function testDelete(FunctionalTester $I): void
    {
        $this->client->delete();

        $I->expectThrowable(NotFoundException::class, fn() => $this->client->get());
    }

    public function _testGetForProduct(): void
    {
        // TODO: implement me
    }

    public function _testUpsertForProduct(): void
    {
        // TODO: implement me
    }

    public function _testDeleteForProduct(): void
    {
        // TODO: implement me
    }

    public function _testGetForVariant(): void
    {
        // TODO: implement me
    }

    public function _testUpsertForVariant(): void
    {
        // TODO: implement me
    }

    public function _testDeleteForVariant(): void
    {
        // TODO: implement me
    }

    /*
     * Assertion helpers
     */

    private function assertSupplyDelayClasses(FunctionalTester $I, SupplyDelay $supplyDelay): void
    {
        $I->assertInstanceOf(SupplyDelay::class, $supplyDelay);
        $I->assertInstanceOf(DateTimeInterface::class, $supplyDelay->getValidFrom());
        $I->assertInstanceOf(DateTimeInterface::class, $supplyDelay->getValidTo());
    }

}
