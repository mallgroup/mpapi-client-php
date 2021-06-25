<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity;

use Exception;
use JsonSerializable;
use MpApiClient\Article\Entity\Common\StatusEnum;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class BasicVariant implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string     $id;
    private int        $productId;
    private int        $variantId;
    private string     $title;
    private StatusEnum $status;
    private int        $inStock;
    private float      $price;
    private float      $purchasePrice;
    private float      $rrp;

    private function __construct(
        string $id,
        int $productId,
        int $variantId,
        string $title,
        StatusEnum $status,
        int $inStock,
        float $price,
        float $purchasePrice,
        float $rrp
    ) {
        $this->id            = $id;
        $this->productId     = $productId;
        $this->variantId     = $variantId;
        $this->title         = $title;
        $this->status        = $status;
        $this->inStock       = $inStock;
        $this->price         = $price;
        $this->purchasePrice = $purchasePrice;
        $this->rrp           = $rrp;
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
            (int) $data['variant_id'],
            (string) $data['title'],
            new StatusEnum((string) $data[StatusEnum::KEY_NAME]),
            (int) $data['in_stock'],
            (float) $data['price'],
            (float) $data['purchase_price'],
            (float) $data['rrp'],
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

    public function getVariantId(): int
    {
        return $this->variantId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getStatus(): StatusEnum
    {
        return $this->status;
    }

    public function getInStock(): int
    {
        return $this->inStock;
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

}
