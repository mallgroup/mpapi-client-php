<?php declare(strict_types=1);

namespace MpApiClient\Financial\Entity\Invoice;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Tax implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string $tax;
    private float  $base;
    private float  $total;
    private float  $price;

    private function __construct(string $tax, float $base, float $total, float $price)
    {
        $this->tax   = $tax;
        $this->base  = $base;
        $this->total = $total;
        $this->price = $price;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (string) $data['tax'],
            (float) $data['base'],
            (float) $data['total'],
            (float) $data['price'],
        );
    }

    public function getTax(): string
    {
        return $this->tax;
    }

    public function getBase(): float
    {
        return $this->base;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

}
