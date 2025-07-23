<?php declare(strict_types=1);

namespace MpApiClient\TaricCode;

use MpApiClient\Common\AbstractMpApiClient;
use MpApiClient\Common\Interfaces\TaricCodeClientInterface;
use MpApiClient\TaricCode\Entity\TaricCodeIterator;

final class TaricCodeClient extends AbstractMpApiClient implements TaricCodeClientInterface
{

    private const LIST = '/v1/taric-codes';

    public function list(): TaricCodeIterator
    {
        return TaricCodeIterator::createFromApi($this->sendJson('GET', self::LIST)['data']);
    }

}
