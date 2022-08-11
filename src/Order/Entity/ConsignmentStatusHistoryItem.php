<?php declare(strict_types=1);

namespace MpApiClient\Order\Entity;

use DateTime;
use DateTimeInterface;
use Exception;
use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class ConsignmentStatusHistoryItem implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private DateTimeInterface     $date;
    private ConsignmentStatusEnum $code;
    /**
     * @var ConsignmentStatusFlagEnum[]
     */
    private array $flags;

    private string $trackingNumber;

    /**
     * @param DateTimeInterface           $date
     * @param ConsignmentStatusEnum       $code
     * @param ConsignmentStatusFlagEnum[] $flags
     */
    private function __construct(ConsignmentStatusEnum $code, DateTimeInterface $date, array $flags, string $trackingNumber)
    {
        $this->code  = $code;
        $this->date  = $date;
        $this->flags = $flags;
        $this->trackingNumber = $trackingNumber;
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
            new ConsignmentStatusEnum($data[ConsignmentStatusEnum::KEY_NAME]),
            new DateTime($data['date']),
            array_map(fn(string $flag): ConsignmentStatusFlagEnum => new ConsignmentStatusFlagEnum($flag), $data[ConsignmentStatusFlagEnum::KEY_NAME]),
            $data['tracking_number']
        );
    }

    public function getCode(): ConsignmentStatusEnum
    {
        return $this->code;
    }

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @return ConsignmentStatusFlagEnum[]
     */
    public function getFlags(): array
    {
        return $this->flags;
    }

    /**
     * @return string
     */
    public function getTrackingNumber(): string
    {
        return $this->trackingNumber;
    }

}
