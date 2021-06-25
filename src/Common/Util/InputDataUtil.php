<?php declare(strict_types=1);

namespace MpApiClient\Common\Util;

use DateTime;
use DateTimeInterface;
use Exception;

final class InputDataUtil
{

    public const DATE_FORMAT      = 'Y-m-d';
    public const DATE_TIME_FORMAT = 'Y-m-d H:i:s';

    /**
     * @param array<string, mixed> $data
     * @param string               ...$keys
     * @return DateTimeInterface|null
     * @throws Exception
     */
    public static function getNullableDate(array $data, string ...$keys): ?DateTimeInterface
    {
        $value = self::getNullableKey($data, ...$keys);

        return $value === null ? null : new DateTime($value);
    }

    /**
     * @param array<string, mixed> $data
     * @param string               ...$keys
     * @return string|null
     */
    public static function getNullableString(array $data, string ...$keys): ?string
    {
        $value = self::getNullableKey($data, ...$keys);

        return $value === null ? null : (string) $value;
    }

    /**
     * @param array<string, mixed> $data
     * @param string               ...$keys
     * @return int|null
     */
    public static function getNullableInt(array $data, string ...$keys): ?int
    {
        $value = self::getNullableKey($data, ...$keys);

        return $value === null ? null : (int) $value;
    }

    /**
     * @param array<string, mixed> $data
     * @param string               ...$keys
     * @return float|null
     */
    public static function getNullableFloat(array $data, string ...$keys): ?float
    {
        $value = self::getNullableKey($data, ...$keys);

        return $value === null ? null : (float) $value;
    }

    /**
     * Returns content of nested item inside $data[$key1][$key2][$key3] or null if key does not exist
     * @param array<string, mixed> $data
     * @param string               ...$keys
     * @return mixed|null
     */
    private static function getNullableKey(array $data, string ...$keys)
    {
        foreach ($keys as $key) {
            if (!isset($data[$key])) {
                return null;
            }
            $data = $data[$key];
        }

        return $data;
    }

}
