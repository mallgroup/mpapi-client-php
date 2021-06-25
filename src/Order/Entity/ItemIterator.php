<?php declare(strict_types=1);

namespace MpApiClient\Order\Entity;

use Exception;
use MpApiClient\Common\Util\AbstractStringKeyIterator;

/**
 * @extends AbstractStringKeyIterator<Item>
 * @property array<string, Item> $data
 */
final class ItemIterator extends AbstractStringKeyIterator
{

    private function __construct(Item ...$data)
    {
        foreach ($data as $orderItem) {
            $this->data[$orderItem->getId()] = $orderItem;
        }
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
            ...array_map(fn(array $item): Item => Item::createFromApi($item), $data)
        );
    }

    /**
     * @return false|Item
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(string $key): ?Item
    {
        return $this->data[$key] ?? null;
    }

}
