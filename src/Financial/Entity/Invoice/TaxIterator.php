<?php declare(strict_types=1);

namespace MpApiClient\Financial\Entity\Invoice;

use MpApiClient\Common\Util\AbstractStringKeyIterator;

/**
 * @extends AbstractStringKeyIterator<Tax>
 * @property array<string, Tax> $data
 */
final class TaxIterator extends AbstractStringKeyIterator
{

    private function __construct(Tax ...$data)
    {
        foreach ($data as $tax) {
            $this->data[$tax->getTax()] = $tax;
        }
    }

    /**
     * @param array<int, array<string, mixed>> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        $items = [];
        foreach ($data as $values) {
            $items[] = Tax::createFromApi($values);
        }

        return new self(...$items);
    }

    /**
     * @return false|Tax
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(string $key): ?Tax
    {
        return $this->data[$key] ?? null;
    }

}
