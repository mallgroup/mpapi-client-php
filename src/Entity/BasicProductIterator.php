<?php
namespace MPAPI\Entity;

/**
 * Basic product iterator
 *
 * @author martin.hrdlicka@mall.cz
 */
class BasicProductIterator implements \Iterator
{

	/**
	 *
	 * @var array
	 */
	private $data;

	/**
	 *
	 * @param array $basicData
	 */
	public function __construct(array $basicData)
	{
		foreach ($basicData as $basicItem) {
			$this->data[] = new BasicProduct($basicItem);
		}
	}

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
	public function getOutputData()
	{
		$retval = [];
		/* @var BasicProduct $basicItem */
		foreach ($this->data as $basicItem) {
			$retval[] = $basicItem->getData();
		}
		
		return $retval;
	}
}
