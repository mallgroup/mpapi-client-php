<?php
namespace MPAPI\Exceptions;

use GuzzleHttp\Exception\ClientException;

/**
 * Force token exception class
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class ForceTokenException extends \Exception
{

	/**
	 *
	 * @var string
	 */
	const KEY_DATA = 'data';

	/**
	 *
	 * @var string
	 */
	const KEY_FORCE_TOKEN = 'forceToken';

	/**
	 *
	 * @var array
	 */
	protected $data = [];

	/**
	 * ForceTokenException constructor.
	 *
	 * @param ClientException $ex
	 */
	public function __construct(ClientException $ex)
	{
		parent::__construct($ex->getMessage(), $ex->getCode());
	}

	/**
	 * Set data
	 *
	 * @param array $data
	 * @return ForceTokenException
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

	/**
	 * Get force token
	 *
	 * @return string
	 */
	public function getForceToken()
	{
		return $this->data[self::KEY_DATA][self::KEY_FORCE_TOKEN];
	}

	/**
	 * Set force token
	 * 
	 * @param string $forceToken
	 * @return ForceTokenException
	 */
	public function setForceToken($forceToken)
	{
		$this->data[self::KEY_DATA][self::KEY_FORCE_TOKEN] = $forceToken;
		return $this;
	}
}
