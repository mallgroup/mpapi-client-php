<?php declare(strict_types=1);

namespace MpApiClient\Order\Entity;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class LabelsOrder implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private int $orderId;
    /**
     * @var string[]
     */
    private array $barcodes;

    /**
     * @param int      $orderId
     * @param string[] $barcodes
     */
    private function __construct(int $orderId, array $barcodes)
    {
        $this->orderId  = $orderId;
        $this->barcodes = $barcodes;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (int) $data['order_id'],
            $data['barcodes'],
        );
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @return string[]
     */
    public function getBarcodes(): array
    {
        return $this->barcodes;
    }

}
