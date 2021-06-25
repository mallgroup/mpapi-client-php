<?php declare(strict_types=1);

namespace MpApiClient\Category\Entity;

use MpApiClient\Common\Util\AbstractIntKeyIterator;

/**
 * @extends AbstractIntKeyIterator<TreeMenuItem>
 * @property TreeMenuItem[] $data
 */
final class TreeMenuItemIterator extends AbstractIntKeyIterator
{

    private function __construct(TreeMenuItem ...$data)
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
            ...array_map(fn(array $item): TreeMenuItem => TreeMenuItem::createFromApi($item), $data)
        );
    }

    /**
     * @return false|TreeMenuItem
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(int $key): ?TreeMenuItem
    {
        return $this->data[$key] ?? null;
    }

}
