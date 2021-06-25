<?php declare(strict_types=1);

namespace MpApiClient\Common\Interfaces;

use Exception;
use MpApiClient\Exception\MpApiException;
use MpApiClient\Filter\Filter;
use MpApiClient\Financial\Entity\Invoice\Invoice;
use MpApiClient\Financial\Entity\Invoice\InvoiceList;
use MpApiClient\Financial\Entity\Offset\Offset;
use MpApiClient\Financial\Entity\Offset\OffsetList;
use Psr\Http\Message\ResponseInterface;

interface FinancialClientInterface
{

    /**
     * @throws MpApiException
     * @throws Exception
     */
    public function listInvoices(?Filter $filter): InvoiceList;

    /**
     * @throws MpApiException
     * @throws Exception
     */
    public function getInvoice(string $invoiceId): Invoice;

    /**
     * @throws MpApiException
     */
    public function downloadInvoice(string $invoiceId): ResponseInterface;

    /**
     * @throws MpApiException
     * @throws Exception
     */
    public function listOffsets(?Filter $filter): OffsetList;

    /**
     * @throws MpApiException
     * @throws Exception
     */
    public function getOffset(string $offsetId): Offset;

    /**
     * @throws MpApiException
     */
    public function downloadOffset(string $offsetId): ResponseInterface;

}
