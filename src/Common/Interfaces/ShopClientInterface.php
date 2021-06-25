<?php declare(strict_types=1);

namespace MpApiClient\Common\Interfaces;

use MpApiClient\Exception\MpApiException;
use MpApiClient\Shop\Entity\ShopIterator;

interface ShopClientInterface
{

    /**
     * @throws MpApiException
     */
    public function list(): ShopIterator;

}
