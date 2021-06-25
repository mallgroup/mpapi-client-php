<?php declare(strict_types=1);

namespace MpApiClient\Common\Interfaces;

use Psr\Http\Message\RequestInterface;

interface AuthMiddlewareInterface
{

    public function getHandler(): callable;

    public function authenticateRequest(RequestInterface $request): RequestInterface;

}
