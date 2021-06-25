<?php declare(strict_types=1);

namespace MpApiClient\Tests\functional;

use MpApiClient\Checks\ChecksClient;
use MpApiClient\Checks\Entity\Error;
use MpApiClient\Checks\Entity\ErrorIterator;
use MpApiClient\Exception\MpApiException;
use MpApiClient\Tests\_support\FunctionalTester;

final class ChecksClientCest
{

    private ChecksClient $client;

    public function _before(FunctionalTester $I): void
    {
        // get new client before every test
        $this->client = new ChecksClient($I->getGuzzleClient(), 'checks-client-cest');
    }

    /**
     * @throws MpApiException
     */
    public function testGetMediaErrors(FunctionalTester $I): void
    {
        $mediaErrors = $this->client->getMediaErrors();

        $I->assertInstanceOf(ErrorIterator::class, $mediaErrors);

        $this->assertCheckErrors($I, $mediaErrors);
    }

    /**
     * @throws MpApiException
     */
    public function testGetDeliveryErrors(FunctionalTester $I): void
    {
        $mediaErrors = $this->client->getDeliveryErrors();

        $I->assertInstanceOf(ErrorIterator::class, $mediaErrors);

        $this->assertCheckErrors($I, $mediaErrors);
    }

    /*
     * Assertion helpers
     */

    private function assertCheckErrors(FunctionalTester $I, ErrorIterator $errors): void
    {
        foreach ($errors as $error) {
            $I->assertInstanceOf(Error::class, $error);

            $I->assertIsString($error->getCode());
            $I->assertIsString($error->getValue());
            $I->assertIsString($error->getMsg());
            $I->assertIsString($error->getAttribute());

            foreach ($error->getArticles() as $article) {
                $I->assertIsString($article);
            }
        }
    }

}
