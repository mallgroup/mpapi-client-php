<?php declare(strict_types=1);

namespace MpApiClient\Financial\Entity\Offset;

use Exception;
use MpApiClient\Common\Util\AbstractIntKeyIterator;

/**
 * @extends AbstractIntKeyIterator<InvoiceSimple>
 * @property array<int, InvoiceSimple> $data
 */
final class InvoiceSimpleIterator extends AbstractIntKeyIterator
{

    private function __construct(InvoiceSimple ...$data)
    {
        foreach ($data as $invoiceSimple) {
            $this->data[$invoiceSimple->getId()] = $invoiceSimple;
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
            ...array_map(fn(array $item): InvoiceSimple => InvoiceSimple::createFromApi($item), $data)
        );
    }

    /**
     * @return false|InvoiceSimple
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(int $key): ?InvoiceSimple
    {
        return $this->data[$key] ?? null;
    }

}
