<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity\Common;

use DateTime;
use DateTimeInterface;
use Exception;
use JsonSerializable;
use MpApiClient\Common\Util\InputDataUtil;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

/** @deprecated  */
final class Promotion implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private float             $price;
    private DateTimeInterface $from;
    private DateTimeInterface $to;
    private string            $source;

    public function __construct(float $price, DateTimeInterface $from, DateTimeInterface $to, string $source = '')
    {
        $this->price  = $price;
        $this->from   = $from;
        $this->to     = $to;
        $this->source = $source;
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
            (float) $data['price'],
            new DateTime($data['from']),
            new DateTime($data['to']),
            (string) $data['source'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function getArrayForApi(): array
    {
        return [
            'price' => $this->getPrice(),
            'from'  => $this->getFrom()->format(InputDataUtil::DATE_TIME_FORMAT),
            'to'    => $this->getTo()->format(InputDataUtil::DATE_TIME_FORMAT),
        ];
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getFrom(): DateTimeInterface
    {
        return $this->from;
    }

    public function setFrom(DateTimeInterface $from): void
    {
        $this->from = $from;
    }

    public function getTo(): DateTimeInterface
    {
        return $this->to;
    }

    public function setTo(DateTimeInterface $to): void
    {
        $this->to = $to;
    }

    public function getSource(): string
    {
        return $this->source;
    }

}
