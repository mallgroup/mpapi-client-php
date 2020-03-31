<?php
namespace MPAPI\Entity\Products;

use MPAPI\Entity\ObjectIterator;

/**
 * Basic product iterator
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class BasicProductIterator extends ObjectIterator implements \Iterator
{

	/**
	 * @var BasicProduct[]
	 */
	protected $data = [];
	
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
	 * Get output data
	 *
	 * @return array
	 */
	public function getOutputData()
	{
		$retval = [];
		foreach ($this->data as $basicItem) {
			$retval[] = $basicItem->getData();
		}

		return $retval;
	}
}
