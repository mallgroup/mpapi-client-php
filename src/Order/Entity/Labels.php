<?php declare(strict_types=1);

namespace MpApiClient\Order\Entity;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Labels implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private LabelsOrderIterator $orders;
    private string              $labelsRaw;

    private function __construct(LabelsOrderIterator $orders, string $labelsRaw)
    {
        $this->orders    = $orders;
        $this->labelsRaw = $labelsRaw;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            LabelsOrderIterator::createFromApi($data['orders']),
            (string) $data['labels_raw'],
        );
    }

    public function getOrders(): LabelsOrderIterator
    {
        return $this->orders;
    }

    public function getLabelsRaw(): string
    {
        return $this->labelsRaw;
    }

}
