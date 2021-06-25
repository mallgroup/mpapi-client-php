<?php declare(strict_types=1);

namespace MpApiClient\Common\Authenticators;

use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Uri;
use MpApiClient\Common\Interfaces\AuthMiddlewareInterface;
use Psr\Http\Message\RequestInterface;

final class ClientIdAuthenticator implements AuthMiddlewareInterface
{

    private const CLIENT_ID_KEY = 'client_id';

    private string $clientId;

    public function __construct(string $clientId)
    {
        $this->clientId = $clientId;
    }

    public function getHandler(): callable
    {
        return Middleware::mapRequest(fn(RequestInterface $request): RequestInterface => $this->authenticateRequest($request));
    }

    public function authenticateRequest(RequestInterface $request): RequestInterface
    {
        return $request->withUri(Uri::withQueryValue($request->getUri(), self::CLIENT_ID_KEY, $this->clientId));
    }

}
