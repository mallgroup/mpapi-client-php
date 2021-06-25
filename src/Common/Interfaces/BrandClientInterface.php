<?php declare(strict_types=1);

namespace MpApiClient\Common\Interfaces;

use MpApiClient\Brand\Entity\BrandIterator;
use MpApiClient\Exception\MpApiException;

interface BrandClientInterface
{

    /**
     * @throws MpApiException
     */
    public function list(): BrandIterator;

}
