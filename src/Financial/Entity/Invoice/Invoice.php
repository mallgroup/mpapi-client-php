<?php declare(strict_types=1);

namespace MpApiClient\Financial\Entity\Invoice;

use DateTimeInterface;
use Exception;
use JsonSerializable;
use MpApiClient\Common\Util\InputDataUtil;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;
use MpApiClient\Financial\Entity\Common\Customer;

final class Invoice implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private int                $invoiceNumber;
    private string             $partner;
    private ?DateTimeInterface $createdAt;
    private ?DateTimeInterface $deliveryAt;
    private ?DateTimeInterface $dueDate;
    private ?string            $originDocumentId;
    private string             $currency;
    private Supplier           $supplier;
    private Customer           $customer;
    private ItemIterator       $items;
    private string             $filePath;
    private float              $total;
    private TaxRecap           $taxRecap;
    private string             $note;
    private string             $purchNoC;
    private string             $invoiceType;
    private string             $invoiceIndicator;
    private string             $documentType;
    private string             $invoiceTypeTag;

    private function __construct(
        int $invoiceNumber,
        string $partner,
        ?DateTimeInterface $createdAt,
        ?DateTimeInterface $deliveryAt,
        ?DateTimeInterface $dueDate,
        ?string $originDocumentId,
        string $currency,
        Supplier $supplier,
        Customer $customer,
        ItemIterator $items,
        string $filePath,
        float $total,
        TaxRecap $taxRecap,
        string $note,
        string $purchNoC,
        string $invoiceType,
        string $invoiceIndicator,
        string $documentType,
        string $invoiceTypeTag
    ) {
        $this->invoiceNumber    = $invoiceNumber;
        $this->partner          = $partner;
        $this->createdAt        = $createdAt;
        $this->deliveryAt       = $deliveryAt;
        $this->dueDate          = $dueDate;
        $this->originDocumentId = $originDocumentId;
        $this->currency         = $currency;
        $this->supplier         = $supplier;
        $this->customer         = $customer;
        $this->items            = $items;
        $this->filePath         = $filePath;
        $this->total            = $total;
        $this->taxRecap         = $taxRecap;
        $this->note             = $note;
        $this->purchNoC         = $purchNoC;
        $this->invoiceType      = $invoiceType;
        $this->invoiceIndicator = $invoiceIndicator;
        $this->documentType     = $documentType;
        $this->invoiceTypeTag   = $invoiceTypeTag;
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
            (int) $data['invoiceNumber'],
            (string) $data['partner'],
            InputDataUtil::getNullableDate($data, 'createdAt'),
            InputDataUtil::getNullableDate($data, 'deliveryAt'),
            InputDataUtil::getNullableDate($data, 'dueDate'),
            InputDataUtil::getNullableString($data, 'originDocumentId'),
            (string) $data['currency'],
            Supplier::createFromApi($data['supplier']),
            Customer::createFromApi($data['customer']),
            ItemIterator::createFromApi($data['items']),
            (string) $data['filePath'],
            (float) $data['total'],
            TaxRecap::createFromApi($data['taxRecap']),
            (string) $data['note'],
            (string) $data['purchNoC'],
            (string) $data['invoiceType'],
            (string) $data['invoiceIndicator'],
            (string) $data['documentType'],
            (string) $data['invoiceTypeTag'],
        );
    }

    public function getInvoiceNumber(): int
    {
        return $this->invoiceNumber;
    }

    public function getPartner(): string
    {
        return $this->partner;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getDeliveryAt(): ?DateTimeInterface
    {
        return $this->deliveryAt;
    }

    public function getDueDate(): ?DateTimeInterface
    {
        return $this->dueDate;
    }

    public function getOriginDocumentId(): ?string
    {
        return $this->originDocumentId;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getSupplier(): Supplier
    {
        return $this->supplier;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function getItems(): ItemIterator
    {
        return $this->items;
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getTaxRecap(): TaxRecap
    {
        return $this->taxRecap;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function getPurchNoC(): string
    {
        return $this->purchNoC;
    }

    public function getInvoiceType(): string
    {
        return $this->invoiceType;
    }

    public function getInvoiceIndicator(): string
    {
        return $this->invoiceIndicator;
    }

    public function getDocumentType(): string
    {
        return $this->documentType;
    }

    public function getInvoiceTypeTag(): string
    {
        return $this->invoiceTypeTag;
    }

}
