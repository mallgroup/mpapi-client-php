<?php declare(strict_types=1);

namespace MpApiClient\Order\Entity;

use DateTimeInterface;
use Exception;
use JsonSerializable;
use MpApiClient\Common\Util\InputDataUtil;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class BasicOrder implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private int                $id;
    private int                $purchaseId;
    private int                $customerId;
    private string             $customer;
    private float              $cod;
    private string             $paymentType;
    private ?DateTimeInterface $shipDate;
    private ?string            $trackingNumber;
    private ?string            $trackingUrl;
    private ?DateTimeInterface $deliveredAt;
    private StatusEnum         $status;
    private bool               $confirmed;
    private bool               $test;
    private bool               $mdp;

    private function __construct(
        int $id,
        int $purchaseId,
        int $customerId,
        string $customer,
        float $cod,
        string $paymentType,
        ?DateTimeInterface $shipDate,
        ?string $trackingNumber,
        ?string $trackingUrl,
        ?DateTimeInterface $deliveredAt,
        StatusEnum $status,
        bool $confirmed,
        bool $test,
        bool $mdp
    ) {
        $this->id             = $id;
        $this->purchaseId     = $purchaseId;
        $this->customerId     = $customerId;
        $this->customer       = $customer;
        $this->cod            = $cod;
        $this->paymentType    = $paymentType;
        $this->shipDate       = $shipDate;
        $this->trackingNumber = $trackingNumber;
        $this->trackingUrl    = $trackingUrl;
        $this->deliveredAt    = $deliveredAt;
        $this->status         = $status;
        $this->confirmed      = $confirmed;
        $this->test           = $test;
        $this->mdp            = $mdp;
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
            (int) $data['purchase_id'],
            (int) $data['customer_id'],
            (string) $data['customer'],
            (float) $data['cod'],
            (string) $data['payment_type'],
            InputDataUtil::getNullableDate($data, 'ship_date'),
            InputDataUtil::getNullableString($data, 'tracking_number'),
            InputDataUtil::getNullableString($data, 'tracking_url'),
            InputDataUtil::getNullableDate($data, 'delivered_at'),
            new StatusEnum((string) $data[StatusEnum::KEY_NAME]),
            (bool) $data['confirmed'],
            (bool) $data['test'],
            (bool) $data['mdp'],
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPurchaseId(): int
    {
        return $this->purchaseId;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function getCustomer(): string
    {
        return $this->customer;
    }

    public function getCod(): float
    {
        return $this->cod;
    }

    public function getPaymentType(): string
    {
        return $this->paymentType;
    }

    public function getShipDate(): ?DateTimeInterface
    {
        return $this->shipDate;
    }

    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    public function getTrackingUrl(): ?string
    {
        return $this->trackingUrl;
    }

    public function getDeliveredAt(): ?DateTimeInterface
    {
        return $this->deliveredAt;
    }

    public function getStatus(): StatusEnum
    {
        return $this->status;
    }

    public function isConfirmed(): bool
    {
        return $this->confirmed;
    }

    public function isTest(): bool
    {
        return $this->test;
    }

    public function isMdp(): bool
    {
        return $this->mdp;
    }

}
