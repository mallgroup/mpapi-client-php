<?php declare(strict_types=1);

namespace MpApiClient\Common\Interfaces;

use Exception;
use MpApiClient\Exception\MpApiException;
use MpApiClient\SupplyDelay\Entity\SupplyDelay;

interface SupplyDelayClientInterface
{

    /**
     * @throws MpApiException
     * @throws Exception
     */
    public function get(): SupplyDelay;

    /**
     * @throws MpApiException
     * @throws Exception
     */
    public function upsert(SupplyDelay $supplyDelay): SupplyDelay;

    /**
     * @throws MpApiException
     */
    public function delete(): void;

    /**
     * @throws MpApiException
     * @throws Exception
     */
    public function getForProduct(string $productId): SupplyDelay;

    /**
     * @throws MpApiException
     * @throws Exception
     */
    public function upsertForProduct(string $productId, SupplyDelay $supplyDelay): SupplyDelay;

    /**
     * @throws MpApiException
     */
    public function deleteForProduct(string $productId): void;

    /**
     * @throws MpApiException
     * @throws Exception
     */
    public function getForVariant(string $productId, string $variantId): SupplyDelay;

    /**
     * @throws MpApiException
     * @throws Exception
     */
    public function upsertForVariant(string $productId, string $variantId, SupplyDelay $supplyDelay): SupplyDelay;

    /**
     * @throws MpApiException
     */
    public function deleteForVariant(string $productId, string $variantId): void;

}
