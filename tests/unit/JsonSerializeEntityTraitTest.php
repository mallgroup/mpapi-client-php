<?php declare(strict_types=1);

namespace MpApiClient\Tests\unit;

use Codeception\Test\Unit;
use DateTime;
use DateTimeInterface;
use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

/** @noinspection PhpMultipleClassesDeclarationsInOneFile */
final class DummyEntityToTest
{

    use JsonSerializeEntityTrait;

    private string            $stringValue;
    private int               $intValue;
    private float             $floatValue;
    private JsonSerializable  $serializableValue;
    private DateTimeInterface $dateTimeValue;

    public function __construct()
    {
        $this->stringValue       = 'string';
        $this->intValue          = 123;
        $this->floatValue        = 123.45;
        $this->serializableValue = new class implements JsonSerializable {

            public function jsonSerialize(): string
            {
                return 'serialized';
            }

        };
        $this->dateTimeValue     = new DateTime('2001-01-31 06:00:00');
    }

}

final class JsonSerializeEntityTraitTest extends Unit
{

    public function testJsonSerialize(): void
    {
        self::assertEquals(
            [
                "stringValue"       => "string",
                "intValue"          => 123,
                "floatValue"        => 123.45,
                "serializableValue" => "serialized",
                "dateTimeValue"     => "2001-01-31 06:00:00",
            ],
            (new DummyEntityToTest())->jsonSerialize()
        );
    }

}
