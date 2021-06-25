<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity\Common;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

class Availability implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private StatusEnum $status;
    private int        $inStock;

    public function __construct(StatusEnum $status, int $inStock)
    {
        $this->status  = $status;
        $this->inStock = $inStock;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            new StatusEnum((string) $data[StatusEnum::KEY_NAME]),
            (int) $data['in_stock'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function getArrayForApi(): array
    {
        return [
            StatusEnum::KEY_NAME => $this->getStatus()->getValue(),
            'in_stock'           => $this->getInStock(),
        ];
    }

    public function getStatus(): StatusEnum
    {
        return $this->status;
    }

    public function setStatus(StatusEnum $status): void
    {
        $this->status = $status;
    }

    public function getInStock(): int
    {
        return $this->inStock;
    }

    public function setInStock(int $inStock): void
    {
        $this->inStock = $inStock;
    }

}
