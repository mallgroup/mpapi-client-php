<?php declare(strict_types=1);

namespace MpApiClient\Category\Entity;

use MpApiClient\Common\Util\AbstractStringKeyIterator;

/**
 * @extends AbstractStringKeyIterator<Category>
 * @property array<string, Category> $data
 */
final class CategoryIterator extends AbstractStringKeyIterator
{

    private function __construct(Category ...$data)
    {
        foreach ($data as $category) {
            $this->data[$category->getCategoryId()] = $category;
        }
    }

    /**
     * @param array<int, array<string, mixed>> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            ...array_map(fn(array $item): Category => Category::createFromApi($item), $data)
        );
    }

    /**
     * @return false|Category
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(string $key): ?Category
    {
        return $this->data[$key] ?? null;
    }

}
