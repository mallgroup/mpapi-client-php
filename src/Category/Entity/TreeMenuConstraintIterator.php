<?php declare(strict_types=1);

namespace MpApiClient\Category\Entity;

use MpApiClient\Common\Util\AbstractIntKeyIterator;

/**
 * @extends AbstractIntKeyIterator<TreeMenuConstraint>
 * @property TreeMenuConstraint[] $data
 */
final class TreeMenuConstraintIterator extends AbstractIntKeyIterator
{

    private function __construct(TreeMenuConstraint ...$data)
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
            ...array_map(fn(array $item): TreeMenuConstraint => TreeMenuConstraint::createFromApi($item), $data)
        );
    }

    /**
     * @return false|TreeMenuConstraint
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(int $key): ?TreeMenuConstraint
    {
        return $this->data[$key] ?? null;
    }

}
