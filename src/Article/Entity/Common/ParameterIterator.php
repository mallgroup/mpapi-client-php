<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity\Common;

use MpApiClient\Common\Util\AbstractStringKeyIterator;

/**
 * @extends AbstractStringKeyIterator<Parameter>
 * @property array<string, Parameter> $data
 */
final class ParameterIterator extends AbstractStringKeyIterator
{

    public function __construct(Parameter ...$data)
    {
        foreach ($data as $parameter) {
            $this->data[$parameter->getId()] = $parameter;
        }
    }

    /**
     * @param array<string, string[]> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        $items = [];
        foreach ($data as $id => $values) {
            $items[] = Parameter::createFromApi($id, $values);
        }

        return new self(...$items);
    }

    /**
     * @return array<string, string[]>
     */
    public function getArrayForApi(): array
    {
        $out = [];
        foreach ($this->data as $parameter) {
            $out[$parameter->getId()] = $parameter->getValues();
        }

        return $out;
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

    public function remove(string $key): void
    {
        parent::remove($key);
    }

    public function add(Parameter $value): void
    {
        $this->data[$value->getId()] = $value;
    }

}
