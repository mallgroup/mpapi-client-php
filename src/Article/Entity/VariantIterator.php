<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity;

use Exception;
use MpApiClient\Common\Util\AbstractStringKeyIterator;

/**
 * @extends AbstractStringKeyIterator<Variant>
 * @property array<string, Variant> $data
 */
final class VariantIterator extends AbstractStringKeyIterator
{

    public function __construct(Variant ...$data)
    {
        foreach ($data as $variant) {
            $this->data[$variant->getId()] = $variant;
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
            ...array_map(fn(array $item): Variant => Variant::createFromApi($item), $data)
        );
    }

    /**
     * @return false|Variant
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(string $key): ?Variant
    {
        return $this->data[$key] ?? null;
    }

}
