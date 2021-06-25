<?php declare(strict_types=1);

namespace MpApiClient\SupplyDelay;

use MpApiClient\Common\AbstractMpApiClient;
use MpApiClient\Common\Interfaces\SupplyDelayClientInterface;
use MpApiClient\SupplyDelay\Entity\SupplyDelay;

final class SupplyDelayClient extends AbstractMpApiClient implements SupplyDelayClientInterface
{

    private const PARTNER = '/v1/partners/supply-delay';
    private const PRODUCT = '/v1/products/%s/supply-delay';
    private const VARIANT = '/v1/products/%s/variants/%s/supply-delay';

    public function get(): SupplyDelay
    {
        return SupplyDelay::createFromApi($this->sendJson('GET', self::PARTNER)['data']);
    }

    public function upsert(SupplyDelay $supplyDelay): SupplyDelay
    {
        return SupplyDelay::createFromApi(
            $this->sendJson('POST', self::PARTNER, $supplyDelay->getArrayForApi())['data']
        );
    }

    public function delete(): void
    {
        $this->sendJson('DELETE', self::PARTNER);
    }

    public function getForProduct(string $productId): SupplyDelay
    {
        return SupplyDelay::createFromApi($this->sendJson('GET', sprintf(self::PRODUCT, $productId))['data']);
    }

    public function upsertForProduct(string $productId, SupplyDelay $supplyDelay): SupplyDelay
    {
        return SupplyDelay::createFromApi(
            $this->sendJson('POST', sprintf(self::PRODUCT, $productId), $supplyDelay->getArrayForApi())['data']
        );
    }

    public function deleteForProduct(string $productId): void
    {
        $this->sendJson('DELETE', sprintf(self::PRODUCT, $productId));
    }

    public function getForVariant(string $productId, string $variantId): SupplyDelay
    {
        return SupplyDelay::createFromApi($this->sendJson('GET', sprintf(self::VARIANT, $productId, $variantId))['data']);
    }

    public function upsertForVariant(string $productId, string $variantId, SupplyDelay $supplyDelay): SupplyDelay
    {
        return SupplyDelay::createFromApi(
            $this->sendJson('POST', sprintf(self::VARIANT, $productId, $variantId), $supplyDelay->getArrayForApi())['data']
        );
    }

    public function deleteForVariant(string $productId, string $variantId): void
    {
        $this->sendJson('DELETE', sprintf(self::VARIANT, $productId, $variantId));
    }

}
