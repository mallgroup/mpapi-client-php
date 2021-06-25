<?php declare(strict_types=1);

namespace MpApiClient\Tests\unit;

use Codeception\Test\Unit;
use MpApiClient\Exception\MpApiException;
use MpApiClient\Filter\FilterItem;
use MpApiClient\Filter\FilterOperatorEnum;

final class FilterItemTest extends Unit
{

    /**
     * @dataProvider createProvider
     */
    public function testCreate(string $column, string $value, FilterOperatorEnum $operator, ?string $exceptionMsg): void
    {
        if ($exceptionMsg !== null) {
            self::expectException(MpApiException::class);
            self::expectExceptionMessage($exceptionMsg);
        }

        $item = FilterItem::create($column, $value, $operator);

        self::assertEquals($column, $item->getColumn());
        self::assertEquals([$value], $item->getValues());
        self::assertEquals($operator, $item->getOperator());
    }

    public function testCreateInterval(): void
    {
        $column = 'column-name';
        $value1 = 'filter-value-1';
        $value2 = 'filter-value-2';

        $item = FilterItem::createInterval($column, $value1, $value2);
        self::assertEquals($column, $item->getColumn());
        self::assertEquals([$value1, $value2], $item->getValues());
        self::assertEquals(FilterOperatorEnum::BETWEEN(), $item->getOperator());
    }

    /**
     * @dataProvider inclusionProvider
     *
     * @param string[] $values
     */
    public function testCreateInclusion(string $column, array $values, bool $expectError): void
    {
        if ($expectError) {
            self::expectError();
        }

        $item = FilterItem::createInclusion($column, ...$values);
        self::assertEquals($column, $item->getColumn());
        self::assertEquals($values, $item->getValues());
        self::assertEquals(FilterOperatorEnum::IN(), $item->getOperator());
    }

    /**
     * @dataProvider inclusionProvider
     *
     * @param string[] $values
     */
    public function testCreateExclusion(string $column, array $values, bool $expectError): void
    {
        if ($expectError) {
            self::expectError();
        }

        $item = FilterItem::createExclusion($column, ...$values);
        self::assertEquals($column, $item->getColumn());
        self::assertEquals($values, $item->getValues());
        self::assertEquals(FilterOperatorEnum::NOT_IN(), $item->getOperator());
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function createProvider(): array
    {
        return [
            'valid data - empty'       => [
                'column-name',
                'filter-value',
                FilterOperatorEnum::EMPTY(),
                null,
            ],
            'valid data - equal'       => [
                'column-name',
                'filter-value',
                FilterOperatorEnum::EQUAL(),
                null,
            ],
            'valid data - less than'   => [
                'column-name',
                'filter-value',
                FilterOperatorEnum::LESS_THAN(),
                null,
            ],
            'invalid data - in'        => [
                'column-name',
                'filter-value',
                FilterOperatorEnum::IN(),
                sprintf('Unsupported operator [%s] used. Please use provided create methods.', FilterOperatorEnum::IN),
            ],
            'invalid data - between'   => [
                'column-name',
                'filter-value',
                FilterOperatorEnum::BETWEEN(),
                sprintf('Unsupported operator [%s] used. Please use provided create methods.', FilterOperatorEnum::BETWEEN),
            ],
        ];
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function intervalProvider(): array
    {
        return [
            'valid data' => [
                'column-name',
                'filter-value-1',
                'filter-value-2',
            ],
        ];
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function inclusionProvider(): array
    {
        return [
            'valid data - single'       => [
                'column-name',
                ['filter-value'],
                false,
            ],
            'valid data - multiple'     => [
                'column-name',
                ['filter-value-1', 'filter-value-2', 'filter-value-3'],
                false,
            ],
            'invalid data - wrong type' => [
                'column-name',
                ['filter-value-1', 'filter-value-2', 3, 4.5],
                true,
            ],
        ];
    }

}
