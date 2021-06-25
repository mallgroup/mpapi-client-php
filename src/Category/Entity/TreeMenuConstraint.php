<?php declare(strict_types=1);

namespace MpApiClient\Category\Entity;

use JsonSerializable;
use MpApiClient\Common\Util\InputDataUtil;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class TreeMenuConstraint implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string  $paramId;
    private string  $operator;
    private string  $value1;
    private ?string $value2;
    private int     $class;

    private function __construct(string $paramId, string $operator, string $value1, ?string $value2, int $class)
    {
        $this->paramId  = $paramId;
        $this->operator = $operator;
        $this->value1   = $value1;
        $this->value2   = $value2;
        $this->class    = $class;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (string) $data['paramId'],
            (string) $data['operator'],
            (string) $data['value1'],
            InputDataUtil::getNullableString($data, 'value2'),
            (int) $data['class'],
        );
    }

    public function getParamId(): string
    {
        return $this->paramId;
    }

    public function getOperator(): string
    {
        return $this->operator;
    }

    public function getValue1(): string
    {
        return $this->value1;
    }

    public function getValue2(): ?string
    {
        return $this->value2;
    }

    public function getClass(): int
    {
        return $this->class;
    }

}
