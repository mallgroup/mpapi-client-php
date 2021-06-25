<?php declare(strict_types=1);

namespace MpApiClient\Filter;

use InvalidArgumentException;

final class Filter
{

    private const FILTER_QUERY_PATTERN = '%s:%s';
    private const SORT_QUERY_PATTERN   = '%s:%s';

    public const DIRECTION_ASC  = 'asc';
    public const DIRECTION_DESC = 'desc';

    /**
     * @var FilterItem[]
     */
    private array $filterItems = [];
    /**
     * @var array<string, string>
     */
    private array $sortColumns = [];
    private int   $offset      = 0;
    private int   $limit       = 100;

    /**
     * @return FilterItem[]
     */
    public function getFilterItems(): array
    {
        return $this->filterItems;
    }

    public function resetFilter(): void
    {
        $this->filterItems = [];
    }

    /**
     * Adds new FilterItem to filter, overwriting previous column filter if set
     */
    public function addFilterItem(FilterItem $filterItem): void
    {
        $this->filterItems[$filterItem->getColumn()] = $filterItem;
    }

    /**
     * Removes FilterItem for column from filter if set
     */
    public function removeFilterItem(string $column): void
    {
        if (isset($this->filterItems[$column])) {
            unset($this->filterItems[$column]);
        }
    }

    /**
     * @return array<string, string>
     */
    public function getSortColumns(): array
    {
        return $this->sortColumns;
    }

    public function resetSort(): void
    {
        $this->sortColumns = [];
    }

    public function prependSortColumn(string $column, string $direction = self::DIRECTION_ASC): void
    {
        if (isset($this->sortColumns[$column])) {
            unset($this->sortColumns[$column]);
        }

        $this->sortColumns = [$column => strtolower($direction)] + $this->sortColumns;
    }

    public function addSortColumn(string $column, string $direction = self::DIRECTION_ASC): void
    {
        if (isset($this->sortColumns[$column])) {
            unset($this->sortColumns[$column]);
        }

        $this->sortColumns[$column] = strtolower($direction);
    }

    /**
     * Removes column from sort if set
     */
    public function removeSortColumn(string $column): void
    {
        if (isset($this->sortColumns[$column])) {
            unset($this->sortColumns[$column]);
        }
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setLimit(int $limit): void
    {
        if ($limit <= 0) {
            throw new InvalidArgumentException(sprintf('Filter limit must be a positive number above zero, [%d] provided', $limit));
        }

        $this->limit = $limit;
    }

    /**
     * @return array<string, string|int>
     */
    public function buildFilterQuery(): array
    {
        $query = [];

        foreach ($this->filterItems as $item) {
            if ($item->getOperator()->equals(FilterOperatorEnum::EMPTY())) {
                // column_name => value
                $query[$item->getColumn()] = implode(',', $item->getValues());
            } else {
                // column_name => nin:value1,value2,value3
                $query[$item->getColumn()] = sprintf(self::FILTER_QUERY_PATTERN, $item->getOperator()->getValue(), implode(',', $item->getValues()));
            }
        }

        $sort = [];
        foreach ($this->sortColumns as $column => $direction) {
            $sort[] = sprintf(self::SORT_QUERY_PATTERN, $column, $direction);
        }

        if ($sort !== []) {
            // _sort => column1:asc,column2:desc
            $query['_sort'] = implode(',', $sort);
        }

        $query['page']      = (int) (floor($this->getOffset() / $this->getLimit()) + 1);
        $query['page_size'] = $this->getLimit();

        // MPAPI for now uses paging instead of offset and limit
        // $query['_offset'] = $this->getOffset();
        // $query['_limit'] = $this->getLimit();

        return $query;
    }

}
