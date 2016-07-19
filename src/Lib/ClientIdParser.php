<?php
namespace MPAPI\Lib;

/**
 * Parser for client id
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class ClientIdParser
{
	/**
	 *
	 * @var string
	 */
	const DELIMITER = '_';

	/**
	 *
	 * @var string
	 */
	private $clientId;

	/**
	 *
	 * @param string $clientId
	 */
	public function __construct($clientId)
	{
		$this->clientId = $clientId;
	}

	/**
	 * Check if client id contain environment
	 *
	 * @return boolean
	 */
	public function containEnvironment()
	{

	}

	/**
	 * Get environment
	 *
	 * @return string
	 */
	public function getEnvironment()
	{

	}

	/**
	 * Parse client id
	 *
	 * @return ClientIdParse
	 */
	private function parse()
	{
		$hash = substr(strrchr($this->clientId, self::DELIMITER), 1);
		return $this;
	}
}