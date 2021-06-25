<?php declare(strict_types=1);

namespace MpApiClient\Label;

use MpApiClient\Common\AbstractMpApiClient;
use MpApiClient\Common\Interfaces\LabelClientInterface;
use MpApiClient\Label\Entity\LabelIterator;

final class LabelClient extends AbstractMpApiClient implements LabelClientInterface
{

    private const LIST = '/v1/labels';

    public function list(): LabelIterator
    {
        return LabelIterator::createFromApi($this->sendJson('GET', self::LIST)['data']);
    }

}
