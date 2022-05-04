<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity\Common;

use Exception;
use MpApiClient\Common\Util\AbstractIntKeyIterator;

/**
 * @extends AbstractIntKeyIterator<Promotion>
 * @property Promotion[] $data
 * @deprecated
 */
final class PromotionIterator extends AbstractIntKeyIterator
{

    public function __construct(Promotion ...$data)
    {
        $this->data = $data;
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
            ...array_map(fn(array $item): Promotion => Promotion::createFromApi($item), $data)
        );
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getArrayForApi(): array
    {
        return array_map(fn(Promotion $promotion): array => $promotion->getArrayForApi(), array_values($this->data));
    }

    /**
     * @return false|Promotion
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(int $key): ?Promotion
    {
        return $this->data[$key] ?? null;
    }

}
