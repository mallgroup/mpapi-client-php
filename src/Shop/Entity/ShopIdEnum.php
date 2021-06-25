<?php declare(strict_types=1);

namespace MpApiClient\Shop\Entity;

use MpApiClient\Common\Util\AbstractStringEnum;

/**
 * @method static self CZ10MA()
 * @method static self HU10MA()
 * @method static self HU20MA()
 * @method static self HR10MA()
 * @method static self PL20MA()
 * @method static self SI10SI()
 * @method static self SK10MA()
 */
final class ShopIdEnum extends AbstractStringEnum
{

    public const CZ10MA = 'CZ10MA';
    public const HU10MA = 'HU10MA';
    public const HU20MA = 'HU20MA';
    public const HR10MA = 'HR10MA';
    public const PL20MA = 'PL20MA';
    public const SI10SI = 'SI10SI';
    public const SK10MA = 'SK10MA';

    public const TYPES = [
        self::CZ10MA,
        self::HU10MA,
        self::HU20MA,
        self::HR10MA,
        self::PL20MA,
        self::SI10SI,
        self::SK10MA,
    ];

    public const KEY_NAME = 'shop_id';

}
