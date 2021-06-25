<?php declare(strict_types=1);

namespace MpApiClient\Order\Entity;

use Closure;
use Exception;
use MpApiClient\Common\Util\AbstractList;
use MpApiClient\Filter\Filter;

/**
 * @extends AbstractList<BasicOrder>
 * @property BasicOrder[] $data
 */
final class BasicOrderList extends AbstractList
{

    /**
     * @throws Exception
     */
    public static function createWithCallback(Closure $callback, Filter $filter): self
    {
        return new self($callback, $filter);
    }

    /**
     * @return false|BasicOrder
     */
    public function current()
    {
        return current($this->data);
    }

    /**
     * @param array<int, array<string, mixed>> $data
     * @return BasicOrder[]
     * @throws Exception
     */
    protected function parseData(array $data): array
    {
        $items = [];
        foreach ($data as $item) {
            $items[] = BasicOrder::createFromApi($item);
        }

        return $items;
    }

}
