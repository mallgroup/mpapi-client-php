<?php declare(strict_types=1);

namespace MpApiClient\Financial;

use Closure;
use GuzzleHttp\Psr7\Request;
use MpApiClient\Common\AbstractMpApiClient;
use MpApiClient\Common\Interfaces\FinancialClientInterface;
use MpApiClient\Filter\Filter;
use MpApiClient\Financial\Entity\Invoice\Invoice;
use MpApiClient\Financial\Entity\Invoice\InvoiceList;
use MpApiClient\Financial\Entity\Offset\Offset;
use MpApiClient\Financial\Entity\Offset\OffsetList;
use Psr\Http\Message\ResponseInterface;

final class FinancialClient extends AbstractMpApiClient implements FinancialClientInterface
{

    private const INVOICE_LIST     = '/v1/invoices';
    private const INVOICE_DETAIL   = '/v1/invoices/%s';
    private const INVOICE_DOWNLOAD = '/v1/invoices/%s/download';

    private const OFFSET_LIST     = '/v1/offsets';
    private const OFFSET_DETAIL   = '/v1/offsets/%s';
    private const OFFSET_DOWNLOAD = '/v1/offsets/%s/download';

    public function listInvoices(?Filter $filter): InvoiceList
    {
        return InvoiceList::createWithCallback(
            Closure::fromCallable(
                fn(Filter $filter): array => $this->sendQueryRequest(self::INVOICE_LIST, $filter->buildFilterQuery())
            ),
            $filter ?? new Filter(),
        );
    }

    public function getInvoice(string $invoiceId): Invoice
    {
        return Invoice::createFromApi(
            $this->sendJson('GET', sprintf(self::INVOICE_DETAIL, $invoiceId))['data']
        );
    }

    public function downloadInvoice(string $invoiceId): ResponseInterface
    {
        return $this->send(
            new Request('GET', sprintf(self::INVOICE_DOWNLOAD, $invoiceId), $this->getAppHeaders())
        );
    }

    public function listOffsets(?Filter $filter): OffsetList
    {
        return OffsetList::createWithCallback(
            Closure::fromCallable(
                fn(Filter $filter): array => $this->sendQueryRequest(self::OFFSET_LIST, $filter->buildFilterQuery())
            ),
            $filter ?? new Filter(),
        );
    }

    public function getOffset(string $offsetId): Offset
    {
        return Offset::createFromApi(
            $this->sendJson('GET', sprintf(self::OFFSET_DETAIL, $offsetId))['data']
        );
    }

    public function downloadOffset(string $offsetId): ResponseInterface
    {
        return $this->send(
            new Request('GET', sprintf(self::OFFSET_DOWNLOAD, $offsetId), $this->getAppHeaders())
        );
    }

}
