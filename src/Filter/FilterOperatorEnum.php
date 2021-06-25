<?php declare(strict_types=1);

namespace MpApiClient\Filter;

use MpApiClient\Common\Util\AbstractStringEnum;

/**
 * @method static static EMPTY()
 * @method static static EQUAL()
 * @method static static NOT_EQUAL()
 * @method static static GREATER_THAN()
 * @method static static GREATER_OR_EQUAL()
 * @method static static LESS_THAN()
 * @method static static LESS_OR_EQUAL()
 * @method static static BETWEEN()
 * @method static static IN()
 * @method static static NOT_IN()
 */
final class FilterOperatorEnum extends AbstractStringEnum
{

    public const EMPTY            = '';
    public const EQUAL            = 'eq';
    public const NOT_EQUAL        = 'ne';
    public const GREATER_THAN     = 'gt';
    public const GREATER_OR_EQUAL = 'ge';
    public const LESS_THAN        = 'lt';
    public const LESS_OR_EQUAL    = 'le';
    public const BETWEEN          = 'bt';
    public const IN               = 'in';
    public const NOT_IN           = 'nin';

    public const TYPES = [
        self::EMPTY,
        self::EQUAL,
        self::NOT_EQUAL,
        self::GREATER_THAN,
        self::GREATER_OR_EQUAL,
        self::LESS_THAN,
        self::LESS_OR_EQUAL,
        self::BETWEEN,
        self::IN,
        self::NOT_IN,
    ];

}
