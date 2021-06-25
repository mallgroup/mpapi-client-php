<?php declare(strict_types=1);

namespace MpApiClient\Tests\functional;

use Codeception\Util\Fixtures;
use MpApiClient\Exception\MpApiException;
use MpApiClient\Filter\Filter;
use MpApiClient\Financial\Entity\Common\Address;
use MpApiClient\Financial\Entity\Common\Attachment;
use MpApiClient\Financial\Entity\Common\Customer;
use MpApiClient\Financial\Entity\Common\Supplier;
use MpApiClient\Financial\Entity\Invoice\Bank;
use MpApiClient\Financial\Entity\Invoice\Invoice;
use MpApiClient\Financial\Entity\Invoice\InvoiceList;
use MpApiClient\Financial\Entity\Invoice\ItemIterator;
use MpApiClient\Financial\Entity\Invoice\TaxIterator;
use MpApiClient\Financial\Entity\Invoice\TaxRecap;
use MpApiClient\Financial\Entity\Offset\InvoiceSimple;
use MpApiClient\Financial\Entity\Offset\InvoiceSimpleIterator;
use MpApiClient\Financial\Entity\Offset\Offset;
use MpApiClient\Financial\Entity\Offset\OffsetList;
use MpApiClient\Financial\Entity\Offset\Order;
use MpApiClient\Financial\Entity\Offset\OrderIterator;
use MpApiClient\Financial\FinancialClient;
use MpApiClient\Tests\_support\FunctionalTester;
use Psr\Http\Message\ResponseInterface;

final class FinancialClientCest
{

    private FinancialClient $client;

    public function _before(FunctionalTester $I): void
    {
        // get new client before every test
        $this->client = new FinancialClient($I->getGuzzleClient(), 'financial-client-cest');
    }

    /**
     * @throws MpApiException
     */
    public function testListInvoices(FunctionalTester $I): void
    {
        $invoices = $this->client->listInvoices(null);
        $invoices->enableAutoload();

        $I->assertInstanceOf(InvoiceList::class, $invoices);
        $I->assertPaging($invoices, new Filter());

        foreach ($invoices as $invoice) {
            $this->assertInvoiceClasses($I, $invoice);
            $I->assertEquals('3000', $invoice->getPartner());
        }
    }

    /**
     * @throws MpApiException
     */
    public function testGetInvoice(FunctionalTester $I): void
    {
        // Expected invoice to be returned, with all data types set correctly
        $invoiceArr = Fixtures::get('invoice');

        $invoice = $this->client->getInvoice(Fixtures::get('invoiceId'));
        $this->assertInvoiceClasses($I, $invoice);

        $I->assertEquals($invoiceArr['invoiceNumber'], $invoice->getInvoiceNumber());
        $I->assertEquals($invoiceArr['partner'], $invoice->getPartner());
        $I->assertEquals($invoiceArr['total'], $invoice->getTotal());
        $I->assertEquals($invoiceArr['createdAt'], $invoice->getCreatedAt());
        $I->assertEquals($invoiceArr['deliveryAt'], $invoice->getDeliveryAt());
        $I->assertEquals($invoiceArr['dueDate'], $invoice->getDueDate());
        $I->assertEquals($invoiceArr['originDocumentId'] ?? null, $invoice->getOriginDocumentId());
        $I->assertEquals($invoiceArr['currency'], $invoice->getCurrency());
        $I->assertEquals($invoiceArr['filePath'], $invoice->getFilePath());
        $I->assertEquals($invoiceArr['total'], $invoice->getTotal());
        $I->assertEquals($invoiceArr['note'], $invoice->getNote());
        $I->assertEquals($invoiceArr['purchNoC'], $invoice->getPurchNoC());
        $I->assertEquals($invoiceArr['invoiceType'], $invoice->getInvoiceType());
        $I->assertEquals($invoiceArr['invoiceIndicator'], $invoice->getInvoiceIndicator());
        $I->assertEquals($invoiceArr['documentType'], $invoice->getDocumentType());
        $I->assertEquals($invoiceArr['invoiceTypeTag'], $invoice->getInvoiceTypeTag());

        $I->assertEquals($invoiceArr['supplier']['name'], $invoice->getSupplier()->getName());
        $I->assertEquals($invoiceArr['supplier']['registrationNumber'], $invoice->getSupplier()->getRegistrationNumber());
        $I->assertEquals($invoiceArr['supplier']['taxIdentification'], $invoice->getSupplier()->getTaxIdentification());
        $I->assertEquals($invoiceArr['supplier']['vatNumber'], $invoice->getSupplier()->getVatNumber());
        $I->assertEquals($invoiceArr['supplier']['note'], $invoice->getSupplier()->getNote());

        $I->assertEquals($invoiceArr['supplier']['address']['street'], $invoice->getSupplier()->getAddress()->getStreet());
        $I->assertEquals($invoiceArr['supplier']['address']['city'], $invoice->getSupplier()->getAddress()->getCity());
        $I->assertEquals($invoiceArr['supplier']['address']['zip'], $invoice->getSupplier()->getAddress()->getZip());
        $I->assertEquals($invoiceArr['supplier']['address']['country'], $invoice->getSupplier()->getAddress()->getCountry());

        $I->assertEquals($invoiceArr['supplier']['bank']['iban'], $invoice->getSupplier()->getBank()->getIban());
        $I->assertEquals($invoiceArr['supplier']['bank']['swift'], $invoice->getSupplier()->getBank()->getSwift());
        $I->assertEquals($invoiceArr['supplier']['bank']['bankName'], $invoice->getSupplier()->getBank()->getBankName());
        $I->assertEquals($invoiceArr['supplier']['bank']['bankAccount'], $invoice->getSupplier()->getBank()->getBankAccount());

        $I->assertEquals($invoiceArr['customer']['name'], $invoice->getCustomer()->getName());
        $I->assertEquals($invoiceArr['customer']['registrationNumber'], $invoice->getCustomer()->getRegistrationNumber());
        $I->assertEquals($invoiceArr['customer']['taxIdentification'], $invoice->getCustomer()->getTaxIdentification());
        $I->assertEquals($invoiceArr['customer']['vatNumber'], $invoice->getCustomer()->getVatNumber());
        $I->assertEquals($invoiceArr['customer']['note'], $invoice->getCustomer()->getNote());

        $I->assertEquals($invoiceArr['customer']['address']['street'], $invoice->getCustomer()->getAddress()->getStreet());
        $I->assertEquals($invoiceArr['customer']['address']['city'], $invoice->getCustomer()->getAddress()->getCity());
        $I->assertEquals($invoiceArr['customer']['address']['zip'], $invoice->getCustomer()->getAddress()->getZip());
        $I->assertEquals($invoiceArr['customer']['address']['country'], $invoice->getCustomer()->getAddress()->getCountry());

        $I->assertEquals($invoiceArr['items'][0]['id'], $invoice->getItems()->current()->getId());
        $I->assertEquals($invoiceArr['items'][0]['articleId'], $invoice->getItems()->current()->getArticleId());
        $I->assertEquals($invoiceArr['items'][0]['title'], $invoice->getItems()->current()->getTitle());
        $I->assertEquals($invoiceArr['items'][0]['titleEn'], $invoice->getItems()->current()->getTitleEn());
        $I->assertEquals($invoiceArr['items'][0]['quantity'], $invoice->getItems()->current()->getQuantity());
        $I->assertEquals($invoiceArr['items'][0]['unit'], $invoice->getItems()->current()->getUnit());
        $I->assertEquals($invoiceArr['items'][0]['unitPrice'], $invoice->getItems()->current()->getUnitPrice());
        $I->assertEquals($invoiceArr['items'][0]['vatPrice'], $invoice->getItems()->current()->getVatPrice());
        $I->assertEquals($invoiceArr['items'][0]['priceWithoutVat'], $invoice->getItems()->current()->getPriceWithoutVat());
        $I->assertEquals($invoiceArr['items'][0]['vatRate'], $invoice->getItems()->current()->getVatRate());
        $I->assertEquals($invoiceArr['items'][0]['totalPrice'], $invoice->getItems()->current()->getTotalPrice());
        $I->assertEquals($invoiceArr['items'][0]['orderId'], $invoice->getItems()->current()->getOrderId());

        $I->assertEquals($invoiceArr['taxRecap']['total'], $invoice->getTaxRecap()->getTotal());

        $I->assertEquals($invoiceArr['taxRecap']['taxes'][0]['tax'], $invoice->getTaxRecap()->getTaxes()->current()->getTax());
        $I->assertEquals($invoiceArr['taxRecap']['taxes'][0]['base'], $invoice->getTaxRecap()->getTaxes()->current()->getBase());
        $I->assertEquals($invoiceArr['taxRecap']['taxes'][0]['total'], $invoice->getTaxRecap()->getTaxes()->current()->getTotal());
        $I->assertEquals($invoiceArr['taxRecap']['taxes'][0]['price'], $invoice->getTaxRecap()->getTaxes()->current()->getPrice());
    }

    /**
     * @throws MpApiException
     */
    public function testDownloadInvoice(FunctionalTester $I): void
    {
        $invoiceId = Fixtures::get('invoiceId');

        $response = $this->client->downloadInvoice($invoiceId);
        $I->assertInstanceOf(ResponseInterface::class, $response);
        $I->assertEquals(['application/pdf'], $response->getHeader('content-type'));
        $I->assertEquals(['13'], $response->getHeader('content-length'));
    }

    /**
     * @throws MpApiException
     */
    public function testListOffsets(FunctionalTester $I): void
    {
        $offsets = $this->client->listOffsets(null);
        $offsets->disableAutoload();

        $I->assertInstanceOf(OffsetList::class, $offsets);
        $I->assertPaging($offsets, new Filter());

        foreach ($offsets as $offset) {
            $this->assertOffsetClasses($I, $offset);
            $I->assertEquals('3000', $offset->getPartner());
        }
    }

    /**
     * @throws MpApiException
     */
    public function testGetOffset(FunctionalTester $I): void
    {
        // Expected offset to be returned, with all data types set correctly
        $offsetArr = Fixtures::get('offset');

        $offset = $this->client->getOffset(Fixtures::get('offsetId'));
        $this->assertOffsetClasses($I, $offset);

        $I->assertEquals($offsetArr['partner'], $offset->getPartner());
        $I->assertEquals($offsetArr['documentNumber'], $offset->getDocumentNumber());
        $I->assertEquals($offsetArr['createdAt'], $offset->getCreatedAt());
        $I->assertEquals($offsetArr['dueDate'], $offset->getDueDate());
        $I->assertEquals($offsetArr['currency'], $offset->getCurrency());
        $I->assertEquals($offsetArr['diffPrice'], $offset->getDiffPrice());
        $I->assertEquals($offsetArr['variableSymbol'], $offset->getVariableSymbol());

        $I->assertEquals($offsetArr['supplier']['name'], $offset->getSupplier()->getName());
        $I->assertEquals($offsetArr['supplier']['registrationNumber'], $offset->getSupplier()->getRegistrationNumber());
        $I->assertEquals($offsetArr['supplier']['taxIdentification'], $offset->getSupplier()->getTaxIdentification());
        $I->assertEquals($offsetArr['supplier']['vatNumber'], $offset->getSupplier()->getVatNumber());
        $I->assertEquals($offsetArr['supplier']['note'], $offset->getSupplier()->getNote());

        $I->assertEquals($offsetArr['supplier']['address']['street'], $offset->getSupplier()->getAddress()->getStreet());
        $I->assertEquals($offsetArr['supplier']['address']['city'], $offset->getSupplier()->getAddress()->getCity());
        $I->assertEquals($offsetArr['supplier']['address']['zip'], $offset->getSupplier()->getAddress()->getZip());
        $I->assertEquals($offsetArr['supplier']['address']['country'], $offset->getSupplier()->getAddress()->getCountry());

        $I->assertEquals($offsetArr['customer']['name'], $offset->getCustomer()->getName());
        $I->assertEquals($offsetArr['customer']['registrationNumber'], $offset->getCustomer()->getRegistrationNumber());
        $I->assertEquals($offsetArr['customer']['taxIdentification'], $offset->getCustomer()->getTaxIdentification());
        $I->assertEquals($offsetArr['customer']['vatNumber'], $offset->getCustomer()->getVatNumber());
        $I->assertEquals($offsetArr['customer']['note'], $offset->getCustomer()->getNote());

        $I->assertEquals($offsetArr['customer']['address']['street'], $offset->getCustomer()->getAddress()->getStreet());
        $I->assertEquals($offsetArr['customer']['address']['city'], $offset->getCustomer()->getAddress()->getCity());
        $I->assertEquals($offsetArr['customer']['address']['zip'], $offset->getCustomer()->getAddress()->getZip());
        $I->assertEquals($offsetArr['customer']['address']['country'], $offset->getCustomer()->getAddress()->getCountry());

        $I->assertEquals($offsetArr['invoices'][0]['id'], $offset->getInvoices()->current()->getId());
        $I->assertEquals($offsetArr['invoices'][0]['created'], $offset->getInvoices()->current()->getCreated());
        $I->assertEquals($offsetArr['invoices'][0]['dueDate'], $offset->getInvoices()->current()->getDueDate());
        $I->assertEquals($offsetArr['invoices'][0]['sumPrice'], $offset->getInvoices()->current()->getSumPrice());
        $I->assertEquals($offsetArr['invoices'][0]['offsetPrice'], $offset->getInvoices()->current()->getOffsetPrice());
        $I->assertEquals($offsetArr['invoices'][0]['remainPrice'], $offset->getInvoices()->current()->getRemainPrice());
        $I->assertEquals($offsetArr['invoices'][0]['currency'], $offset->getInvoices()->current()->getCurrency());
        $I->assertEquals($offsetArr['invoices'][0]['purchNoC'], $offset->getInvoices()->current()->getPurchNoC());
        $I->assertEquals($offsetArr['invoices'][0]['note'], $offset->getInvoices()->current()->getNote());
        $I->assertEquals($offsetArr['invoices'][0]['invoiceNumber'], $offset->getInvoices()->current()->getInvoiceNumber());

        $I->assertEquals($offsetArr['orders'][0]['id'], $offset->getOrders()->current()->getId());
        $I->assertEquals($offsetArr['orders'][0]['created'], $offset->getOrders()->current()->getCreated());
        $I->assertEquals($offsetArr['orders'][0]['dueDate'], $offset->getOrders()->current()->getDueDate());
        $I->assertEquals($offsetArr['orders'][0]['sumPrice'], $offset->getOrders()->current()->getSumPrice());
        $I->assertEquals($offsetArr['orders'][0]['offsetPrice'], $offset->getOrders()->current()->getOffsetPrice());
        $I->assertEquals($offsetArr['orders'][0]['remainPrice'], $offset->getOrders()->current()->getRemainPrice());
        $I->assertEquals($offsetArr['orders'][0]['currency'], $offset->getOrders()->current()->getCurrency());

        $I->assertEquals($offsetArr['attachment']['filename'], $offset->getAttachment()->getFilename());
        $I->assertEquals($offsetArr['attachment']['mime'], $offset->getAttachment()->getMime());
    }

    /**
     * @throws MpApiException
     */
    public function testDownloadOffset(FunctionalTester $I): void
    {
        $offsetId = Fixtures::get('offsetId');

        $response = $this->client->downloadOffset($offsetId);
        $I->assertInstanceOf(ResponseInterface::class, $response);
        $I->assertEquals(['application/pdf'], $response->getHeader('content-type'));
        $I->assertEquals(['15723'], $response->getHeader('content-length'));
    }

    /*
     * Assertion helpers
     */

    private function assertInvoiceClasses(FunctionalTester $I, Invoice $invoice): void
    {
        $I->assertInstanceOf(Invoice::class, $invoice);
        $I->assertInstanceOf(ItemIterator::class, $invoice->getItems());

        $I->assertInstanceOf(Supplier::class, $invoice->getSupplier());
        $I->assertInstanceOf(Bank::class, $invoice->getSupplier()->getBank());
        $I->assertInstanceOf(Address::class, $invoice->getSupplier()->getAddress());

        $I->assertInstanceOf(Customer::class, $invoice->getCustomer());
        $I->assertInstanceOf(Address::class, $invoice->getCustomer()->getAddress());

        $I->assertInstanceOf(TaxRecap::class, $invoice->getTaxRecap());
        $I->assertInstanceOf(TaxIterator::class, $invoice->getTaxRecap()->getTaxes());
    }

    private function assertOffsetClasses(FunctionalTester $I, Offset $offset): void
    {
        $I->assertInstanceOf(Offset::class, $offset);

        $I->assertInstanceOf(Supplier::class, $offset->getSupplier());
        $I->assertInstanceOf(Address::class, $offset->getSupplier()->getAddress());

        $I->assertInstanceOf(Customer::class, $offset->getCustomer());
        $I->assertInstanceOf(Address::class, $offset->getCustomer()->getAddress());

        $I->assertInstanceOf(InvoiceSimpleIterator::class, $offset->getInvoices());
        $I->assertInstanceOf(InvoiceSimple::class, $offset->getInvoices()->current());

        $I->assertInstanceOf(OrderIterator::class, $offset->getOrders());
        $I->assertInstanceOf(Order::class, $offset->getOrders()->current());

        $I->assertInstanceOf(Attachment::class, $offset->getAttachment());
    }

}
