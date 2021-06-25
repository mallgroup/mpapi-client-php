<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity\Common;

use Exception;
use MpApiClient\Common\Util\AbstractStringKeyIterator;

/**
 * @extends AbstractStringKeyIterator<Label>
 * @property array<string, Label> $data
 */
final class LabelIterator extends AbstractStringKeyIterator
{

    public function __construct(Label ...$data)
    {
        foreach ($data as $availability) {
            $this->data[$availability->getLabel()] = $availability;
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
            ...array_map(fn(array $item): Label => Label::createFromApi($item), $data)
        );
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getArrayForApi(): array
    {
        return array_map(fn(Label $label): array => $label->getArrayForApi(), array_values($this->data));
    }

    /**
     * @return false|Label
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(string $key): ?Label
    {
        return $this->data[$key] ?? null;
    }

    public function remove(string $key): void
    {
        parent::remove($key);
    }

    public function add(Label $value): void
    {
        $this->data[$value->getLabel()] = $value;
    }

}
