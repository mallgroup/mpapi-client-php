<?php declare(strict_types=1);

namespace MpApiClient\Category\Entity;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class ParameterValue implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string $value;
    private string $text;

    public function __construct(string $id, string $text)
    {
        $this->value = $id;
        $this->text  = $text;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (string) $data['value'],
            (string) $data['text'],
        );
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getText(): string
    {
        return $this->text;
    }

}
