<?php declare(strict_types=1);

namespace MpApiClient\Common\Interfaces;

use Exception;
use MpApiClient\Article\DTO\BatchAvailabilityIterator;
use MpApiClient\Article\DTO\ProductRequest;
use MpApiClient\Article\DTO\VariantRequest;
use MpApiClient\Article\Entity\BasicProductList;
use MpApiClient\Article\Entity\BasicVariantList;
use MpApiClient\Article\Entity\Common\Availability;
use MpApiClient\Article\Entity\Common\Pricing;
use MpApiClient\Article\Entity\Product;
use MpApiClient\Article\Entity\Variant;
use MpApiClient\Exception\MpApiException;
use MpApiClient\Filter\Filter;

interface ArticleClientInterface
{

    /**
     * @throws MpApiException
     */
    public function listProducts(?Filter $filter): BasicProductList;

    /**
     * @throws MpApiException
     * @throws Exception
     */
    public function getProduct(string $productId): Product;

    /**
     * @throws MpApiException
     * @throws Exception
     */
    public function createProduct(ProductRequest $product): Product;

    /**
     * @throws MpApiException
     */
    public function updateProduct(ProductRequest $product): void;

    /**
     * @throws MpApiException
     */
    public function deleteProduct(string $productId): void;

    /**
     * @throws MpApiException
     */
    public function getProductAvailability(string $productId): Availability;

    /**
     * @throws MpApiException
     */
    public function getProductPricing(string $productId): Pricing;

    /**
     * @throws MpApiException
     * @deprecated Will be replaced with batch endpoint, similar to BatchAvailability
     */
    public function updateProductPricing(string $productId, Pricing $pricing): void;

    /**
     * @throws MpApiException
     */
    public function listProductVariants(string $productId, ?Filter $filter): BasicVariantList;

    /**
     * @throws MpApiException
     * @throws Exception
     */
    public function getVariant(string $productId, string $variantId): Variant;

    /**
     * @throws MpApiException
     * @throws Exception
     */
    public function createVariant(string $productId, VariantRequest $variant): Variant;

    /**
     * @throws MpApiException
     */
    public function updateVariant(string $productId, VariantRequest $variant): void;

    /**
     * @throws MpApiException
     */
    public function deleteVariant(string $productId, string $variantId): void;

    /**
     * @throws MpApiException
     */
    public function getVariantAvailability(string $productId, string $variantId): Availability;

    /**
     * @throws MpApiException
     */
    public function getVariantPricing(string $productId, string $variantId): Pricing;

    /**
     * @throws MpApiException
     * @deprecated Will be replaced with batch endpoint, similar to BatchAvailability
     */
    public function updateVariantPricing(string $productId, string $variantId, Pricing $pricing): void;

    /**
     * @throws MpApiException
     */
    public function updateBatchAvailability(BatchAvailabilityIterator $availability): void;

    /**
     * @throws MpApiException
     */
    public function activateAllProducts(): void;

    /**
     * @throws MpApiException
     */
    public function activateSelectedProducts(string ...$productIds): void;

}
