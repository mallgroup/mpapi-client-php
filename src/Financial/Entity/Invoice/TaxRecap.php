<?php declare(strict_types=1);

namespace MpApiClient\Financial\Entity\Invoice;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class TaxRecap implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private float       $total;
    private TaxIterator $taxes;

    private function __construct(float $total, TaxIterator $taxes)
    {
        $this->total = $total;
        $this->taxes = $taxes;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (float) $data['total'],
            TaxIterator::createFromApi($data['taxes']),
        );
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getTaxes(): TaxIterator
    {
        return $this->taxes;
    }

}
