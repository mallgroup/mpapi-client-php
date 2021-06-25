<?php declare(strict_types=1);

namespace MpApiClient\Common\Interfaces;

use MpApiClient\Exception\MpApiException;
use MpApiClient\Label\Entity\LabelIterator;

interface LabelClientInterface
{

    /**
     * @throws MpApiException
     */
    public function list(): LabelIterator;

}
