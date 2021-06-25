<?php declare(strict_types=1);

namespace MpApiClient\Tests\functional;

use MpApiClient\Exception\MpApiException;
use MpApiClient\Shop\Entity\Shop;
use MpApiClient\Shop\Entity\ShopIdEnum;
use MpApiClient\Shop\Entity\ShopIterator;
use MpApiClient\Shop\ShopClient;
use MpApiClient\Tests\_support\FunctionalTester;

final class ShopClientCest
{

    private ShopClient $client;

    public function _before(FunctionalTester $I): void
    {
        // get new client before every test
        $this->client = new ShopClient($I->getGuzzleClient(), 'shop-client-cest');
    }

    /**
     * @throws MpApiException
     */
    public function testList(FunctionalTester $I): void
    {
        $shops = $this->client->list();

        $I->assertInstanceOf(ShopIterator::class, $shops);

        foreach ($shops as $shop) {
            $I->assertInstanceOf(Shop::class, $shop);

            $I->assertInstanceOf(ShopIdEnum::class, $shop->getShopId());
            $I->assertIsString($shop->getCountryId());
            $I->assertIsString($shop->getName());
            $I->assertIsString($shop->getCurrencyIso());
            $I->assertIsString($shop->getCurrencySymbol());
            $I->assertIsString($shop->getUrl());
        }
    }

}
