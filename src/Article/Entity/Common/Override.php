<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity\Common;

use DateTime;
use DateTimeInterface;
use Exception;
use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Override implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string            $type;
    private string            $value;
    private DateTimeInterface $validFrom;
    private DateTimeInterface $validTo;

    private function __construct(string $type, string $value, DateTimeInterface $validFrom, DateTimeInterface $validTo)
    {
        $this->type      = $type;
        $this->value     = $value;
        $this->validFrom = $validFrom;
        $this->validTo   = $validTo;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @throws Exception
     * @internal
     */
    public static function createFromApi(string $type, array $data): self
    {
        return new self(
            $type,
            (string) $data['value'],
            new DateTime($data['valid_from']),
            new DateTime($data['valid_to']),
        );
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): string
    {
        return $this->value;
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
