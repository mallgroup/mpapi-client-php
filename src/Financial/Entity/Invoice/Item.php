<?php declare(strict_types=1);

namespace MpApiClient\Financial\Entity\Invoice;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Item implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string $id;
    private int    $articleId;
    private string $title;
    private string $titleEn;
    private int    $quantity;
    private string $unit;
    private float  $unitPrice;
    private float  $vatPrice;
    private float  $priceWithoutVat;
    private float  $vatRate;
    private float  $totalPrice;
    private int    $orderId;

    private function __construct(
        string $id,
        int $articleId,
        string $title,
        string $titleEn,
        int $quantity,
        string $unit,
        float $unitPrice,
        float $vatPrice,
        float $priceWithoutVat,
        float $vatRate,
        float $totalPrice,
        int $orderId
    ) {
        $this->id              = $id;
        $this->articleId       = $articleId;
        $this->title           = $title;
        $this->titleEn         = $titleEn;
        $this->quantity        = $quantity;
        $this->unit            = $unit;
        $this->unitPrice       = $unitPrice;
        $this->vatPrice        = $vatPrice;
        $this->priceWithoutVat = $priceWithoutVat;
        $this->vatRate         = $vatRate;
        $this->totalPrice      = $totalPrice;
        $this->orderId         = $orderId;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (string) $data['id'],
            (int) $data['articleId'],
            (string) $data['title'],
            (string) $data['titleEn'],
            (int) $data['quantity'],
            (string) $data['unit'],
            (float) $data['unitPrice'],
            (float) $data['vatPrice'],
            (float) $data['priceWithoutVat'],
            (float) $data['vatRate'],
            (float) $data['totalPrice'],
            (int) $data['orderId'],
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getArticleId(): int
    {
        return $this->articleId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getTitleEn(): string
    {
        return $this->titleEn;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function getVatPrice(): float
    {
        return $this->vatPrice;
    }

    public function getPriceWithoutVat(): float
    {
        return $this->priceWithoutVat;
    }

    public function getVatRate(): float
    {
        return $this->vatRate;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

}
