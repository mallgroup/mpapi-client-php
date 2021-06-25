<?php declare(strict_types=1);

namespace MpApiClient\Common\Util;

use Closure;
use Iterator;
use JsonSerializable;
use MpApiClient\Common\DTO\Paging;
use MpApiClient\Filter\Filter;

/**
 * @template TData of JsonSerializable
 */
abstract class AbstractList implements Iterator, JsonSerializable
{

    protected Closure $callback;
    protected Filter  $filter;
    protected Paging  $paging;
    /**
     * @var TData[]
     */
    protected array $data;
    protected bool  $autoload = false;

    private int $startingOffset;

    final protected function __construct(Closure $callback, Filter $filter)
    {
        $this->callback       = $callback;
        $this->filter         = $filter;
        $this->startingOffset = $filter->getOffset();

        // always load first batch immediately
        $this->loadData();
    }

    public function autoloadEnabled(): bool
    {
        return $this->autoload;
    }

    public function enableAutoload(): void
    {
        $this->autoload = true;
    }

    public function disableAutoload(): void
    {
        $this->autoload = false;
    }

    public function getPaging(): Paging
    {
        return $this->paging;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [];
        // iterate itself, to return all data if autoload is enabled
        /** @var JsonSerializable $item - PHPStorm does not support generics yet: https://youtrack.jetbrains.com/issue/WI-47158 */
        foreach ($this as $item) {
            $data[] = $item->jsonSerialize();
        }

        return [
            'paging' => $this->paging->jsonSerialize(),
            'data'   => $data,
        ];
    }

    public function next(): void
    {
        if (!next($this->data) && $this->autoloadEnabled()) {
            $this->loadNextPage();
        }
    }

    public function key(): int
    {
        return (int) key($this->data);
    }

    public function valid(): bool
    {
        return key($this->data) !== null;
    }

    public function rewind(): void
    {
        if (!$this->autoloadEnabled() || $this->filter->getOffset() === $this->startingOffset) {
            reset($this->data);

            return;
        }

        $this->filter->setOffset($this->startingOffset);
        $this->loadData();
    }

    /**
     * Method responsible for returning array of correctly initialized entities to iterate over
     * @param array<int, array<string, mixed>> $data
     * @return TData[]
     */
    abstract protected function parseData(array $data): array;

    private function loadNextPage(): void
    {
        $newOffset = $this->filter->getLimit() + $this->filter->getOffset();

        // do nothing when we are at the end
        if ($this->getPaging()->getTotal() <= $newOffset) {
            return;
        }

        // move to next page and load data
        $this->filter->setOffset($newOffset);
        $this->loadData();
    }

    private function loadData(): void
    {
        $data         = ($this->callback)($this->filter);
        $this->data   = $this->parseData($data['data']);
        $this->paging = Paging::createFromApi($data['paging']);
    }

}
