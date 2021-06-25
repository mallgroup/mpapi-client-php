<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity;

use Closure;
use Exception;
use MpApiClient\Common\Util\AbstractList;
use MpApiClient\Filter\Filter;

/**
 * @extends AbstractList<BasicProduct>
 * @property BasicProduct[] $data
 */
final class BasicProductList extends AbstractList
{

    public static function createWithCallback(Closure $callback, Filter $filter): self
    {
        return new self($callback, $filter);
    }

    /**
     * @return false|BasicProduct
     */
    public function current()
    {
        return current($this->data);
    }

    /**
     * @param array<int, array<string, mixed>> $data
     * @return BasicProduct[]
     * @throws Exception
     */
    protected function parseData(array $data): array
    {
        $items = [];
        foreach ($data as $item) {
            $items[] = BasicProduct::createFromApi($item);
        }

        return $items;
    }

}
