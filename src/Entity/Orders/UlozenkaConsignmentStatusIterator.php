<?php

namespace MPAPI\Entity\Orders;

use Exception;
use Iterator;

/**
 * Class UlozenkaConsignmentStatuses
 * @package Marketplace\Entity\Orders
 * @author  Michal Saloň <michal.salon@mallgroup.com>
 */
final class UlozenkaConsignmentStatusIterator implements Iterator
{

    /**
     * @var UlozenkaConsignmentStatus[]
     */
    private $data;

    /**
     * UlozenkaConsignmentStatusIterator constructor.
     * @param UlozenkaConsignmentStatus[] $data
     */
    private function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param mixed[] $data
     * @return self
     * @throws Exception
     */
    public static function createFromArray(array $data)
    {
        $items = [];
        foreach ($data as $item) {
            $items[] = UlozenkaConsignmentStatus::createFromArray($item);
        }

        return new self($items);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $out = [];
        foreach ($this->data as $status) {
            $out[] = $status->toArray();
        }

        return $out;
    }

    /**
     * Return the current element
     * @link  https://php.net/manual/en/iterator.current.php
     * @return UlozenkaConsignmentStatus
     * @since 5.0.0
     */
    public function current()
    {
        return current($this->data);
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        next($this->data);
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return (int) key($this->data);
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return key($this->data) !== null;
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        reset($this->data);
    }

}
