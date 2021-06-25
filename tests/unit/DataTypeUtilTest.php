<?php declare(strict_types=1);

namespace MpApiClient\Tests\unit;

use Codeception\Test\Unit;
use MpApiClient\Common\Util\DataTypeUtil;
use MpApiClient\Exception\IncorrectDataTypeException;

final class DataTypeUtilTest extends Unit
{

    private const INVALID_TYPE_ERR = 'Provided array should only contain elements of [%s] type, but [%s] type was found.';

    /**
     * @dataProvider stringArrayProvider
     *
     * @param array<int, mixed> $input
     * @param string|null       $exceptionMsg
     * @throws IncorrectDataTypeException
     */
    public function testValidateStringArray(array $input, ?string $exceptionMsg): void
    {
        if ($exceptionMsg !== null) {
            self::expectExceptionMessage($exceptionMsg);
        } else {
            self::expectNotToPerformAssertions();
        }
        DataTypeUtil::validateStringArray($input);
    }

    /**
     * @dataProvider intArrayProvider
     *
     * @param array<int, mixed> $input
     * @param string|null       $exceptionMsg
     * @throws IncorrectDataTypeException
     */
    public function testValidateIntArray(array $input, ?string $exceptionMsg): void
    {
        if ($exceptionMsg !== null) {
            self::expectExceptionMessage($exceptionMsg);
        } else {
            self::expectNotToPerformAssertions();
        }
        DataTypeUtil::validateIntArray($input);
    }

    /**
     * @dataProvider floatArrayProvider
     *
     * @param array<int, mixed> $input
     * @param string|null       $exceptionMsg
     * @throws IncorrectDataTypeException
     */
    public function testValidateFloatArray(array $input, ?string $exceptionMsg): void
    {
        if ($exceptionMsg !== null) {
            self::expectExceptionMessage($exceptionMsg);
        } else {
            self::expectNotToPerformAssertions();
        }
        DataTypeUtil::validateFloatArray($input);
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function stringArrayProvider(): array
    {
        return [
            'empty data'           => [
                [],
                null,
            ],
            'valid data'           => [
                ['a', 'b', 'c'],
                null,
            ],
            'invalid data - int'   => [
                ['a', 1, 'c'],
                sprintf(self::INVALID_TYPE_ERR, 'string', 'integer'),
            ],
            'invalid data - array' => [
                ['a', [], 'c'],
                sprintf(self::INVALID_TYPE_ERR, 'string', 'array'),
            ],
        ];
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function intArrayProvider(): array
    {
        return [
            'empty data'            => [
                [],
                null,
            ],
            'valid data'            => [
                [1, 2, 3],
                null,
            ],
            'invalid data - string' => [
                [1, 'a', 3],
                sprintf(self::INVALID_TYPE_ERR, 'integer', 'string'),
            ],
            'invalid data - array'  => [
                [1, [], 3],
                sprintf(self::INVALID_TYPE_ERR, 'integer', 'array'),
            ],
        ];
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function floatArrayProvider(): array
    {
        return [
            'empty data'            => [
                [],
                null,
            ],
            'valid data'            => [
                [1.0, 2.1, 3.2],
                null,
            ],
            'invalid data - int'    => [
                [1.0, 2, 3.2],
                sprintf(self::INVALID_TYPE_ERR, 'float', 'integer'),
            ],
            'invalid data - string' => [
                [1.0, 'a', 3.2],
                sprintf(self::INVALID_TYPE_ERR, 'float', 'string'),
            ],
            'invalid data - array'  => [
                [1.0, [], 3.2],
                sprintf(self::INVALID_TYPE_ERR, 'float', 'array'),
            ],
        ];
    }

}
