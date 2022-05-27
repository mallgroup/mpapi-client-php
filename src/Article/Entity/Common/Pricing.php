<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity\Common;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Pricing implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private float $price;
    private float $rrp;
    private float $purchasePrice;
    private ?float $fairPrice;

    public function __construct(float $price, float $rrp, float $purchasePrice, ?float $fairPrice = null)
    {
        $this->price         = $price;
        $this->rrp           = $rrp;
        $this->purchasePrice = $purchasePrice;
        $this->fairPrice     = $fairPrice;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (float) $data['price'],
            (float) $data['rrp'],
            (float) $data['purchase_price'],
            isset($data['fair_price']) ? (float) $data['fair_price'] : null
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function getArrayForApi(): array
    {
        return [
            'price'          => $this->getPrice(),
            'rrp'            => $this->getRrp(),
            'purchase_price' => $this->getPurchasePrice(),
            'fair_price'     => $this->getFairPrice(),
        ];
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getRrp(): float
    {
        return $this->rrp;
    }

    public function getPurchasePrice(): float
    {
        return $this->purchasePrice;
    }

    public function getFairPrice(): ?float
    {
        return $this->fairPrice;
    }

}
