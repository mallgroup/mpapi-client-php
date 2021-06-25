<?php declare(strict_types=1);

namespace MpApiClient\Article\DTO;

use MpApiClient\Common\Util\AbstractStringKeyIterator;

/**
 * @extends AbstractStringKeyIterator<BatchAvailability>
 * @property array<string, BatchAvailability> $data
 */
final class BatchAvailabilityIterator extends AbstractStringKeyIterator
{

    public function __construct(BatchAvailability ...$data)
    {
        foreach ($data as $availability) {
            $this->data[$availability->getId()] = $availability;
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getArrayForApi(): array
    {
        return array_map(fn(BatchAvailability $availability): array => $availability->getArrayForApi(), array_values($this->data));
    }

    /**
     * @return false|BatchAvailability
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(string $key): ?BatchAvailability
    {
        return $this->data[$key] ?? null;
    }

    public function remove(string $key): void
    {
        parent::remove($key);
    }

    public function add(BatchAvailability $value): void
    {
        $this->data[$value->getId()] = $value;
    }

}
