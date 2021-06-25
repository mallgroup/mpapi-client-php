<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity\Common;

use DateTime;
use DateTimeInterface;
use Exception;
use JsonSerializable;
use MpApiClient\Common\Util\InputDataUtil;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Label implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string            $label;
    private DateTimeInterface $from;
    private DateTimeInterface $to;

    public function __construct(string $label, DateTimeInterface $from, DateTimeInterface $to)
    {
        $this->label = $label;
        $this->from  = $from;
        $this->to    = $to;
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
            (string) $data['label'],
            new DateTime($data['from']),
            new DateTime($data['to']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function getArrayForApi(): array
    {
        return [
            'label' => $this->getLabel(),
            'from'  => $this->getFrom()->format(InputDataUtil::DATE_TIME_FORMAT),
            'to'    => $this->getTo()->format(InputDataUtil::DATE_TIME_FORMAT),
        ];
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
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

}
