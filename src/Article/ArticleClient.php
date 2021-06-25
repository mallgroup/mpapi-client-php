<?php declare(strict_types=1);

namespace MpApiClient\Article;

use Closure;
use MpApiClient\Article\DTO\BatchAvailabilityIterator;
use MpApiClient\Article\DTO\ProductRequest;
use MpApiClient\Article\DTO\VariantRequest;
use MpApiClient\Article\Entity\BasicProductList;
use MpApiClient\Article\Entity\BasicVariantList;
use MpApiClient\Article\Entity\Common\Availability;
use MpApiClient\Article\Entity\Common\Pricing;
use MpApiClient\Article\Entity\Product;
use MpApiClient\Article\Entity\Variant;
use MpApiClient\Common\AbstractMpApiClient;
use MpApiClient\Common\Interfaces\ArticleClientInterface;
use MpApiClient\Filter\Filter;
use MpApiClient\Filter\FilterItem;
use MpApiClient\Filter\FilterOperatorEnum;

final class ArticleClient extends AbstractMpApiClient implements ArticleClientInterface
{

    private const BATCH_AVAILABILITY      = '/v1/availability';
    private const BATCH_ACTIVATE_ALL      = '/v1/batches/products/activate/all';
    private const BATCH_ACTIVATE_SELECTED = '/v1/batches/products/activate/selected';

    private const PRODUCT_LIST         = '/v1/products';
    private const PRODUCT_DETAIL       = '/v1/products/%s';
    private const PRODUCT_PRICING      = '/v1/products/%s/pricing';
    private const PRODUCT_AVAILABILITY = '/v1/products/%s/availability';

    private const VARIANT_LIST         = '/v1/products/%s/variants';
    private const VARIANT_DETAIL       = '/v1/products/%s/variants/%s';
    private const VARIANT_PRICING      = '/v1/products/%s/variants/%s/pricing';
    private const VARIANT_AVAILABILITY = '/v1/products/%s/variants/%s/availability';

    public function listProducts(?Filter $filter): BasicProductList
    {
        $filter ??= new Filter();
        // client supports only list of basic products
        $filter->addFilterItem(FilterItem::create('filter', 'basic', FilterOperatorEnum::EMPTY()));

        return BasicProductList::createWithCallback(
            Closure::fromCallable(
                fn(Filter $filter): array => $this->sendQueryRequest(self::PRODUCT_LIST, $filter->buildFilterQuery())
            ),
            $filter,
        );
    }

    public function getProduct(string $productId): Product
    {
        return Product::createFromApi(
            $this->sendJson('GET', sprintf(self::PRODUCT_DETAIL, $productId))['data']
        );
    }

    public function createProduct(ProductRequest $product): Product
    {
        return Product::createFromApi(
            $this->sendJson('POST', self::PRODUCT_LIST, $product->getArrayForApi())['data']
        );
    }

    public function updateProduct(ProductRequest $product): void
    {
        $this->sendJson('PUT', sprintf(self::PRODUCT_DETAIL, $product->getId()), $product->getArrayForApi());
    }

    public function deleteProduct(string $productId): void
    {
        $this->sendJson('DELETE', sprintf(self::PRODUCT_DETAIL, $productId));
    }

    public function getProductAvailability(string $productId): Availability
    {
        return Availability::createFromApi(
            $this->sendJson('GET', sprintf(self::PRODUCT_AVAILABILITY, $productId))['data']
        );
    }

    public function getProductPricing(string $productId): Pricing
    {
        return Pricing::createFromApi(
            $this->sendJson('GET', sprintf(self::PRODUCT_PRICING, $productId))['data']
        );
    }

    public function updateProductPricing(string $productId, Pricing $pricing): void
    {
        $this->sendJson('PUT', sprintf(self::PRODUCT_PRICING, $productId), $pricing->getArrayForApi());
    }

    public function listProductVariants(string $productId, ?Filter $filter): BasicVariantList
    {
        $filter ??= new Filter();
        // client supports only list of basic variants
        $filter->addFilterItem(FilterItem::create('filter', 'basic', FilterOperatorEnum::EMPTY()));

        return BasicVariantList::createWithCallback(
            Closure::fromCallable(
                fn(Filter $filter): array => $this->sendQueryRequest(sprintf(self::VARIANT_LIST, $productId), $filter->buildFilterQuery())
            ),
            $filter,
        );
    }

    public function getVariant(string $productId, string $variantId): Variant
    {
        return Variant::createFromApi(
            $this->sendJson('GET', sprintf(self::VARIANT_DETAIL, $productId, $variantId))['data']
        );
    }

    public function createVariant(string $productId, VariantRequest $variant): Variant
    {
        return Variant::createFromApi(
            $this->sendJson('POST', sprintf(self::VARIANT_LIST, $productId), $variant->getArrayForApi())['data']
        );
    }

    public function updateVariant(string $productId, VariantRequest $variant): void
    {
        $this->sendJson('PUT', sprintf(self::VARIANT_DETAIL, $productId, $variant->getId()), $variant->getArrayForApi());
    }

    public function deleteVariant(string $productId, string $variantId): void
    {
        $this->sendJson('DELETE', sprintf(self::VARIANT_DETAIL, $productId, $variantId));
    }

    public function getVariantAvailability(string $productId, string $variantId): Availability
    {
        return Availability::createFromApi(
            $this->sendJson('GET', sprintf(self::VARIANT_AVAILABILITY, $productId, $variantId))['data']
        );
    }

    public function getVariantPricing(string $productId, string $variantId): Pricing
    {
        return Pricing::createFromApi(
            $this->sendJson('GET', sprintf(self::VARIANT_PRICING, $productId, $variantId))['data']
        );
    }

    public function updateVariantPricing(string $productId, string $variantId, Pricing $pricing): void
    {
        $this->sendJson('PUT', sprintf(self::VARIANT_PRICING, $productId, $variantId), $pricing->getArrayForApi());
    }

    public function updateBatchAvailability(BatchAvailabilityIterator $availability): void
    {
        $this->sendJson('POST', self::BATCH_AVAILABILITY, $availability->getArrayForApi());
    }

    public function activateAllProducts(): void
    {
        $this->sendJson('PUT', self::BATCH_ACTIVATE_ALL);
    }

    public function activateSelectedProducts(string ...$productIds): void
    {
        $this->sendJson('PUT', self::BATCH_ACTIVATE_SELECTED, array_map(fn(string $productId): array => ['productId' => $productId], $productIds));
    }

}
