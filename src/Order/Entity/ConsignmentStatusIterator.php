<?php declare(strict_types=1);

namespace MpApiClient\Order\Entity;

use Exception;
use MpApiClient\Common\Util\AbstractIntKeyIterator;

/**
 * @extends AbstractIntKeyIterator<ConsignmentStatus>
 * @property ConsignmentStatus[] $data
 */
final class ConsignmentStatusIterator extends AbstractIntKeyIterator
{

    private function __construct(ConsignmentStatus ...$data)
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
            ...array_map(fn(array $item): ConsignmentStatus => ConsignmentStatus::createFromApi($item), $data)
        );
    }

    /**
     * @return false|ConsignmentStatus
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(int $key): ?ConsignmentStatus
    {
        return $this->data[$key] ?? null;
    }

}
