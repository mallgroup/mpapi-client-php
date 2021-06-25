<?php declare(strict_types=1);

namespace MpApiClient\Tests\functional;

use MpApiClient\Exception\MpApiException;
use MpApiClient\Label\Entity\Label;
use MpApiClient\Label\Entity\LabelIterator;
use MpApiClient\Label\LabelClient;
use MpApiClient\Tests\_support\FunctionalTester;

final class LabelClientCest
{

    private LabelClient $client;

    public function _before(FunctionalTester $I): void
    {
        // get new client before every test
        $this->client = new LabelClient($I->getGuzzleClient(), 'labels-client-cest');
    }

    /**
     * @throws MpApiException
     */
    public function testList(FunctionalTester $I): void
    {
        $labels = $this->client->list();

        $I->assertInstanceOf(LabelIterator::class, $labels);

        foreach ($labels as $label) {
            $I->assertInstanceOf(Label::class, $label);

            $I->assertIsString($label->getId());
            $I->assertIsString($label->getTitle());
        }
    }

}
