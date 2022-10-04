<?php declare(strict_types=1);

namespace MpApiClient\Tests\functional;

use Codeception\Util\Fixtures;
use JsonException;
use MpApiClient\Article\ArticleClient;
use MpApiClient\Article\DTO\BatchAvailability;
use MpApiClient\Article\DTO\BatchAvailabilityIterator;
use MpApiClient\Article\DTO\ProductRequest;
use MpApiClient\Article\DTO\VariantRequest;
use MpApiClient\Article\Entity\BasicProduct;
use MpApiClient\Article\Entity\BasicProductList;
use MpApiClient\Article\Entity\BasicVariantList;
use MpApiClient\Article\Entity\Common\Availability;
use MpApiClient\Article\Entity\Common\Pricing;
use MpApiClient\Article\Entity\Common\StatusEnum;
use MpApiClient\Article\Entity\Product;
use MpApiClient\Article\Entity\ProductStageEnum;
use MpApiClient\Article\Entity\Variant;
use MpApiClient\Exception\MpApiException;
use MpApiClient\Exception\NotFoundException;
use MpApiClient\Filter\Filter;
use MpApiClient\Filter\FilterItem;
use MpApiClient\Filter\FilterOperatorEnum;
use MpApiClient\Tests\_support\FunctionalTester;
use MpApiClient\Tests\_support\Helper\Functional;

final class ArticleClientCest
{

    private const PRODUCT_PREFIX         = 'client-test-product-';
    private const VARIANT_PREFIX         = 'client-test-variant-';
    private const VARIANT_PRODUCT_PREFIX = 'client-test-variant-product-';

    private string        $productId;
    private string        $variantId;
    private string        $variantProductId;
    private ArticleClient $client;

    public function _before(FunctionalTester $I): void
    {
        // get new client before every test
        $this->client = new ArticleClient($I->getGuzzleClient(), 'article-client-cest');

        // Basic Create and Delete operations are called on one product/variant with static id
        // - all other methods MUST create their own and SHOULD depend on TestDeleteXxx to ensure their setup and teardown work
        $this->productId        = self::PRODUCT_PREFIX . $I->getStaticRandomString();
        $this->variantId        = self::VARIANT_PREFIX . $I->getStaticRandomString();
        $this->variantProductId = self::VARIANT_PRODUCT_PREFIX . $I->getStaticRandomString();
    }

    /**
     * @throws MpApiException
     */
    public function testListProducts(FunctionalTester $I): void
    {
        // used only for testing to set page size, because product endpoint ignores page_size query param
        $filter = new Filter();
        $filter->setLimit(1000);

        $products = $this->client->listProducts(null);
        $products->disableAutoload();

        $I->assertInstanceOf(BasicProductList::class, $products);
        $I->assertPaging($products, $filter);

        foreach ($products as $product) {
            $this->assertBasicProductTypes($I, $product);
        }
    }

    /**
     * @throws MpApiException
     */
    public function testListProductsFiltered(FunctionalTester $I): void
    {
        $categoryId = 'NA020';

        $filter = new Filter();
        $filter->addFilterItem(FilterItem::create('_category_id', $categoryId, FilterOperatorEnum::EQUAL()));

        $products = $this->client->listProducts($filter);
        $products->enableAutoload();

        $I->assertInstanceOf(BasicProductList::class, $products);
        $I->assertPaging($products, $filter);

        $I->assertGreaterThanOrEqual(1, $products->getPaging()->getTotal());

        foreach ($products as $product) {
            $this->assertBasicProductTypes($I, $product);
            $I->assertEquals($categoryId, $product->getCategoryId());
        }
    }

    /**
     * @throws MpApiException
     */
    public function testCreateProduct(FunctionalTester $I): void
    {
        $product = $this->getNewProductRequest();
        $product->setId($this->productId);
        $product->setPartnerTitle('custom partner title');
        $product->setBrandId('100TEST');

        $productFromApi = $this->client->createProduct($product);
        $this->assertProductValues($I, $product, $productFromApi);
    }

    /**
     * @depends testCreateProduct
     * @throws MpApiException
     */
    public function testDeleteProduct(): void
    {
        $this->client->deleteProduct($this->productId);
    }

    public function testGetProductNotFound(FunctionalTester $I): void
    {
        $I->expectThrowable(NotFoundException::class, fn() => $this->client->getProduct(Functional::getRandomString()));
    }

    /**
     * @depends testDeleteProduct
     * @throws MpApiException
     */
    public function testGetProduct(FunctionalTester $I): void
    {
        // Setup
        $product = $this->getNewProductRequest();
        $this->client->createProduct($product);

        // Execution
        $productFromApi = $this->client->getProduct($product->getId());

        // Assertions
        $this->assertProductValues($I, $product, $productFromApi);

        // Cleanup
        $this->client->deleteProduct($product->getId());
    }

    /**
     * @depends testDeleteProduct
     * @throws MpApiException
     */
    public function testUpdateProduct(FunctionalTester $I): void
    {
        // Setup
        $product = $this->getNewProductRequest();
        $this->client->createProduct($product);

        // Execution
        $product->setPartnerTitle('updated partner title');
        $product->setFreeDelivery(true);
        $product->setDeliveryDelay(5);

        $this->client->updateProduct($product);

        // Assertions
        $productDetail = $this->client->getProduct($product->getId());
        $this->assertProductValues($I, $product, $productDetail);

        // Cleanup
        $this->client->deleteProduct($product->getId());
    }

    /**
     * @depends testDeleteProduct
     * @throws MpApiException
     */
    public function testGetProductAvailability(FunctionalTester $I): void
    {
        // Setup
        $product = $this->getNewProductRequest();
        $this->client->createProduct($product);

        // Execution
        $availability = $this->client->getProductAvailability($product->getId());

        // Assertions
        $I->assertEquals($product->getAvailability(), $availability);

        // Cleanup
        $this->client->deleteProduct($product->getId());
    }

    /**
     * @depends testDeleteProduct
     * @throws MpApiException
     */
    public function testGetProductPricing(FunctionalTester $I): void
    {
        // Setup
        $product = $this->getNewProductRequest();
        $product->setRrp(100);
        // $product->setPurchasePrice(50); // 0 should be returned if not set

        $this->client->createProduct($product);

        // Execution
        $pricingFromApi = $this->client->getProductPricing($product->getId());

        // Assertions
        $I->assertEquals($product->getPrice(), $pricingFromApi->getPrice());
        //$I->assertEquals($product->getRrp(), $pricingFromApi->getRrp()); no longer needed
        $I->assertEquals(0.0, $pricingFromApi->getPurchasePrice());

        // Cleanup
        $this->client->deleteProduct($product->getId());
    }

    /**
     * @depends testDeleteProduct
     * @throws MpApiException
     */
    public function testUpdateProductPricing(FunctionalTester $I): void
    {
        // Setup
        $product = $this->getNewProductRequest();
        $this->client->createProduct($product);

        // Execution
        $pricing = new Pricing(75, 100, 50);
        $this->client->updateProductPricing($product->getId(), $pricing);

        // Assertions
        $pricingFromApi = $this->client->getProductPricing($product->getId());
        $I->assertEquals($pricing->getPrice(), $pricingFromApi->getPrice());
        //$I->assertEquals($pricing->getRrp(), $pricingFromApi->getRrp());  no longer needed
        $I->assertEquals($pricing->getPurchasePrice(), $pricingFromApi->getPurchasePrice());

        // Cleanup
        $this->client->deleteProduct($product->getId());
    }

    /**
     * @depends testCreateProduct
     * @throws MpApiException
     * @throws JsonException
     */
    public function testCreateVariantProduct(FunctionalTester $I): void
    {
        // Setup
        $variant = $this->getNewVariantRequest();
        $variant->setId($this->variantId);

        $product = $this->getNewProductRequest();
        $product->setId($this->variantProductId);
        $product->getVariants()->add($variant);

        // Execution
        $productFromApi = $this->client->createProduct($product);
        $variantFromApi = $productFromApi->getVariants()->current();

        // Assertions
        $this->assertProductValues($I, $product, $productFromApi);
        $this->assertVariantValues($I, $variant, $variantFromApi);
    }

    /**
     * @depends testCreateVariantProduct
     * @throws MpApiException
     * @throws JsonException
     */
    public function testCreateVariant(FunctionalTester $I): void
    {
        $variant = $this->getNewVariantRequest();

        $variantFromApi = $this->client->createVariant($this->variantProductId, $variant);
        $this->assertVariantValues($I, $variant, $variantFromApi);
    }

    /**
     * @depends testCreateVariant
     * @throws MpApiException
     */
    public function testDeleteVariant(): void
    {
        $this->client->deleteVariant($this->variantProductId, $this->variantId);
        $this->client->deleteProduct($this->variantProductId);
    }

    /**
     * @depends testCreateVariantProduct
     * @throws MpApiException
     * @throws JsonException
     */
    public function testListProductVariants(FunctionalTester $I): void
    {
        // Setup
        $variant = $this->getNewVariantRequest();
        $product = $this->getNewProductRequest();
        $product->getVariants()->add($variant);

        $this->client->createProduct($product);

        // Execution
        $variants = $this->client->listProductVariants($product->getId(), null);

        $I->assertInstanceOf(BasicVariantList::class, $variants);
        $I->assertPaging($variants, new Filter());

        foreach ($variants as $variant) {
            $I->assertIsString($variant->getId());
            $I->assertIsInt($variant->getProductId());
            $I->assertIsInt($variant->getVariantId());
            $I->assertIsString($variant->getTitle());
            $I->assertInstanceOf(StatusEnum::class, $variant->getStatus());
            $I->assertIsInt($variant->getInStock());
            $I->assertIsFloat($variant->getPrice());
            $I->assertIsFloat($variant->getPurchasePrice());
            $I->assertIsFloat($variant->getRrp());
        }

        // Cleanup
        $this->client->deleteProduct($product->getId());
    }

    public function testGetVariantNotFound(FunctionalTester $I): void
    {
        $I->expectThrowable(NotFoundException::class, fn() => $this->client->getVariant(Functional::getRandomString(), Functional::getRandomString()));
    }

    /**
     * @depends testDeleteVariant
     * @throws MpApiException
     * @throws JsonException
     */
    public function testGetVariant(FunctionalTester $I): void
    {
        // Setup
        $variant = $this->getNewVariantRequest();
        $product = $this->getNewProductRequest();
        $product->getVariants()->add($variant);

        $this->client->createProduct($product);

        // Execution
        $variantFromApi = $this->client->getVariant($product->getId(), $variant->getId());

        // Assertions
        $this->assertVariantValues($I, $variant, $variantFromApi);

        // Cleanup
        $this->client->deleteProduct($product->getId());
    }

    /**
     * @depends testDeleteVariant
     * @throws MpApiException
     */
    public function testUpdateVariant(FunctionalTester $I): void
    {
        // Setup
        $variant = $this->getNewVariantRequest();
        $product = $this->getNewProductRequest();
        $product->getVariants()->add($variant);

        $this->client->createProduct($product);

        // Execution
        $variant->setMallboxAllowed(true);
        $variant->setFreeDelivery(true);
        $variant->setDeliveryDelay(5);

        $this->client->updateVariant($product->getId(), $variant);

        // Assertions
        $variantDetail = $this->client->getVariant($product->getId(), $variant->getId());

        $I->assertEquals(5, $variantDetail->getDeliveryDelay());
        $I->assertEquals(true, $variantDetail->hasFreeDelivery());
        $I->assertEquals(true, $variantDetail->hasMallboxAllowed());

        // Cleanup
        $this->client->deleteProduct($product->getId());
    }

    /**
     * @depends testDeleteVariant
     * @throws MpApiException
     */
    public function testGetVariantAvailability(FunctionalTester $I): void
    {
        // Setup
        $variant = $this->getNewVariantRequest();
        $product = $this->getNewProductRequest();
        $product->getVariants()->add($variant);

        $this->client->createProduct($product);

        // Execution
        $availability = $this->client->getVariantAvailability($product->getId(), $variant->getId());

        // Assertions
        $I->assertEquals($variant->getAvailability(), $availability);

        // Cleanup
        $this->client->deleteProduct($product->getId());
    }

    /**
     * @depends testDeleteVariant
     * @throws MpApiException
     */
    public function testGetVariantPricing(FunctionalTester $I): void
    {
        // Setup
        $variant = $this->getNewVariantRequest();
        $variant->setRrp(100);

        $product = $this->getNewProductRequest();
        $product->getVariants()->add($variant);

        $this->client->createProduct($product);

        // Execution
        $pricingFromApi = $this->client->getVariantPricing($product->getId(), $variant->getId());

        // Assertions
        $I->assertEquals($variant->getPrice(), $pricingFromApi->getPrice());
        $I->assertEquals($variant->getRrp(), $pricingFromApi->getRrp());
        $I->assertEquals(0.0, $pricingFromApi->getPurchasePrice());

        // Cleanup
        $this->client->deleteProduct($product->getId());
    }

    /**
     * @depends testDeleteVariant
     * @throws MpApiException
     */
    public function testUpdateVariantPricing(FunctionalTester $I): void
    {
        // Setup
        $variant = $this->getNewVariantRequest();
        $variant->setRrp(100);

        $product = $this->getNewProductRequest();
        $product->getVariants()->add($variant);

        $this->client->createProduct($product);

        // Execution
        $pricing = new Pricing(75, 100, 50);
        $this->client->updateVariantPricing($product->getId(), $variant->getId(), $pricing);

        // Assertions
        $pricingFromApi = $this->client->getVariantPricing($product->getId(), $variant->getId());

        $I->assertEquals($pricing->getPrice(), $pricingFromApi->getPrice());
        //$I->assertEquals($pricing->getRrp(), $pricingFromApi->getRrp());  no longer needed
        $I->assertEquals($pricing->getPurchasePrice(), $pricingFromApi->getPurchasePrice());

        // Cleanup
        $this->client->deleteProduct($product->getId());
    }

    /**
     * @depends testDeleteProduct
     * @depends testCreateVariantProduct
     * @throws MpApiException
     */
    public function testUpdateBatchAvailability(): void
    {
        // Setup
        $variant = $this->getNewVariantRequest();
        $product = $this->getNewProductRequest();
        $product->getVariants()->add($variant);

        $this->client->createProduct($product);

        // Execution
        $availability = new BatchAvailabilityIterator(
            new BatchAvailability($product->getId(), StatusEnum::ACTIVE(), 2),
            new BatchAvailability($variant->getId(), StatusEnum::ACTIVE(), 2),
        );
        $this->client->updateBatchAvailability($availability);

        // No assertions, because batch availability is asynchronous

        // Cleanup
        $this->client->deleteProduct($product->getId());
    }

    /**
     * @deapends testDeleteProduct
     * @throws MpApiException
     */
    public function _testActivateSelectedProducts(FunctionalTester $I): void
    {
        // All products created by active partner are automatically activated and inactive product can not be created.
        // There is no way to write functional test for this method.

        // Setup
        $product1 = $this->getNewProductRequest();
        $product1->setAvailability(new Availability(StatusEnum::INACTIVE(), 1));

        $product2 = $this->getNewProductRequest();
        $product2->setAvailability(new Availability(StatusEnum::INACTIVE(), 1));

        $product1FromApi = $this->client->createProduct($product1);
        $product2FromApi = $this->client->createProduct($product2);

        // Execution
        $this->client->activateSelectedProducts($product1->getId(), $product2->getId());

        // Assertions
        $I->assertEquals(StatusEnum::INACTIVE(), $product1FromApi->getAvailability()->getStatus());
        $I->assertEquals(StatusEnum::INACTIVE(), $product2FromApi->getAvailability()->getStatus());

        $product1Availability = $this->client->getProductAvailability($product1->getId());
        $product2Availability = $this->client->getProductAvailability($product2->getId());

        $I->assertEquals(StatusEnum::ACTIVE(), $product1Availability->getStatus());
        $I->assertEquals(StatusEnum::ACTIVE(), $product2Availability->getStatus());

        // Cleanup
        $this->client->deleteProduct($product1->getId());
        $this->client->deleteProduct($product2->getId());
    }

    /**
     * @depends testDeleteProduct
     * @throws MpApiException
     */
    public function _testActivateAllProducts(FunctionalTester $I): void
    {
        // All products created by active partner are automatically activated and inactive product can not be created.
        // There is no way to write functional test for this method.

        // Setup
        $product1 = $this->getNewProductRequest();
        $product1->setAvailability(new Availability(StatusEnum::INACTIVE(), 1));

        $product2 = $this->getNewProductRequest();
        $product2->setAvailability(new Availability(StatusEnum::INACTIVE(), 1));

        $product1FromApi = $this->client->createProduct($product1);
        $product2FromApi = $this->client->createProduct($product2);

        // Execution
        $this->client->activateAllProducts();

        // Assertions
        $I->assertEquals(StatusEnum::INACTIVE(), $product1FromApi->getAvailability()->getStatus());
        $I->assertEquals(StatusEnum::INACTIVE(), $product2FromApi->getAvailability()->getStatus());

        $product1Availability = $this->client->getProductAvailability($product1->getId());
        $product2Availability = $this->client->getProductAvailability($product2->getId());

        $I->assertEquals(StatusEnum::ACTIVE(), $product1Availability->getStatus());
        $I->assertEquals(StatusEnum::ACTIVE(), $product2Availability->getStatus());

        // Cleanup
        $this->client->deleteProduct($product1->getId());
        $this->client->deleteProduct($product2->getId());
    }

    /*
     * Assertion helpers
     */

    private function assertBasicProductTypes(FunctionalTester $I, BasicProduct $product): void
    {
        $I->assertIsString($product->getId());
        $I->assertIsInt($product->getProductId());
        $I->assertIsString($product->getTitle());
        $I->assertInstanceOf(StatusEnum::class, $product->getStatus());
        $I->assertInstanceOf(ProductStageEnum::class, $product->getStage());
        $I->assertIsInt($product->getInStock());
        $I->assertIsString($product->getCategoryId());
        $I->assertIsFloat($product->getPrice());
        $I->assertIsFloat($product->getPurchasePrice());
        $I->assertIsFloat($product->getRrp());
        $I->assertIsInt($product->getVariantsCount());
        $I->assertIsBool($product->hasVariants());
    }

    private function assertProductValues(FunctionalTester $I, ProductRequest $productRequest, Product $product): void
    {
        $I->assertGreaterThan(0, $product->getArticleId());
        // check fixture fields
        $I->assertEquals($productRequest->getId(), $product->getId());
        $I->assertEquals($productRequest->getTitle(), $product->getTitle());
        $I->assertEquals($productRequest->getShortDesc(), $product->getShortDesc());
        $I->assertEquals($productRequest->getLongDesc(), $product->getLongDesc());
        $I->assertEquals($productRequest->getCategoryId(), $product->getCategoryId());
        $I->assertEquals($productRequest->getVat(), $product->getVat());
        $I->assertEquals($productRequest->getPriority(), $product->getPriority());
        // check custom fields
        $I->assertEquals($productRequest->getPrice(), $product->getPrice());
        $I->assertEquals($productRequest->getPartnerTitle(), $product->getPartnerTitle());
        $I->assertEquals($productRequest->getBrandId(), $product->getBrandId());
        $I->assertEquals($productRequest->getWeeeFee(), $product->getWeeeFee());
        $I->assertEquals($productRequest->getAvailability()->getStatus(), $product->getAvailability()->getStatus());
        $I->assertEquals($productRequest->getAvailability()->getInStock(), $product->getAvailability()->getInStock());
    }

    /**
     * @throws JsonException
     */
    private function assertVariantValues(FunctionalTester $I, VariantRequest $variantRequest, Variant $variant): void
    {
        // API MUST return new articleId
        $I->assertGreaterThan(0, $variant->getArticleId());
        // check fixture fields
        $I->assertEquals($variantRequest->getId(), $variant->getId());
        $I->assertEquals($variantRequest->getTitle(), $variant->getTitle());
        $I->assertEquals($variantRequest->getShortDesc(), $variant->getShortDesc());
        $I->assertEquals($variantRequest->getLongDesc(), $variant->getLongDesc());
        $I->assertEquals($variantRequest->getPriority(), $variant->getPriority());
        $I->assertEquals(json_encode($variantRequest->getMedia(), JSON_THROW_ON_ERROR), json_encode($variant->getMedia(), JSON_THROW_ON_ERROR));
        // check custom fields
        $I->assertEquals($variantRequest->getPrice(), $variant->getPrice());
        $I->assertEquals($variantRequest->getAvailability()->getStatus(), $variant->getAvailability()->getStatus());
        $I->assertEquals($variantRequest->getAvailability()->getInStock(), $variant->getAvailability()->getInStock());
    }

    /*
     * Providers
     */

    private function getNewProductId(): string
    {
        return self::PRODUCT_PREFIX . Functional::getRandomString();
    }

    private function getNewVariantId(): string
    {
        return self::VARIANT_PREFIX . Functional::getRandomString();
    }

    /**
     * Helper that returns minimal valid product with new unique product ID for testing
     */
    private function getNewProductRequest(): ProductRequest
    {
        /** @var callable $productFn */
        $productFn = Fixtures::get('product');
        /** @var ProductRequest $product */
        $product = $productFn();
        $product->setId($this->getNewProductId());
        $product->setAvailability(Fixtures::get('article-availability'));
        $product->setMedia(Fixtures::get('article-media'));
        $product->setPrice(69);

        return $product;
    }

    /**
     * Helper that returns minimal valid variant with new unique variant ID for testing
     */
    private function getNewVariantRequest(): VariantRequest
    {
        /** @var callable $variantFn */
        $variantFn = Fixtures::get('variant');
        /** @var VariantRequest $variant */
        $variant = $variantFn();
        $variant->setId($this->getNewVariantId());
        $variant->setAvailability(Fixtures::get('article-availability'));

        return $variant;
    }

}
