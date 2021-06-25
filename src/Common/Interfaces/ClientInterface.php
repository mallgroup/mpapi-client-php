<?php declare(strict_types=1);

namespace MpApiClient\Common\Interfaces;

use GuzzleHttp\ClientInterface as GuzzleClientInterface;

interface ClientInterface
{

    public function __construct(GuzzleClientInterface $client, string $appTag);

}
