<?php declare(strict_types=1);

namespace MpApiClient\Article\DTO;

use MpApiClient\Article\Entity\Common\Availability;
use MpApiClient\Article\Entity\Common\StatusEnum;

final class BatchAvailability extends Availability
{

    private string $id;

    public function __construct(string $id, StatusEnum $status, int $inStock)
    {
        parent::__construct($status, $inStock);
        $this->id = $id;
    }

    /**
     * @return array<string, mixed>
     */
    public function getArrayForApi(): array
    {
        return [
            'id'                 => $this->getId(),
            StatusEnum::KEY_NAME => $this->getStatus()->getValue(),
            'in_stock'           => $this->getInStock(),
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

}
