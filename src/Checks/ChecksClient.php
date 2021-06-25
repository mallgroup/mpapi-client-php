<?php declare(strict_types=1);

namespace MpApiClient\Checks;

use MpApiClient\Checks\Entity\ErrorIterator;
use MpApiClient\Common\AbstractMpApiClient;
use MpApiClient\Common\Interfaces\ChecksClientInterface;

final class ChecksClient extends AbstractMpApiClient implements ChecksClientInterface
{

    private const MEDIA      = '/v1/checks/media';
    private const DELIVERIES = '/v1/checks/deliveries';

    public function getMediaErrors(): ErrorIterator
    {
        return ErrorIterator::createFromApi($this->sendJson('GET', self::MEDIA)['errors']);
    }

    public function getDeliveryErrors(): ErrorIterator
    {
        return ErrorIterator::createFromApi($this->sendJson('GET', self::DELIVERIES)['errors']);
    }

}
