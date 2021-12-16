<?php declare(strict_types=1);

namespace MpApiClient\Order\Entity;

use MpApiClient\Common\Util\AbstractStringEnum;

/**
 * @method static self DAMAGED()
 * @method static self LOST()
 */
final class ConsignmentStatusFlagEnum extends AbstractStringEnum
{

    public const DAMAGED = 'damaged';
    public const LOST    = 'lost';

    public const TYPES = [
        self::DAMAGED,
        self::LOST,
    ];

    public const KEY_NAME = 'flags';

}
