<?php declare(strict_types=1);

namespace MpApiClient\Tests\unit;

use Codeception\Test\Unit;
use Error;
use InvalidArgumentException;
use MpApiClient\Common\Util\AbstractStringEnum;

/**
 * @method static self FIRST()
 * @method static self SECOND()
 * @method static self THIRD()
 * @noinspection PhpMultipleClassesDeclarationsInOneFile
 */
final class StringEnumToTest extends AbstractStringEnum
{

    public const FIRST  = 'first_value';
    public const SECOND = 'second_value';
    public const THIRD  = 'third_value';

    public const TYPES = [
        self::FIRST,
        self::SECOND,
        self::THIRD,
    ];

    public const KEY_NAME = 'key_name';

}

final class StringEnumAbstractTest extends Unit
{

    private const INVALID_VALUE_MSG = 'Invalid type [%s] provided, allowed is one of: %s';

    public function testStaticConstructor(): void
    {
        $first = StringEnumToTest::FIRST();
        self::assertInstanceOf(AbstractStringEnum::class, $first);
        self::assertEquals(StringEnumToTest::FIRST, (string) $first);
        self::assertEquals(StringEnumToTest::FIRST, $first->getValue());

        $second = StringEnumToTest::SECOND();
        self::assertInstanceOf(AbstractStringEnum::class, $second);
        self::assertEquals(StringEnumToTest::SECOND(), (string) $second);
        self::assertEquals(StringEnumToTest::SECOND, $second->getValue());

        try {
            /** @phpstan-ignore-next-line */
            StringEnumToTest::FOURTH();
            self::fail('static constructor should not allow invalid values');
        } catch (Error $e) {
            self::assertEquals(sprintf('Call to undefined method %s::%s().', StringEnumToTest::class, 'FOURTH'), $e->getMessage());
        }
    }

    public function testConstructor(): void
    {
        $first = new StringEnumToTest(StringEnumToTest::FIRST);
        self::assertInstanceOf(AbstractStringEnum::class, $first);
        self::assertEquals($first, StringEnumToTest::FIRST());

        $second = new StringEnumToTest(StringEnumToTest::SECOND);
        self::assertInstanceOf(AbstractStringEnum::class, $second);
        self::assertEquals($second, StringEnumToTest::SECOND());

        try {
            new StringEnumToTest('fourth_value');
            self::fail('constructor should not allow invalid values');
        } catch (InvalidArgumentException $e) {
            self::assertEquals(sprintf(self::INVALID_VALUE_MSG, 'fourth_value', implode(', ', StringEnumToTest::TYPES)), $e->getMessage());
        }
    }

    public function testToString(): void
    {
        self::assertEquals(StringEnumToTest::FIRST, (string) StringEnumToTest::FIRST());
        self::assertEquals(StringEnumToTest::SECOND, (string) StringEnumToTest::SECOND());
    }

    public function testGetValue(): void
    {
        self::assertEquals(StringEnumToTest::FIRST, StringEnumToTest::FIRST()->getValue());
        self::assertEquals(StringEnumToTest::SECOND, StringEnumToTest::SECOND()->getValue());
    }

    public function testJsonSerialize(): void
    {
        self::assertEquals(sprintf('"%s"', StringEnumToTest::FIRST), json_encode(StringEnumToTest::FIRST()));
        self::assertEquals(sprintf('"%s"', StringEnumToTest::SECOND), json_encode(StringEnumToTest::SECOND()));
    }

    public function testIs(): void
    {
        $first = StringEnumToTest::FIRST();

        self::assertTrue($first->equalsValue(StringEnumToTest::FIRST));
        self::assertTrue($first->equals(StringEnumToTest::FIRST()));

        self::assertFalse($first->equalsValue(StringEnumToTest::SECOND));
        self::assertFalse($first->equals(StringEnumToTest::SECOND()));

        try {
            $first->equalsValue('fourth_value');
            self::fail('comparison should not allow invalid values');
        } catch (InvalidArgumentException $e) {
            self::assertEquals(sprintf(self::INVALID_VALUE_MSG, 'fourth_value', implode(', ', StringEnumToTest::TYPES)), $e->getMessage());
        }

        try {
            $first->equalsOneOfValues('fourth_value', 'fifth_value');
            self::fail('comparison should not allow invalid values');
        } catch (InvalidArgumentException $e) {
            self::assertEquals(
                sprintf(self::INVALID_VALUE_MSG, implode(', ', ['fourth_value', 'fifth_value']), implode(', ', StringEnumToTest::TYPES)),
                $e->getMessage()
            );
        }
    }

    public function testIsOneOf(): void
    {
        $first = StringEnumToTest::FIRST();

        self::assertTrue($first->equalsOneOfValues(StringEnumToTest::FIRST, StringEnumToTest::SECOND));
        self::assertTrue($first->equalsOneOf(StringEnumToTest::FIRST(), StringEnumToTest::SECOND()));

        self::assertFalse($first->equalsOneOfValues(StringEnumToTest::SECOND, StringEnumToTest::THIRD));
        self::assertFalse($first->equalsOneOf(StringEnumToTest::SECOND(), StringEnumToTest::THIRD()));

        try {
            $first->equalsOneOfValues('fourth_value', 'fifth_value');
            self::fail('comparison should not allow invalid values');
        } catch (InvalidArgumentException $e) {
            self::assertEquals(
                sprintf(self::INVALID_VALUE_MSG, implode(', ', ['fourth_value', 'fifth_value']), implode(', ', StringEnumToTest::TYPES)),
                $e->getMessage()
            );
        }
    }

}
