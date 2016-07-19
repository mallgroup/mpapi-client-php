<?php
namespace MPAPI\Services;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use MPAPI\Lib\Logger;

/**
 * Marketplace API client
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class Client
{

	/**
	 *
	 * @var string
	 */
	const ENVIRONMENT_TEST = 'test';

	/**
	 *
	 * @var string
	 */
	const ENVIRONMENT_PRODUCTION = 'prod';

	/**
	 *
	 * @var string
	 */
	private $clientId;

	/**
	 *
	 * @var LoggerInterface $logger
	 */
	private $logger;

	/**
	 *
	 * @var string
	 */
	private $environment;

	/**
	 *
	 * @var GuzzleHttp\Client $httpClient
	 */
	private $httpClient;

	/**
	 *
	 * @param string $clientId
	 */
	public function __construct($clientId)
	{
		$this->clientId = $clientId;
	}

	/**
	 * Setter for logger
	 *
	 * @param LoggerInterface $logger
	 */
	public function setLogger(LoggerInterface $logger)
	{
		$this->logger = $logger;
	}

	public function getLogger()
	{
		if (!$this->logger instanceof LoggerInterface) {
			$this->logger = new Logger();
		}
		return $this->logger;
	}

	/**
	 * Get client for network communication
	 *
	 * @return GuzzleHttp\Client
	 */
	public function getHttpClient()
	{
		if (!$this->httpClient instanceof Client) {
			/* @var GuzzleHttp\Client */
			$this->httpClient = new Client([
				'base_uri' => 'http://marketplace-api.mall.test/v1/',
				'timeout' => 0,
				'allow_redirects' => false
			]);
		}
		return $this->httpClient;
	}
}
