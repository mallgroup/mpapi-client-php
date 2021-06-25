<?php declare(strict_types=1);

namespace MpApiClient\Brand;

use MpApiClient\Brand\Entity\BrandIterator;
use MpApiClient\Common\AbstractMpApiClient;
use MpApiClient\Common\Interfaces\BrandClientInterface;

final class BrandClient extends AbstractMpApiClient implements BrandClientInterface
{

    private const LIST = '/v1/brands';

    public function list(): BrandIterator
    {
        return BrandIterator::createFromApi($this->sendJson('GET', self::LIST)['data']);
    }

}
