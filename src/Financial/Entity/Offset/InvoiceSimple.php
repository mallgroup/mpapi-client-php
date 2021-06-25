<?php declare(strict_types=1);

namespace MpApiClient\Financial\Entity\Offset;

use DateTimeInterface;
use Exception;
use JsonSerializable;
use MpApiClient\Common\Util\InputDataUtil;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class InvoiceSimple implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private int                $id;
    private ?DateTimeInterface $created;
    private ?DateTimeInterface $dueDate;
    private float              $sumPrice;
    private float              $offsetPrice;
    private float              $remainPrice;
    private string             $currency;
    private string             $purchNoC;
    private string             $note;
    private string             $invoiceNumber;

    private function __construct(
        int $id,
        ?DateTimeInterface $created,
        ?DateTimeInterface $dueDate,
        float $sumPrice,
        float $offsetPrice,
        float $remainPrice,
        string $currency,
        string $purchNoC,
        string $note,
        string $invoiceNumber
    ) {
        $this->id            = $id;
        $this->created       = $created;
        $this->dueDate       = $dueDate;
        $this->sumPrice      = $sumPrice;
        $this->offsetPrice   = $offsetPrice;
        $this->remainPrice   = $remainPrice;
        $this->currency      = $currency;
        $this->purchNoC      = $purchNoC;
        $this->note          = $note;
        $this->invoiceNumber = $invoiceNumber;
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
            (int) $data['id'],
            InputDataUtil::getNullableDate($data, 'created'),
            InputDataUtil::getNullableDate($data, 'dueDate'),
            (float) $data['sumPrice'],
            (float) $data['offsetPrice'],
            (float) $data['remainPrice'],
            (string) $data['currency'],
            (string) $data['purchNoC'],
            (string) $data['note'],
            (string) $data['invoiceNumber'],
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreated(): ?DateTimeInterface
    {
        return $this->created;
    }

    public function getDueDate(): ?DateTimeInterface
    {
        return $this->dueDate;
    }

    public function getSumPrice(): float
    {
        return $this->sumPrice;
    }

    public function getOffsetPrice(): float
    {
        return $this->offsetPrice;
    }

    public function getRemainPrice(): float
    {
        return $this->remainPrice;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getPurchNoC(): string
    {
        return $this->purchNoC;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

}
