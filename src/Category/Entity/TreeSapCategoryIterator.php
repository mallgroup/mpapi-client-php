<?php declare(strict_types=1);

namespace MpApiClient\Category\Entity;

use MpApiClient\Common\Util\AbstractIntKeyIterator;

/**
 * @extends AbstractIntKeyIterator<TreeSapCategory>
 * @property TreeSapCategory[] $data
 */
final class TreeSapCategoryIterator extends AbstractIntKeyIterator
{

    private function __construct(TreeSapCategory ...$data)
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
            ...array_map(fn(array $item): TreeSapCategory => TreeSapCategory::createFromApi($item), $data)
        );
    }

    /**
     * @return false|TreeSapCategory
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(int $key): ?TreeSapCategory
    {
        return $this->data[$key] ?? null;
    }

}
