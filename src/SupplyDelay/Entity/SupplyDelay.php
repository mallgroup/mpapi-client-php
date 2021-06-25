<?php declare(strict_types=1);

namespace MpApiClient\SupplyDelay\Entity;

use DateTime;
use DateTimeInterface;
use Exception;
use JsonSerializable;
use MpApiClient\Common\Util\InputDataUtil;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class SupplyDelay implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private DateTimeInterface $validFrom;
    private DateTimeInterface $validTo;

    public function __construct(DateTimeInterface $validFrom, DateTimeInterface $validTo)
    {
        $this->validFrom = $validFrom;
        $this->validTo   = $validTo;
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
            new DateTime($data['valid_from']),
            new DateTime($data['valid_to']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function getArrayForApi(): array
    {
        return [
            'valid_from' => $this->getValidFrom()->format(InputDataUtil::DATE_TIME_FORMAT),
            'valid_to'   => $this->getValidTo()->format(InputDataUtil::DATE_TIME_FORMAT),
        ];
    }

    public function getValidFrom(): DateTimeInterface
    {
        return $this->validFrom;
    }

    public function getValidTo(): DateTimeInterface
    {
        return $this->validTo;
    }

}
