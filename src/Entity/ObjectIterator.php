<?php
namespace MPAPI\Entity;

/**
 * Basic product iterator
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
abstract class ObjectIterator implements \Iterator
{

	/**
	 *
	 * @var int
	 */
	protected $index = 0;

	/**
	 *
	 * @var array
	 */
	protected $data;

	/**
	 *
	 * @see Iterator::current()
	 */
	public function current()
	{
		return $this->data[$this->index];
	}

	/**
	 *
	 * @see Iterator::next()
	 */
	public function next()
	{
		$this->index++;
		return $this;
	}

	/**
	 *
	 * @see Iterator::key()
	 */
	public function key()
	{
		return $this->index;
	}

	/**
	 *
	 * @see Iterator::valid()
	 */
	public function valid()
	{
		return isset($this->data[$this->key()]);
	}

	/**
	 *
	 * @see Iterator::rewind()
	 */
	public function rewind()
	{
		$this->index = 0;
		return $this;
	}

	/**
	 * Get output data
	 *
	 * @return array
	 */
	abstract public function getOutputData();
}
