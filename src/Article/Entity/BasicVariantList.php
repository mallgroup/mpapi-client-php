<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity;

use Closure;
use Exception;
use MpApiClient\Common\Util\AbstractList;
use MpApiClient\Filter\Filter;

/**
 * @extends AbstractList<BasicVariant>
 * @property BasicVariant[] $data
 */
final class BasicVariantList extends AbstractList
{

    public static function createWithCallback(Closure $callback, Filter $filter): self
    {
        return new self($callback, $filter);
    }

    /**
     * @return false|BasicVariant
     */
    public function current()
    {
        return current($this->data);
    }

    /**
     * @param array<int, array<string, mixed>> $data
     * @return BasicVariant[]
     * @throws Exception
     */
    protected function parseData(array $data): array
    {
        $items = [];
        foreach ($data as $item) {
            $items[] = BasicVariant::createFromApi($item);
        }

        return $items;
    }

}
