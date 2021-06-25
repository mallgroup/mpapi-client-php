<?php declare(strict_types=1);

namespace MpApiClient\Category\Entity;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Parameter implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string                 $paramId;
    private string                 $title;
    private string                 $unit;
    private ParameterValueIterator $values;

    private function __construct(string $paramId, string $title, string $unit, ParameterValueIterator $values)
    {
        $this->paramId = $paramId;
        $this->title   = $title;
        $this->unit    = $unit;
        $this->values  = $values;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (string) $data['param_id'],
            (string) $data['title'],
            (string) $data['unit'],
            ParameterValueIterator::createFromApi($data['values']),
        );
    }

    public function getParamId(): string
    {
        return $this->paramId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function hasUnit(): bool
    {
        return $this->unit !== '';
    }

    public function getValues(): ParameterValueIterator
    {
        return $this->values;
    }

}
