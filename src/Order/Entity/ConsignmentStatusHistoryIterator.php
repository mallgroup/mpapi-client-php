<?php declare(strict_types=1);

namespace MpApiClient\Order\Entity;

use Exception;
use MpApiClient\Common\Util\AbstractIntKeyIterator;

/**
 * @extends AbstractIntKeyIterator<ConsignmentStatusHistoryItem>
 * @property ConsignmentStatusHistoryItem[] $data
 */
final class ConsignmentStatusHistoryIterator extends AbstractIntKeyIterator
{

    private function __construct(ConsignmentStatusHistoryItem ...$data)
    {
        $this->data = $data;
    }

    /**
     * @param array<int, array<string, mixed>> $data
     *
     * @throws Exception
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            ...array_map(fn(array $item): ConsignmentStatusHistoryItem => ConsignmentStatusHistoryItem::createFromApi($item), $data)
        );
    }

    /**
     * @return false|ConsignmentStatusHistoryItem
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(int $key): ?ConsignmentStatusHistoryItem
    {
        return $this->data[$key] ?? null;
    }

}
