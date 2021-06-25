<?php declare(strict_types=1);

namespace MpApiClient\Common\Interfaces;

use MpApiClient\Checks\Entity\ErrorIterator;
use MpApiClient\Exception\MpApiException;

interface ChecksClientInterface
{

    /**
     * @throws MpApiException
     */
    public function getMediaErrors(): ErrorIterator;

    /**
     * @throws MpApiException
     */
    public function getDeliveryErrors(): ErrorIterator;

}
