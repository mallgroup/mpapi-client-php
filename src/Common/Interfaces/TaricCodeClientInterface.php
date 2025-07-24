<?php declare(strict_types=1);

namespace MpApiClient\Common\Interfaces;

use MpApiClient\Exception\MpApiException;
use MpApiClient\TaricCode\Entity\TaricCodeIterator;

interface TaricCodeClientInterface
{

    /**
     * @throws MpApiException
     */
    public function list(): TaricCodeIterator;

}
