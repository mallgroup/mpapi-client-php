<?php declare(strict_types=1);

namespace MpApiClient\Shop\Entity;

use MpApiClient\Common\Util\AbstractStringKeyIterator;

/**
 * @extends AbstractStringKeyIterator<Shop>
 * @property array<string, Shop> $data
 */
final class ShopIterator extends AbstractStringKeyIterator
{

    private function __construct(Shop ...$data)
    {
        foreach ($data as $shop) {
            $this->data[$shop->getShopId()->getValue()] = $shop;
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
            ...array_values(array_map(fn(array $item): Shop => Shop::createFromApi($item), $data))
        );
    }

    /**
     * @return false|Shop
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(string $key): ?Shop
    {
        return $this->data[$key] ?? null;
    }

    public function getByShopId(ShopIdEnum $shopId): ?Shop
    {
        return $this->get($shopId->getValue());
    }

}
