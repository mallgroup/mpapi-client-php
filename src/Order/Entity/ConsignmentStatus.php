<?php declare(strict_types=1);

namespace MpApiClient\Order\Entity;

use DateTime;
use DateTimeInterface;
use Exception;
use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class ConsignmentStatus implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private int               $id;
    private string            $name;
    private DateTimeInterface $date;

    private function __construct(int $id, string $name, DateTimeInterface $date)
    {
        $this->id   = $id;
        $this->name = $name;
        $this->date = $date;
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
            (string) $data['name'],
            new DateTime($data['date']),
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

}
