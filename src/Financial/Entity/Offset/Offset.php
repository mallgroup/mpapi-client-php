<?php declare(strict_types=1);

namespace MpApiClient\Financial\Entity\Offset;

use DateTimeInterface;
use Exception;
use JsonSerializable;
use MpApiClient\Common\Util\InputDataUtil;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;
use MpApiClient\Financial\Entity\Common\Attachment;
use MpApiClient\Financial\Entity\Common\Customer;
use MpApiClient\Financial\Entity\Common\Supplier;

final class Offset implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string                $partner;
    private string                $documentNumber;
    private ?DateTimeInterface    $createdAt;
    private ?DateTimeInterface    $dueDate;
    private string                $currency;
    private float                 $diffPrice;
    private int                   $variableSymbol;
    private Supplier              $supplier;
    private Customer              $customer;
    private InvoiceSimpleIterator $invoices;
    private OrderIterator         $orders;
    private Attachment            $attachment;

    private function __construct(
        string $partner,
        string $documentNumber,
        ?DateTimeInterface $createdAt,
        ?DateTimeInterface $dueDate,
        string $currency,
        float $diffPrice,
        int $variableSymbol,
        Supplier $supplier,
        Customer $customer,
        InvoiceSimpleIterator $invoices,
        OrderIterator $orders,
        Attachment $attachment
    ) {
        $this->partner        = $partner;
        $this->documentNumber = $documentNumber;
        $this->createdAt      = $createdAt;
        $this->dueDate        = $dueDate;
        $this->currency       = $currency;
        $this->diffPrice      = $diffPrice;
        $this->variableSymbol = $variableSymbol;
        $this->supplier       = $supplier;
        $this->customer       = $customer;
        $this->invoices       = $invoices;
        $this->orders         = $orders;
        $this->attachment     = $attachment;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @throws Exception
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (string) $data['partner'],
            (string) $data['documentNumber'],
            InputDataUtil::getNullableDate($data, 'createdAt'),
            InputDataUtil::getNullableDate($data, 'dueDate'),
            (string) $data['currency'],
            (float) $data['diffPrice'],
            (int) $data['variableSymbol'],
            Supplier::createFromApi($data['supplier']),
            Customer::createFromApi($data['customer']),
            InvoiceSimpleIterator::createFromApi($data['invoices']),
            OrderIterator::createFromApi($data['orders']),
            Attachment::createFromApi($data['attachment']),
        );
    }

    public function getPartner(): string
    {
        return $this->partner;
    }

    public function getDocumentNumber(): string
    {
        return $this->documentNumber;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getDueDate(): ?DateTimeInterface
    {
        return $this->dueDate;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getDiffPrice(): float
    {
        return $this->diffPrice;
    }

    public function getVariableSymbol(): int
    {
        return $this->variableSymbol;
    }

    public function getSupplier(): Supplier
    {
        return $this->supplier;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function getInvoices(): InvoiceSimpleIterator
    {
        return $this->invoices;
    }

    public function getOrders(): OrderIterator
    {
        return $this->orders;
    }

    public function getAttachment(): Attachment
    {
        return $this->attachment;
    }

}
