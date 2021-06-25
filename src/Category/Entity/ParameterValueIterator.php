<?php declare(strict_types=1);

namespace MpApiClient\Category\Entity;

use MpApiClient\Common\Util\AbstractStringKeyIterator;

/**
 * @extends AbstractStringKeyIterator<ParameterValue>
 * @property array<string, ParameterValue> $data
 */
final class ParameterValueIterator extends AbstractStringKeyIterator
{

    private function __construct(ParameterValue ...$data)
    {
        foreach ($data as $value) {
            $this->data[$value->getValue()] = $value;
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
            ...array_map(fn(array $item): ParameterValue => ParameterValue::createFromApi($item), $data)
        );
    }

    /**
     * @return false|ParameterValue
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(string $key): ?ParameterValue
    {
        return $this->data[$key] ?? null;
    }

}
