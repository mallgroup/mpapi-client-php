<?php declare(strict_types=1);

namespace MpApiClient\Common\Util;

use Countable;
use Iterator;
use JsonSerializable;

/**
 * @template TData of JsonSerializable
 */
abstract class AbstractIntKeyIterator implements Iterator, Countable, JsonSerializable
{

    /**
     * @var array<int, TData>
     */
    protected array $data = [];

    /**
     * @return array<int, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [];
        /** @var JsonSerializable $item - PHPStorm does not support generics yet: https://youtrack.jetbrains.com/issue/WI-47158 */
        foreach ($this->data as $item) {
            $data[] = $item->jsonSerialize();
        }

        return $data;
    }

    public function isEmpty(): bool
    {
        return $this->data === [];
    }

    public function count(): int
    {
        return count($this->data);
    }

    public function next(): void
    {
        next($this->data);
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
        reset($this->data);
    }

    public function exists(int $key): bool
    {
        return isset($this->data[$key]);
    }

    /**
     * Returns object under provided key/offset if present or null
     * @param int $key represents either objects unique primary key or offset/order in iterator data set
     */
    abstract public function get(int $key): ?object;

    /**
     * Protected because not every iterator should be mutable
     * @param int $key represents either objects unique primary key or offset/order in iterator data set
     */
    protected function remove(int $key): void
    {
        unset($this->data[$key]);
    }

    // correct types are not enforceable by PHP, but child classes should implement this method if needed
    // abstract public function add(object $value): void;

}
