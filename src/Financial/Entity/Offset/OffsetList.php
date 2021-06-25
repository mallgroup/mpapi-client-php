<?php declare(strict_types=1);

namespace MpApiClient\Financial\Entity\Offset;

use Closure;
use Exception;
use MpApiClient\Common\Util\AbstractList;
use MpApiClient\Filter\Filter;

/**
 * @extends AbstractList<Offset>
 * @property Offset[] $data
 */
final class OffsetList extends AbstractList
{

    public static function createWithCallback(Closure $callback, Filter $filter): self
    {
        return new self($callback, $filter);
    }

    /**
     * @return false|Offset
     */
    public function current()
    {
        return current($this->data);
    }

    /**
     * @param array<int, array<string, mixed>> $data
     * @return Offset[]
     * @throws Exception
     */
    protected function parseData(array $data): array
    {
        $items = [];
        foreach ($data as $item) {
            $items[] = Offset::createFromApi($item);
        }

        return $items;
    }

}
