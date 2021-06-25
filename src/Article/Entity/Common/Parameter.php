<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity\Common;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Parameter implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string $id;
    /**
     * @var string[]
     */
    private array $values;

    /**
     * @param string   $id
     * @param string[] $values
     */
    private function __construct(string $id, array $values)
    {
        $this->id     = $id;
        $this->values = $values;
    }

    public static function create(string $id, string ...$values): self
    {
        return new self($id, $values);
    }

    /**
     * @param string[] $values
     *
     * @internal
     */
    public static function createFromApi(string $id, array $values): self
    {
        return new self($id, $values);
    }

    /**
     * @return array<string, string[]>
     */
    public function getArrayForApi(): array
    {
        return [$this->getId() => $this->getValues()];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string[]
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @param string ...$values
     */
    public function setValues(string ...$values): void
    {
        $this->values = $values;
    }

}
