<?php declare(strict_types=1);

namespace MpApiClient\Category\Entity;

use MpApiClient\Common\Util\AbstractStringKeyIterator;

/**
 * @extends AbstractStringKeyIterator<Parameter>
 * @property array<string, Parameter> $data
 */
final class ParameterIterator extends AbstractStringKeyIterator
{

    private function __construct(Parameter ...$data)
    {
        foreach ($data as $category) {
            $this->data[$category->getParamId()] = $category;
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
            ...array_map(fn(array $item): Parameter => Parameter::createFromApi($item), $data)
        );
    }

    /**
     * @return false|Parameter
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(string $key): ?Parameter
    {
        return $this->data[$key] ?? null;
    }

}
