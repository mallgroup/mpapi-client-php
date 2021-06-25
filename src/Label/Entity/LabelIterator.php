<?php declare(strict_types=1);

namespace MpApiClient\Label\Entity;

use MpApiClient\Common\Util\AbstractStringKeyIterator;

/**
 * @extends AbstractStringKeyIterator<Label>
 * @property array<string, Label> $data
 */
final class LabelIterator extends AbstractStringKeyIterator
{

    private function __construct(Label ...$data)
    {
        foreach ($data as $label) {
            $this->data[$label->getId()] = $label;
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
            ...array_map(fn(array $item): Label => Label::createFromApi($item), $data)
        );
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

}
