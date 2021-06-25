<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity\Common;

use MpApiClient\Common\Util\AbstractStringEnum;

/**
 * @method static self ACTIVE()
 * @method static self INACTIVE()
 * @method static self NOT_FOR_RESALE()
 */
final class StatusEnum extends AbstractStringEnum
{

    public const ACTIVE         = 'A';
    public const INACTIVE       = 'N';
    public const NOT_FOR_RESALE = 'X';

    public const TYPES = [
        self::ACTIVE,
        self::INACTIVE,
        self::NOT_FOR_RESALE,
    ];

    public const KEY_NAME = 'status';

}
