<?php declare(strict_types=1);

namespace MpApiClient\Shop;

use MpApiClient\Common\AbstractMpApiClient;
use MpApiClient\Common\Interfaces\ShopClientInterface;
use MpApiClient\Shop\Entity\ShopIterator;

final class ShopClient extends AbstractMpApiClient implements ShopClientInterface
{

    private const LIST = '/v1/shops';

    public function list(): ShopIterator
    {
        return ShopIterator::createFromApi($this->sendJson('GET', self::LIST)['data']);
    }

}
