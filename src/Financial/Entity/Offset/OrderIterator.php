<?php declare(strict_types=1);

namespace MpApiClient\Financial\Entity\Offset;

use Exception;
use MpApiClient\Common\Util\AbstractIntKeyIterator;

/**
 * @extends AbstractIntKeyIterator<Order>
 * @property array<int, Order> $data
 */
final class OrderIterator extends AbstractIntKeyIterator
{

    private function __construct(Order ...$data)
    {
        foreach ($data as $order) {
            $this->data[$order->getId()] = $order;
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
            ...array_map(fn(array $item): Order => Order::createFromApi($item), $data)
        );
    }

    /**
     * @return false|Order
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(int $key): ?Order
    {
        return $this->data[$key] ?? null;
    }

}
