<?php declare(strict_types=1);

namespace MpApiClient\Tests\functional;

use MpApiClient\Common\Interfaces\ArticleClientInterface;
use MpApiClient\Common\Interfaces\BrandClientInterface;
use MpApiClient\Common\Interfaces\CategoryClientInterface;
use MpApiClient\Common\Interfaces\ChecksClientInterface;
use MpApiClient\Common\Interfaces\FinancialClientInterface;
use MpApiClient\Common\Interfaces\LabelClientInterface;
use MpApiClient\Common\Interfaces\MpApiClientInterface;
use MpApiClient\Common\Interfaces\OrderClientInterface;
use MpApiClient\Common\Interfaces\ShopClientInterface;
use MpApiClient\Common\Interfaces\SupplyDelayClientInterface;
use MpApiClient\MpApiClient;
use MpApiClient\MpApiClientOptions;
use MpApiClient\Tests\_support\FunctionalTester;

final class MpApiClientCest
{

    public function testCreate(FunctionalTester $I): void
    {
        $client = new MpApiClient($I->getGuzzleClient(), 'mpapi-client-cest');
        $this->assertDomainClients($I, $client);
    }

    public function testCreateFromOptions(FunctionalTester $I): void
    {
        $options = new MpApiClientOptions($I->getAuthenticator());
        $client  = MpApiClient::createFromOptions('mpapi-client-cest', $options);
        $this->assertDomainClients($I, $client);
    }

    /*
     * Assertion helpers
     */

    private function assertDomainClients(FunctionalTester $I, MpApiClientInterface $client): void
    {
        $I->assertInstanceOf(ArticleClientInterface::class, $client->article());
        $I->assertInstanceOf(BrandClientInterface::class, $client->brand());
        $I->assertInstanceOf(CategoryClientInterface::class, $client->category());
        $I->assertInstanceOf(FinancialClientInterface::class, $client->financial());
        $I->assertInstanceOf(ChecksClientInterface::class, $client->checks());
        $I->assertInstanceOf(LabelClientInterface::class, $client->label());
        $I->assertInstanceOf(OrderClientInterface::class, $client->orders());
        $I->assertInstanceOf(ShopClientInterface::class, $client->shop());
        $I->assertInstanceOf(SupplyDelayClientInterface::class, $client->supplyDelay());
    }

}
