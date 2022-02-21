<?php declare(strict_types=1);

namespace MpApiClient\Exception;

use LogicException;

final class PriceProtectionException extends BadResponseException
{

    public const ERROR_CODE = 'PRICE_PROTECTION_ERROR';

    /**
     * @throws LogicException
     */
    public function getForceToken(): string
    {
        if (!isset($this->getBody()['data']['data']['forceToken'])) {
            throw new LogicException('forceToken not present in response');
        }

        return (string) $this->getBody()['data']['data']['forceToken'];
    }

}
