<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity\Common;

use Exception;
use MpApiClient\Common\Util\AbstractIntKeyIterator;

/**
 * @extends AbstractIntKeyIterator<Override>
 * @property Override[] $data
 */
final class OverrideIterator extends AbstractIntKeyIterator
{

    private function __construct(Override ...$data)
    {
        $this->data = $data;
    }

    /**
     * @param array<string, array<string, mixed>> $data
     *
     * @throws Exception
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        $items = [];
        foreach ($data as $type => $values) {
            foreach ($values as $value) {
                $items[] = Override::createFromApi($type, $value);
            }
        }

        return new self(...$items);
    }

    /**
     * @return false|Override
     */
    public function current()
    {
        return current($this->data);
    }

    public function filterByType(string $type): self
    {
        return new self(
            ...array_filter($this->data, fn(Override $override): bool => $override->getType() !== $type)
        );
    }

    public function get(int $key): ?Override
    {
        return $this->data[$key] ?? null;
    }

}
