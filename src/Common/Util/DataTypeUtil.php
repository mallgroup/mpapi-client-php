<?php declare(strict_types=1);

namespace MpApiClient\Common\Util;

use MpApiClient\Exception\IncorrectDataTypeException;

final class DataTypeUtil
{

    private const INVALID_TYPE_ERR = 'Provided array should only contain elements of [%s] type, but [%s] type was found.';

    /**
     * @param array<int, mixed> $data
     * @throws IncorrectDataTypeException
     */
    public static function validateStringArray(array $data): void
    {
        foreach ($data as $item) {
            if (!is_string($item)) {
                throw new IncorrectDataTypeException(sprintf(self::INVALID_TYPE_ERR, 'string', gettype($item)));
            }
        }
    }

    /**
     * @param array<int, mixed> $data
     * @throws IncorrectDataTypeException
     */
    public static function validateIntArray(array $data): void
    {
        foreach ($data as $item) {
            if (!is_int($item)) {
                throw new IncorrectDataTypeException(sprintf(self::INVALID_TYPE_ERR, 'integer', gettype($item)));
            }
        }
    }

    /**
     * @param array<int, mixed> $data
     * @throws IncorrectDataTypeException
     */
    public static function validateFloatArray(array $data): void
    {
        foreach ($data as $item) {
            if (!is_float($item)) {
                throw new IncorrectDataTypeException(sprintf(self::INVALID_TYPE_ERR, 'float', gettype($item)));
            }
        }
    }

}
