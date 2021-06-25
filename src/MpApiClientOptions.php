<?php declare(strict_types=1);

namespace MpApiClient;

use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use MpApiClient\Common\Interfaces\AuthMiddlewareInterface;

final class MpApiClientOptions
{

    private string                  $baseUri        = 'https://mpapi.mallgroup.com';
    private int                     $timeout        = 10;
    private bool                    $allowRedirects = true;
    private AuthMiddlewareInterface $authMiddleware;
    private HandlerStack            $handlerStack;

    public function __construct(AuthMiddlewareInterface $authMiddleware)
    {
        $this->authMiddleware = $authMiddleware;

        $handler = new CurlHandler();
        $stack   = HandlerStack::create($handler);
        $stack->push($authMiddleware->getHandler());
        $this->handlerStack = $stack;
    }

    public function getAuthMiddleware(): AuthMiddlewareInterface
    {
        return $this->authMiddleware;
    }

    public function setAuthMiddleware(AuthMiddlewareInterface $authMiddleware): void
    {
        $this->authMiddleware = $authMiddleware;
    }

    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    public function setBaseUri(string $baseUri): void
    {
        $this->baseUri = $baseUri;
    }

    public function getTimeout(): int
    {
        return $this->timeout;
    }

    public function setTimeout(int $timeout): void
    {
        $this->timeout = $timeout;
    }

    public function getAllowRedirects(): bool
    {
        return $this->allowRedirects;
    }

    public function setAllowRedirects(bool $allowRedirects): void
    {
        $this->allowRedirects = $allowRedirects;
    }

    public function getHandlerStack(): HandlerStack
    {
        return $this->handlerStack;
    }

    public function setHandlerStack(HandlerStack $handlerStack): void
    {
        $this->handlerStack = $handlerStack;
    }

    /**
     * @return array<string, mixed>
     */
    public function getGuzzleOptionsArray(): array
    {
        return [
            'base_uri'        => $this->getBaseUri(),
            'timeout'         => $this->getTimeout(),
            'allow_redirects' => $this->getAllowRedirects(),
            'handler'         => $this->getHandlerStack(),
        ];
    }

}
