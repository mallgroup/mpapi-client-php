<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity\Common;

use MpApiClient\Common\Util\AbstractStringEnum;

/**
 * @method static self SMALL_BOX()
 * @method static self BIG_BOX()
 */
final class PackageSizeEnum extends AbstractStringEnum
{

    public const SMALL_BOX = 'smallbox';
    public const BIG_BOX   = 'bigbox';

    public const TYPES = [
        self::SMALL_BOX,
        self::BIG_BOX,
    ];

    public const KEY_NAME = 'package_size';

}
