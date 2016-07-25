<?php
namespace MPAPI\Exceptions;

/**
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class ApplicationException extends \Exception
{
	/**
	 *
	 * @var array
	 */
	protected $data = [];

	/**
	 *
	 * @param array $data
	 * @return \MPAPI\Exceptions\ApplicationException
	 */
	public function setData(array $data)
	{
		$this->data = $data;
		return $this;
	}

	/**
	 * Get exception data
	 *
	 * @return array
	 */
	public function getData()
	{
		return $this->data;
	}
}
