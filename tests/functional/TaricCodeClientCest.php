<?php declare(strict_types=1);

namespace MpApiClient\Tests\functional;

use MpApiClient\Exception\MpApiException;
use MpApiClient\TaricCode\Entity\TaricCode;
use MpApiClient\TaricCode\Entity\TaricCodeIterator;
use MpApiClient\TaricCode\TaricCodeClient;
use MpApiClient\Tests\_support\FunctionalTester;

final class TaricCodeClientCest
{

    private TaricCodeClient $client;

    public function _before(FunctionalTester $I): void
    {
        $this->client = new TaricCodeClient($I->getGuzzleClient(), 'taric-codes-client-cest');
    }

    /**
     * @throws MpApiException
     */
    public function testList(FunctionalTester $I): void
    {
        $taricCodes = $this->client->list();

        $I->assertInstanceOf(TaricCodeIterator::class, $taricCodes);

        foreach ($taricCodes as $taricCode) {
            $I->assertInstanceOf(TaricCode::class, $taricCode);

            $I->assertIsString($taricCode->getId());
        }
    }

}
