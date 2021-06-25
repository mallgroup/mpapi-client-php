<?php declare(strict_types=1);

namespace MpApiClient\Order\Entity;

use MpApiClient\Common\Util\AbstractStringEnum;

/**
 * @method static self BLOCKED()
 * @method static self OPEN()
 * @method static self SHIPPING()
 * @method static self SHIPPED()
 * @method static self CANCELLED()
 * @method static self DELIVERED()
 * @method static self LOST()
 * @method static self RETURNED()
 */
final class StatusEnum extends AbstractStringEnum
{

    public const BLOCKED   = 'blocked';
    public const OPEN      = 'open';
    public const SHIPPING  = 'shipping';
    public const SHIPPED   = 'shipped';
    public const CANCELLED = 'cancelled';
    public const DELIVERED = 'delivered';
    public const LOST      = 'lost';
    public const RETURNED  = 'returned';

    public const TYPES = [
        self::BLOCKED,
        self::OPEN,
        self::SHIPPING,
        self::SHIPPED,
        self::CANCELLED,
        self::DELIVERED,
        self::LOST,
        self::RETURNED,
    ];

    public const KEY_NAME = 'status';

}
