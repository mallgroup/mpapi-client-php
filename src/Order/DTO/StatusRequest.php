<?php declare(strict_types=1);

namespace MpApiClient\Order\DTO;

use DateTimeInterface;
use MpApiClient\Common\Util\InputDataUtil;
use MpApiClient\Order\Entity\StatusEnum;

final class StatusRequest
{

    private StatusEnum         $status;
    private ?bool              $confirmed            = null;
    private ?string            $trackingNumber       = null;
    private ?string            $trackingUrl          = null;
    private ?DateTimeInterface $deliveredAt          = null;
    private ?DateTimeInterface $firstDeliveryAttempt = null;

    public function __construct(StatusEnum $status)
    {
        $this->status = $status;
    }

    /**
     * @return array<string, mixed>
     */
    public function getArrayForApi(): array
    {
        $out = [
            'status' => $this->getStatus()->getValue(),
        ];

        if ($this->confirmed !== null) {
            $out['confirmed'] = $this->confirmed;
        }

        if ($this->trackingUrl !== null) {
            $out['tracking_url'] = $this->trackingUrl;
        }

        if ($this->trackingNumber !== null) {
            $out['tracking_number'] = $this->trackingNumber;
        }

        if ($this->deliveredAt !== null) {
            $out['delivered_at'] = $this->deliveredAt->format(InputDataUtil::DATE_TIME_FORMAT);
        }

        if ($this->firstDeliveryAttempt !== null) {
            $out['first_delivery_attempt'] = $this->firstDeliveryAttempt->format(InputDataUtil::DATE_TIME_FORMAT);
        }

        return $out;
    }

    public function getStatus(): StatusEnum
    {
        return $this->status;
    }

    public function getConfirmed(): ?bool
    {
        return $this->confirmed;
    }

    public function setConfirmed(bool $confirmed): void
    {
        $this->confirmed = $confirmed;
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

    public function getFirstDeliveryAttempt(): ?DateTimeInterface
    {
        return $this->firstDeliveryAttempt;
    }

    public function setTracking(string $trackingNumber, string $trackingUrl): void
    {
        $this->trackingNumber = $trackingNumber;
        $this->trackingUrl    = $trackingUrl;
    }

    public function setDelivery(DateTimeInterface $deliveredAt, DateTimeInterface $firstDeliveryAttempt): void
    {
        $this->deliveredAt          = $deliveredAt;
        $this->firstDeliveryAttempt = $firstDeliveryAttempt;
    }

}
