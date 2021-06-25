<?php declare(strict_types=1);

namespace MpApiClient\Order\Entity;

use Exception;
use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Tracking implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string $trackingNumber;
    private string $trackingUrl;

    public function __construct(string $trackingNumber, string $trackingUrl)
    {
        $this->trackingNumber = $trackingNumber;
        $this->trackingUrl    = $trackingUrl;
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
            (string) ($data['tracking_number'] ?? ''),
            (string) ($data['tracking_url'] ?? ''),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function getArrayForApi(): array
    {
        return [
            'tracking_number' => $this->getTrackingNumber(),
            'tracking_url'    => $this->getTrackingUrl(),
        ];
    }

    public function getTrackingNumber(): string
    {
        return $this->trackingNumber;
    }

    public function getTrackingUrl(): string
    {
        return $this->trackingUrl;
    }

}
