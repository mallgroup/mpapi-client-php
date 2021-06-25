<?php declare(strict_types=1);

namespace MpApiClient\Tests\unit;

use Codeception\Test\Unit;
use InvalidArgumentException;
use MpApiClient\Filter\Filter;
use MpApiClient\Filter\FilterItem;
use MpApiClient\Filter\FilterOperatorEnum;

final class FilterTest extends Unit
{

    public function testCreate(): void
    {
        $filterItem     = FilterItem::create('column-without-operator', 'value', FilterOperatorEnum::EMPTY());
        $filterInterval = FilterItem::createInterval('column-between', 'value1', 'value2');

        $filter = new Filter();
        $filter->addFilterItem($filterItem);
        $filter->addFilterItem($filterInterval);

        $filter->addSortColumn('default-dir-sort');
        $filter->addSortColumn('asc-dir-sort', Filter::DIRECTION_DESC);
        $filter->addSortColumn('asc-dir-sort', Filter::DIRECTION_ASC); // test rewrite of previous (incorrect) value
        $filter->addSortColumn('desc-dir-sort', Filter::DIRECTION_DESC);
        $filter->prependSortColumn('desc-dir-sort', Filter::DIRECTION_DESC); // test rewrite of previous value (moving it to the beginning)

        $filter->setLimit(100);
        $filter->setOffset(500);

        // Check filter items
        self::assertArrayHasKey('column-without-operator', $filter->getFilterItems());
        self::assertEquals($filterItem, $filter->getFilterItems()['column-without-operator']);

        self::assertArrayHasKey('column-between', $filter->getFilterItems());
        self::assertEquals($filterInterval, $filter->getFilterItems()['column-between']);

        // Check sort columns
        self::assertArrayHasKey('default-dir-sort', $filter->getSortColumns());
        self::assertEquals(Filter::DIRECTION_ASC, $filter->getSortColumns()['default-dir-sort']);

        self::assertArrayHasKey('asc-dir-sort', $filter->getSortColumns());
        self::assertEquals(Filter::DIRECTION_ASC, $filter->getSortColumns()['asc-dir-sort']);

        self::assertArrayHasKey('desc-dir-sort', $filter->getSortColumns());
        self::assertEquals(Filter::DIRECTION_DESC, $filter->getSortColumns()['desc-dir-sort']);

        // Check limit and offset
        self::assertEquals(100, $filter->getLimit());
        self::assertEquals(500, $filter->getOffset());

        // Validate correct filter query with all items, sort and offset
        self::assertEquals(
            [
                'column-without-operator' => 'value',
                'column-between'          => 'bt:value1,value2',
                '_sort'                   => 'desc-dir-sort:desc,default-dir-sort:asc,asc-dir-sort:asc',
                'page'                    => 6,
                'page_size'               => 100,
            ],
            $filter->buildFilterQuery()
        );

        // Test removing items
        $filter->removeFilterItem('column-between');
        self::assertArrayNotHasKey('column-between', $filter->getFilterItems());

        $filter->removeSortColumn('asc-dir-sort');
        self::assertArrayNotHasKey('asc-dir-sort', $filter->getSortColumns());

        // Test complete reset
        $filter->resetSort();
        self::assertEmpty($filter->getSortColumns());

        $filter->resetFilter();
        self::assertEmpty($filter->getFilterItems());

        // Check correct query without filter or sort
        self::assertEquals(
            [
                'page'      => 6,
                'page_size' => 100,
            ],
            $filter->buildFilterQuery()
        );
    }

    public function testSetLimit(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage(sprintf('Filter limit must be a positive number above zero, [%d] provided', 0));

        $filter = new Filter();
        $filter->setLimit(0);
    }

}
