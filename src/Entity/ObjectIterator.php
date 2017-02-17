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
	 * @var array
	 */
	protected $data;

	/**
	 *
	 * @see Iterator::current()
	 */
	public function current()
	{
		return current($this->data);
	}

	/**
	 *
	 * @see Iterator::next()
	 */
	public function next()
	{
		next($this->data);
		return $this;
	}

	/**
	 *
	 * @see Iterator::key()
	 */
	public function key()
	{
		return key($this->data);
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
		reset($this->data);
		return $this;
	}

	/**
	 * Get output data
	 *
	 * @return array
	 */
	abstract public function getOutputData();
}
