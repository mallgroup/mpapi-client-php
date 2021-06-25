<?php declare(strict_types=1);

namespace MpApiClient\Category\Entity;

use MpApiClient\Common\Util\AbstractIntKeyIterator;

/**
 * @extends AbstractIntKeyIterator<TreeItem>
 * @property TreeItem[] $data
 */
final class TreeItemIterator extends AbstractIntKeyIterator
{

    private function __construct(TreeItem ...$data)
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
            ...array_map(fn(array $item): TreeItem => TreeItem::createFromApi($item), $data)
        );
    }

    /**
     * @param array<int, array<string, mixed>> $data
     *
     * @internal
     */
    public static function createFromMixedApi(array $data): self
    {
        return new self(
            ...array_map(fn(array $item): TreeItem => TreeItem::createFromMixedApi($item), $data)
        );
    }

    /**
     * @return false|TreeItem
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(int $key): ?TreeItem
    {
        return $this->data[$key] ?? null;
    }

}
