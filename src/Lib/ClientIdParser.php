<?php
namespace MPAPI\Lib;

use MPAPI\Exceptions\ClientIdException;

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
	const HASH_DELIMITER = '|';

	/**
	 *
	 * @var string
	 */
	private $clientId;

	/**
	 *
	 * @var string
	 */
	private $environment;

	/**
	 *
	 * @param string $clientId
	 */
	public function __construct($clientId)
	{
		$this->clientId = $clientId;
		$this->parse();
	}

	/**
	 * Get environment
	 *
	 * @return string
	 */
	public function getEnvironment()
	{
		return $this->environment;
	}

	/**
	 * Parse client id
	 *
	 * @return ClientIdParse
	 */
	private function parse()
	{
		$hash = substr(strrchr($this->clientId, self::DELIMITER), 1);
		$hashDecode = base64_decode($hash);

		if (empty($hashDecode)) {
			throw new ClientIdException(ClientIdException::MSG_CLIENT_ID_NOT_CONTAIN_ENVIRONMENT);
		}

		$this->environment = explode(self::HASH_DELIMITER, $hashDecode)[0];
		return $this;
	}
}