<?php declare(strict_types=1);

namespace MpApiClient\Article\DTO;

use MpApiClient\Common\Util\AbstractStringKeyIterator;

/**
 * @extends AbstractStringKeyIterator<VariantRequest>
 * @property array<string, VariantRequest> $data
 */
final class VariantRequestIterator extends AbstractStringKeyIterator
{

    public function __construct(VariantRequest ...$data)
    {
        foreach ($data as $variant) {
            $this->data[$variant->getId()] = $variant;
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getArrayForApi(): array
    {
        return array_map(fn(VariantRequest $variantRequest): array => $variantRequest->getArrayForApi(), array_values($this->data));
    }

    /**
     * @return false|VariantRequest
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(string $key): ?VariantRequest
    {
        return $this->data[$key] ?? null;
    }

    public function remove(string $key): void
    {
        parent::remove($key);
    }

    public function add(VariantRequest $value): void
    {
        $this->data[$value->getId()] = $value;
    }

}
