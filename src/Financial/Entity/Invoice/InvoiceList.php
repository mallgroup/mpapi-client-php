<?php declare(strict_types=1);

namespace MpApiClient\Financial\Entity\Invoice;

use Closure;
use Exception;
use MpApiClient\Common\Util\AbstractList;
use MpApiClient\Filter\Filter;

/**
 * @extends AbstractList<Invoice>
 * @property Invoice[] $data
 */
final class InvoiceList extends AbstractList
{

    public static function createWithCallback(Closure $callback, Filter $filter): self
    {
        return new self($callback, $filter);
    }

    /**
     * @return false|Invoice
     */
    public function current()
    {
        return current($this->data);
    }

    /**
     * @param array<int, array<string, mixed>> $data
     * @return Invoice[]
     * @throws Exception
     */
    protected function parseData(array $data): array
    {
        $items = [];
        foreach ($data as $item) {
            $items[] = Invoice::createFromApi($item);
        }

        return $items;
    }

}
