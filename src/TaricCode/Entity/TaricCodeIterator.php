<?php declare(strict_types=1);

namespace MpApiClient\TaricCode\Entity;

use MpApiClient\Common\Util\AbstractStringKeyIterator;

/**
 * @extends AbstractStringKeyIterator<TaricCode>
 * @property array<string, TaricCode> $data
 */
final class TaricCodeIterator extends AbstractStringKeyIterator
{

    private function __construct(TaricCode ...$data)
    {
        foreach ($data as $taricCode) {
            $this->data[$taricCode->getId()] = $taricCode;
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
            ...array_map(fn(array $item): TaricCode => TaricCode::createFromApi($item), $data)
        );
    }

    /**
     * @return false|TaricCode
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(string $key): ?TaricCode
    {
        return $this->data[$key] ?? null;
    }

}
