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
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     * @param ErrorCode[]    $errorCodes
     */
    final private function __construct(string $message = '', int $code = 0, Throwable $previous = null, array $errorCodes = [])
    {
        parent::__construct($message, $code, $previous);
        $this->errorCodes = $errorCodes;
    }

    /**
     * @param string                           $message
     * @param int                              $code
     * @param GuzzleBadResponseException       $previous
     * @param array<int, array<string, mixed>> $errorCodes
     * @return static
     */
    public static function createFromGuzzle(string $message, int $code, GuzzleBadResponseException $previous, array $errorCodes = []): BadResponseException
    {
        return new static(
            $message,
            $code,
            $previous,
            array_map(fn(array $item): ErrorCode => ErrorCode::createFromApi($item), $errorCodes),
        );
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
