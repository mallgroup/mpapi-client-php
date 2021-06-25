<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity;

use MpApiClient\Common\Util\AbstractStringEnum;

/**
 * @method static self LIVE()
 * @method static self DRAFT()
 */
final class ProductStageEnum extends AbstractStringEnum
{

    public const LIVE  = 'live';
    public const DRAFT = 'draft';

    public const TYPES = [
        self::LIVE,
        self::DRAFT,
    ];

    public const KEY_NAME = 'stage';

}
