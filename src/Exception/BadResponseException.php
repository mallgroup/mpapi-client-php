<?php declare(strict_types=1);

namespace MpApiClient\Exception;

use GuzzleHttp\Exception\BadResponseException as GuzzleBadResponseException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class BadResponseException extends MpApiException
{

    /**
     * @var ErrorCode[]
     */
    private array $errorCodes;

    /**
     * @var array<string, mixed>
     */
    private array $body;

    /**
     * @param string               $message
     * @param int                  $code
     * @param Throwable|null       $previous
     * @param array<string, mixed> $body
     * @param ErrorCode[]          $errorCodes
     */
    final private function __construct(string $message = '', int $code = 0, Throwable $previous = null, array $body = [], array $errorCodes = [])
    {
        parent::__construct($message, $code, $previous);
        $this->body       = $body;
        $this->errorCodes = $errorCodes;
    }

    /**
     * @param string                     $message
     * @param int                        $code
     * @param GuzzleBadResponseException $previous
     * @param array<string, mixed>       $body
     * @return BadResponseException
     *
     * @internal
     */
    public static function createFromGuzzle(string $message, int $code, GuzzleBadResponseException $previous, array $body = []): BadResponseException
    {
        $errorCodes = array_map(fn(array $item): ErrorCode => ErrorCode::createFromApi($item), $body['errorCodes'] ?? []);
        if ($errorCodes === []) {
            return new static($message, $code, $previous, $body);
        }

        switch ($errorCodes[0]->getCode()) {
            case PriceProtectionException::ERROR_CODE:
                return new PriceProtectionException($message, $code, $previous, $body, $errorCodes);
            default:
                return new static($message, $code, $previous, $body, $errorCodes);
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @return ErrorCode[]
     */
    public function getErrorCodes(): array
    {
        return $this->errorCodes;
    }

    public function getRequest(): RequestInterface
    {
        /** @var GuzzleBadResponseException $previous */
        $previous = $this->getPrevious();

        return $previous->getRequest();
    }

    public function getResponse(): ResponseInterface
    {
        /** @var GuzzleBadResponseException $previous */
        $previous = $this->getPrevious();

        return $previous->getResponse();
    }

}
