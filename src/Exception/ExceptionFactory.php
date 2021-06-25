<?php declare(strict_types=1);

namespace MpApiClient\Exception;

use GuzzleHttp\Exception\BadResponseException as GuzzleBadResponseException;
use GuzzleHttp\Exception\GuzzleException;

final class ExceptionFactory
{

    public static function fromGuzzleException(GuzzleException $e): MpApiException
    {
        if ($e instanceof GuzzleBadResponseException) {
            return self::fromGuzzleBadResponse($e);
        }

        /** @psalm-suppress InvalidScalarArgument - https://github.com/vimeo/psalm/issues/4295 */
        return new MpApiException($e->getMessage(), $e->getCode(), $e);
    }

    public static function fromGuzzleBadResponse(GuzzleBadResponseException $e): MpApiException
    {
        if ($e->getResponse()->getBody()->isSeekable()) {
            $e->getResponse()->getBody()->rewind();
        }

        $body    = json_decode($e->getResponse()->getBody()->getContents(), true);
        $message = $body['result']['message'] ?? $e->getMessage();
        $code    = $e->getCode();

        switch ($code) {
            case 401:
                return UnauthorizedException::createFromGuzzle($message, $code, $e);
            case 403:
                return ForbiddenException::createFromGuzzle($message, $code, $e);
            case 404:
                return NotFoundException::createFromGuzzle($message, $code, $e);
            case 429:
                return TooManyRequestsException::createFromGuzzle($message, $code, $e);
            default:
                /** @psalm-suppress PossiblyInvalidArgument - https://github.com/vimeo/psalm/issues/4295 */
                return BadResponseException::createFromGuzzle($message, $code, $e, $body['errorCodes'] ?? []);
        }
    }

}
