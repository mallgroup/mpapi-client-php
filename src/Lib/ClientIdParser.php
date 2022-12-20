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
	const PROD_ENV = 'prod';

	/**
	 *
	 * @param string $clientId
	 */
	public function __construct($clientId)
	{
	}

	/**
	 * Get environment
	 *
	 * @return string
	 */
	public function getEnvironment()
	{
	    return self::PROD_ENV;
	}
}