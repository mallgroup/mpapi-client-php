<?php
namespace MPAPI\Services;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\ClientException;
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
	const CONFIG_FILE = '/../config/config.ini';

	/**
	 *
	 * @var string
	 */
	const API_URL_PATTERN = '%s?client_id=%s';

	/**
	 *
	 * @var string
	 */
	private $clientId;

	/**
	 *
	 * @var Logger $logger
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
	 * @var array
	 */
	private $config;

	/**
	 *
	 * @param string $clientId
	 */
	public function __construct($clientId)
	{
		$this->clientId = $clientId;
		$this->environment = self::ENVIRONMENT_TEST;
	}

	/**
	 * Setter for logger
	 *
	 * @param Logger $logger
	 * @return Client
	 */
	public function setLogger(Logger $logger)
	{
		$this->logger = $logger;
		return $this;
	}

	/**
	 * Set custom user handler
	 *
	 * @param callback $errorHandler
	 * @return Client
	 */
	public function setErrorHandler(callback $errorHandler)
	{
		return $this;
	}

	/**
	 *
	 * @param string $path
	 * @param string $method
	 * @param array $body
	 * @param array $args
	 * @return Response|null
	 */
	public function sendRequest($path, $method, array $body = [], array $args = [])
	{
		$response = null;
		try {
			/* @var Response $response */
			$response = $this->getHttpClient()->request($method, $path, [
				'json' => $body,
				'query' => [
					'client_id' => $this->clientId
				]
			]);
		} catch (ClientException $e) {
			$this->logger->error($e->getMessage(), [
				'method' => $method,
				'path' => $path,
				'body' => $body,
				'client_id' => $this->clientId
			]);
		}
		return $response;
	}

	/**
	 * Get configuration
	 *
	 * @param string $environment
	 * @return string
	 */
	private function getConfig($environment)
	{
		$retval = null;
		if (file_exists(__DIR__ . self::CONFIG_FILE)) {
			$this->config = parse_ini_file(__DIR__ . self::CONFIG_FILE, true);
		}

		if (isset($this->config[$environment])) {
			$retval = $this->config[$environment];
		}
		return $retval;
	}

	/**
	 * Get client for network communication
	 *
	 * @return HttpClient
	 */
	private function getHttpClient()
	{
		if (!$this->httpClient instanceof Client) {
			$config = $this->getConfig($this->environment);
			/* @var GuzzleHttp\Client */
			$this->httpClient = new HttpClient([
				'base_uri' => $config['url'],
				'timeout' => 0,
				'allow_redirects' => false
			]);
		}
		return $this->httpClient;
	}

	private function getEncryptor()
	{

	}
}
