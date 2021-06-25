<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity;

use Exception;
use JsonSerializable;
use MpApiClient\Article\Entity\Common\StatusEnum;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class BasicProduct implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string           $id;
    private int              $productId;
    private string           $title;
    private StatusEnum       $status;
    private ProductStageEnum $stage;
    private int              $inStock;
    private string           $categoryId;
    private float            $price;
    private float            $purchasePrice;
    private float            $rrp;
    private int              $variantsCount;
    private bool             $hasVariants;

    private function __construct(
        string $id,
        int $productId,
        string $title,
        StatusEnum $status,
        ProductStageEnum $stage,
        int $inStock,
        string $categoryId,
        float $price,
        float $purchasePrice,
        float $rrp,
        int $variantsCount,
        bool $hasVariants
    ) {
        $this->id            = $id;
        $this->productId     = $productId;
        $this->title         = $title;
        $this->status        = $status;
        $this->stage         = $stage;
        $this->inStock       = $inStock;
        $this->categoryId    = $categoryId;
        $this->price         = $price;
        $this->purchasePrice = $purchasePrice;
        $this->rrp           = $rrp;
        $this->variantsCount = $variantsCount;
        $this->hasVariants   = $hasVariants;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @throws Exception
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (string) $data['id'],
            (int) $data['product_id'],
            (string) $data['title'],
            new StatusEnum((string) $data[StatusEnum::KEY_NAME]),
            new ProductStageEnum((string) $data[ProductStageEnum::KEY_NAME]),
            (int) $data['in_stock'],
            (string) $data['category_id'],
            (float) $data['price'],
            (float) $data['purchase_price'],
            (float) $data['rrp'],
            (int) $data['variants_count'],
            (bool) $data['has_variants'],
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getStatus(): StatusEnum
    {
        return $this->status;
    }

    public function getStage(): ProductStageEnum
    {
        return $this->stage;
    }

    public function getInStock(): int
    {
        return $this->inStock;
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getPurchasePrice(): float
    {
        return $this->purchasePrice;
    }

    public function getRrp(): float
    {
        return $this->rrp;
    }

    public function getVariantsCount(): int
    {
        return $this->variantsCount;
    }

    public function hasVariants(): bool
    {
        return $this->hasVariants;
    }

}
