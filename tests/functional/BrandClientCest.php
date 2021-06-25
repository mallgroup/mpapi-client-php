<?php declare(strict_types=1);

namespace MpApiClient\Tests\functional;

use MpApiClient\Brand\BrandClient;
use MpApiClient\Brand\Entity\Brand;
use MpApiClient\Brand\Entity\BrandIterator;
use MpApiClient\Exception\MpApiException;
use MpApiClient\Tests\_support\FunctionalTester;

final class BrandClientCest
{

    private BrandClient $client;

    public function _before(FunctionalTester $I): void
    {
        // get new client before every test
        $this->client = new BrandClient($I->getGuzzleClient(), 'brand-client-cest');
    }

    /**
     * @throws MpApiException
     */
    public function testList(FunctionalTester $I): void
    {
        $brands = $this->client->list();

        $I->assertInstanceOf(BrandIterator::class, $brands);

        foreach ($brands as $brand) {
            $I->assertInstanceOf(Brand::class, $brand);

            $I->assertIsString($brand->getBrandId());
            $I->assertIsString($brand->getTitle());
        }
    }

}
