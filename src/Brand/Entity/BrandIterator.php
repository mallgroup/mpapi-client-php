<?php declare(strict_types=1);

namespace MpApiClient\Brand\Entity;

use MpApiClient\Common\Util\AbstractStringKeyIterator;

/**
 * @extends AbstractStringKeyIterator<Brand>
 * @property array<string, Brand> $data
 */
final class BrandIterator extends AbstractStringKeyIterator
{

    private function __construct(Brand ...$data)
    {
        foreach ($data as $brand) {
            $this->data[$brand->getBrandId()] = $brand;
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
            ...array_map(fn(array $item): Brand => Brand::createFromApi($item), $data)
        );
    }

    /**
     * @return false|Brand
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(string $key): ?Brand
    {
        return $this->data[$key] ?? null;
    }

}
