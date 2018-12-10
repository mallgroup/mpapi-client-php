<?php
namespace MPAPI\Services;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use MPAPI\Entity\Paging;
use MPAPI\Exceptions\ApplicationException;
use MPAPI\Exceptions\ClientIdException;
use MPAPI\Exceptions\ForceTokenException;
use MPAPI\Lib\ClientIdParser;
use MPAPI\Lib\Handlers\ExceptionHandler;
use MPAPI\Lib\Logger;
use Psr\Log\LoggerInterface;

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
	const APPLICATION_NAME = 'mpapic-v3.7.0';

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
	const LOGGER_REQUEST = 'Request %s %s';

	/**
	 *
	 * @var string
	 */
	const LOGGER_RESPONSE = 'Response for %s %s';

	/**
	 *
	 * @var string
	 */
	const MSG_BAD_ARGUMENTS_DATA = 'Name or value is missing in argument.';

	/**
	 * @var string
	 */
	const METHOD_POST = 'POST';

	/**
	 * @var string
	 */
	const METHOD_PUT = 'PUT';

	/**
	 * @var string
	 */
	const METHOD_DELETE = 'DELETE';

	/**
	 * @var string
	 */
	const METHOD_GET = 'GET';

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
	 * @var array
	 */
	private $config;

	/**
	 *
	 * @var array
	 */
	private $errors = [];

	/**
	 * @var array
	 */
	private $allowedEnvironment = [
		self::ENVIRONMENT_TEST,
		self::ENVIRONMENT_PRODUCTION
	];

	/**
	 *
	 * @var Request
	 */
	private $lastRequest;

	/**
	 *
	 * @var Response
	 */
	private $lastResponse;

	/**
	 *
	 * @var array
	 */
	private $arguments = [];

	/**
	 *
	 * @var bool
	 */
	private $autoDataCollecting = true;

	/**
	 * @var Paging
	 */
	private $paging;

	/**
	 * @var string
	 */
	private $applicationTag;

	/**
	 *
	 * @param string $clientId
	 * @param boolean $useErrorHandler
	 */
	public function __construct($clientId, $useErrorHandler = true)
	{
		if (empty($clientId)) {
			throw new ClientIdException(ClientIdException::MSG_MISSING_CLIENT_ID);
		}
		$this->clientId = $clientId;
		$this->environment = self::ENVIRONMENT_TEST;

		// set default exception handler
		if ($useErrorHandler === true) {
			$this->setExceptionHandler(new ExceptionHandler($this->getLogger()));
		}
	}

	/**
	 * Setter for logger
	 *
	 * @param LoggerInterface $logger
	 * @return Client
	 */
	public function setLogger(LoggerInterface $logger)
	{
		$this->logger = $logger;
		return $this;
	}

	/**
	 *
	 * @return LoggerInterface
	 */
	public function getLogger()
	{
		if (!$this->logger instanceof LoggerInterface) {
			$this->logger = new Logger();
		}
		return $this->logger;
	}

	/**
	 * Set custom user handler
	 *
	 * @param $errorHandler
	 * @param $errorTypes
	 * @return \MPAPI\Services\Client
	 */
	public function setErrorHandler($handler, $errorTypes)
	{
		set_error_handler($handler, $errorTypes);
		return $this;
	}

	/**
	 *
	 * @param object $handler
	 * @return \MPAPI\Services\Client
	 */
	public function setExceptionHandler($handler)
	{
		set_exception_handler($handler);
		return $this;
	}

	/**
	 * Enable/disable auto data collecting
	 *
	 * @param bool $state
	 * @return $this
	 */
	public function setAutoDataCollecting($state)
	{
		$this->autoDataCollecting = (bool)$state;
		return $this;
	}

	/**
	 * Return state of auto data collecting
	 *
	 * @return bool
	 */
	public function autoCollecting()
	{
		return $this->autoDataCollecting;
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
		$query = [];
		try {
			// log request parameters
			$this->getLogger()->info(sprintf(self::LOGGER_REQUEST, $method, $path), $body);
			// merge global arguments with arguments for current request
			$args = array_merge($this->arguments, $args);
			// save request params into history
			$this->lastRequest = [
				'path' => $path,
				'method' => $method,
				'body' => $body,
				'args' => $args
			];

			// set query params
			$query['client_id'] = $this->clientId;
			$query = array_merge($query, $args);
			/* @var Response $response */
			$this->lastResponse = $this->getHttpClient()->request($method, $path, [
				'headers' => [
					'X-Application-Name' => self::APPLICATION_NAME,
					'X-Application-Tag' => $this->applicationTag
				],
				'json' => $body,
				'query' => $query
			]);

			$responseData = json_decode((string)$this->lastResponse->getBody(), true);
			if (empty($responseData)) {
				$responseData = [];
			}

			if (isset($responseData['paging']['total'])) {
				unset($this->paging);
				$this->paging = Paging::fromResponse($this->lastResponse);
			}

			$this->lastResponse->getBody()->rewind();
			$this->getLogger()->info(sprintf(self::LOGGER_RESPONSE, $method, $path), $responseData);
		} catch (ClientIdException $e) {
			$this->getLogger()->error(sprintf(self::LOGGER_RESPONSE, $method, $path), ['message' => $e->getMessage()]);
			throw $e;
		} catch (ClientException $e) {
			$this->getLogger()->error($e->getMessage(), [
				'method' => $method,
				'path' => $path,
				'body' => $body,
				'client_id' => $this->clientId
			]);
			$responseData = json_decode($e->getResponse()->getBody()->getContents(), true);
			$e->getResponse()->getBody()->rewind();
			$responseData = isset($responseData['data']) ? $responseData['data'] : $responseData;
			if (isset($responseData['forceToken']) || isset($responseData['data']['forceToken'])) {
				$forceToken = isset($responseData['forceToken']) ? $responseData['forceToken'] : $responseData['data']['forceToken'];
				$exception = new ForceTokenException($e);
				$exception->setData($responseData);
				$exception->setForceToken($forceToken);
				throw $exception;
			}
			throw $e;
		}
		return $this->lastResponse;
	}

	/**
	 * Repeat last request
	 *
	 * @param array $args
	 * @return Response|null
	 */
	public function repeatLastRequest(array $args = [])
	{
		$args = array_merge($this->lastRequest['args'], $args);
		return $this->sendRequest(
			$this->lastRequest['path'],
			$this->lastRequest['method'],
			$this->lastRequest['body'],
			$args
		);
	}

	/**
	 * Get last response
	 *
	 * @return \GuzzleHttp\Psr7\Response
	 */
	public function getLastResponse()
	{
		return $this->lastResponse;
	}

	/**
	 * Validate partner
	 *
	 * @return \GuzzleHttp\Psr7\Response|null
	 */
	public function validatePartner()
	{
		$retval = false;
		$response = $this->sendRequest('partners/validate', 'GET');
		if ($response->getStatusCode() == 200) {
			$retval = true;
		}
		return $retval;
	}

	/**
	 * Set specific argument for requests
	 *
	 * @param string $name
	 * @param string $value
	 * @return Client
	 */
	public function setArgument($name, $value)
	{
		if (empty($name) || empty($value)) {
			throw new ApplicationException(self::MSG_BAD_ARGUMENTS_DATA);
		}
		$this->arguments[$name] = $value;
		return $this;
	}

	/**
	 * Get argument value
	 *
	 * @param string $name
	 * @return string
	 */
	public function getArgument($name)
	{
		$retval = '';
		if (isset($this->arguments[$name])) {
			$retval = $this->arguments[$name];
		}
		return $retval;
	}

	/**
	 * Get all arguments
	 *
	 * @return array
	 */
	public function getArguments()
	{
		return $this->arguments;
	}

	/**
	 * Remove arguments
	 *
	 * @param string $name
	 * @return Client
	 */
	public function removeArgument($name)
	{
		if (isset($this->arguments[$name])) {
			unset($this->arguments[$name]);
		}
		return $this;
	}

	/**
	 * @return Paging
	 */
	public function getPaging()
	{
		if (!$this->paging instanceof Paging) {
			$this->paging = new Paging();
		}
		return $this->paging;
	}

	/**
	 * @param string $tag
	 * @return Client
	 */
	public function setApplicationTag(string $tag)
	{
		$this->applicationTag = $tag;
		return $this;
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

		if (!in_array($environment, $this->allowedEnvironment)) {
			throw new ClientIdException(sprintf(ClientIdException::MSG_UNKNOWN_ENVIRONMENT, $environment));
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
			$config = $this->getConfig($this->getEnvironment());
			/* @var GuzzleHttp\Client */
			$this->httpClient = new HttpClient([
				'base_uri' => $config['url'],
				'timeout' => 0,
				'allow_redirects' => false
			]);
		}
		return $this->httpClient;
	}

	/**
	 * Get environment from client id
	 *
	 * @return string
	 */
	private function getEnvironment()
	{
		$parser = new ClientIdParser($this->clientId);
		return $parser->getEnvironment();
	}
}
