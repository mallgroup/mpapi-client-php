<?php declare(strict_types=1);

namespace MpApiClient\Order\Entity;

use MpApiClient\Common\Util\AbstractIntKeyIterator;

/**
 * @extends AbstractIntKeyIterator<LabelsOrder>
 * @property LabelsOrder[] $data
 */
final class LabelsOrderIterator extends AbstractIntKeyIterator
{

    private function __construct(LabelsOrder ...$data)
    {
        $this->data = $data;
    }

    /**
     * @param array<int, array<string, mixed>> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            ...array_map(fn(array $item): LabelsOrder => LabelsOrder::createFromApi($item), $data)
        );
    }

    /**
     * @return false|LabelsOrder
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(int $key): ?LabelsOrder
    {
        return $this->data[$key] ?? null;
    }

}
