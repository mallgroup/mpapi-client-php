<?php declare(strict_types=1);

namespace MpApiClient\Common\Util;

use Countable;
use Iterator;
use JsonSerializable;

/**
 * An iterator with values backed by their unique primary key (one item can exist only once in this iterator)...
 * @template TValue of JsonSerializable
 */
abstract class AbstractStringKeyIterator implements Iterator, Countable, JsonSerializable
{

    /**
     * @var array<string, TValue>
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

    public function key(): string
    {
        return (string) key($this->data);
    }

    public function valid(): bool
    {
        return key($this->data) !== null;
    }

    public function rewind(): void
    {
        reset($this->data);
    }

    public function exists(string $key): bool
    {
        return isset($this->data[$key]);
    }

    /**
     * Returns object under provided key if present or null
     */
    abstract public function get(string $key): ?object;

    /**
     * Removes object with provided key if present
     */
    protected function remove(string $key): void
    {
        // Protected because not every iterator should be mutable
        unset($this->data[$key]);
    }

    // correct types arent enforceable by PHP, but child classes should implement this method if needed
    // abstract public function add(object $value): void;

}
