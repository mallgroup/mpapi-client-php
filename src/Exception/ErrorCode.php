<?php declare(strict_types=1);

namespace MpApiClient\Exception;

final class ErrorCode
{

    private string $message;
    private string $code;
    /**
     * @var mixed[]
     */
    private array $attributes;

    /**
     * ErrorCode constructor.
     * @param string  $message
     * @param string  $code
     * @param mixed[] $attributes
     */
    private function __construct(string $message, string $code, array $attributes)
    {
        $this->message    = $message;
        $this->code       = $code;
        $this->attributes = $attributes;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (string) $data['message'],
            (string) $data['errorCode'],
            $data['errorAttributes'],
        );
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return mixed[]
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

}
