<?php declare(strict_types=1);

namespace MpApiClient\Order\Entity;

use MpApiClient\Common\Util\AbstractStringEnum;

/**
 * @method static self CREATED()
 * @method static self RECEIVED()
 * @method static self CANCELLED()
 * @method static self DELIVERING()
 * @method static self DAMAGED()
 * @method static self RETURNING()
 * @method static self RETURNED()
 * @method static self READY_FOR_PICKUP()
 * @method static self DELIVERED()
 * @method static self LOST()
 */
final class ConsignmentStatusEnum extends AbstractStringEnum
{

    public const CREATED          = 'CREATED';
    public const RECEIVED         = 'RECEIVED';
    public const CANCELLED        = 'CANCELLED';
    public const DELIVERING       = 'DELIVERING';
    public const DAMAGED          = 'DAMAGED';
    public const RETURNING        = 'RETURNING';
    public const RETURNED         = 'RETURNED';
    public const READY_FOR_PICKUP = 'READY_FOR_PICKUP';
    public const DELIVERED        = 'DELIVERED';
    public const LOST             = 'LOST';

    public const TYPES = [
        self::CREATED,
        self::RECEIVED,
        self::CANCELLED,
        self::DELIVERING,
        self::DAMAGED,
        self::RETURNING,
        self::RETURNED,
        self::READY_FOR_PICKUP,
        self::DELIVERED,
        self::LOST,
    ];

    public const KEY_NAME = 'status';

}
