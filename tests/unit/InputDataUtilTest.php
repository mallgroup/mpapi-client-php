<?php declare(strict_types=1);

namespace MpApiClient\Tests\unit;

use Codeception\Test\Unit;
use DateTimeInterface;
use Exception;
use MpApiClient\Common\Util\InputDataUtil;

final class InputDataUtilTest extends Unit
{

    /**
     * @dataProvider dataProvider
     *
     * @param array<string, mixed> $data
     * @throws Exception
     */
    public function testGetNullableDate(array $data): void
    {
        self::assertInstanceOf(DateTimeInterface::class, InputDataUtil::getNullableDate($data, 'date'));
        self::assertInstanceOf(DateTimeInterface::class, InputDataUtil::getNullableDate($data, 'nested', 'date'));
        self::assertNull(InputDataUtil::getNullableDate($data, 'non-existing-key'));
        self::assertNull(InputDataUtil::getNullableDate($data, 'non', 'existing', 'key'));
    }

    /**
     * @dataProvider dataProvider
     *
     * @param array<string, mixed> $data
     * @throws Exception
     */
    public function testGetNullableString(array $data): void
    {
        self::assertIsString(InputDataUtil::getNullableString($data, 'string'));
        self::assertIsString(InputDataUtil::getNullableString($data, 'nested', 'string'));
        self::assertNull(InputDataUtil::getNullableString($data, 'non-existing-key'));
        self::assertNull(InputDataUtil::getNullableString($data, 'non', 'existing', 'key'));
    }

    /**
     * @dataProvider dataProvider
     *
     * @param array<string, mixed> $data
     * @throws Exception
     */
    public function testGetNullableInt(array $data): void
    {
        self::assertIsInt(InputDataUtil::getNullableInt($data, 'int'));
        self::assertIsInt(InputDataUtil::getNullableInt($data, 'nested', 'int'));
        self::assertNull(InputDataUtil::getNullableInt($data, 'non-existing-key'));
        self::assertNull(InputDataUtil::getNullableInt($data, 'non', 'existing', 'key'));
    }

    /**
     * @dataProvider dataProvider
     *
     * @param array<string, mixed> $data
     * @throws Exception
     */
    public function testGetNullableFloat(array $data): void
    {
        self::assertIsFloat(InputDataUtil::getNullableFloat($data, 'float'));
        self::assertIsFloat(InputDataUtil::getNullableFloat($data, 'nested', 'float'));
        self::assertNull(InputDataUtil::getNullableFloat($data, 'non-existing-key'));
        self::assertNull(InputDataUtil::getNullableFloat($data, 'non', 'existing', 'key'));
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function dataProvider(): array
    {
        return [
            'data' => [
                [
                    'a',
                    'b',
                    'c',
                    'date'   => '2001-01-31',
                    'time'   => '2001-01-31 06:00:00',
                    'string' => 'a',
                    'int'    => 1,
                    'float'  => 1.0,
                    'nested' => [
                        'a',
                        'empty'  => [],
                        'date'   => '2001-01-31',
                        'time'   => '2001-01-31 06:00:00',
                        'string' => 'a',
                        'int'    => 1,
                        'float'  => 1.0,
                    ],
                ],
            ],
        ];
    }

}
