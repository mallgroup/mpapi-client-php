<?php declare(strict_types=1);

namespace MpApiClient\Checks\Entity;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Error implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string $code;
    private string $attribute;
    private string $value;
    private string $msg;
    /**
     * @var string[]
     */
    private array $articles;

    /**
     * @param string   $code
     * @param string   $attribute
     * @param string   $value
     * @param string   $msg
     * @param string[] $articles
     */
    private function __construct(string $code, string $attribute, string $value, string $msg, array $articles)
    {
        $this->code      = $code;
        $this->attribute = $attribute;
        $this->value     = $value;
        $this->msg       = $msg;
        $this->articles  = $articles;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (string) $data['code'],
            (string) $data['attribute'],
            (string) $data['value'],
            (string) $data['msg'],
            $data['articles'] ?? [],
        );
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getAttribute(): string
    {
        return $this->attribute;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getMsg(): string
    {
        return $this->msg;
    }

    /**
     * @return string[]
     */
    public function getArticles(): array
    {
        return $this->articles;
    }

}
