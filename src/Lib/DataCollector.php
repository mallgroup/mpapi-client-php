<?php
namespace MPAPI\Lib;

use GuzzleHttp\Psr7\Response;
use MPAPI\Services\Client;
use phpDocumentor\Reflection\Types\Boolean;

/**
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class DataCollector
{
	/**
	 *
	 * @var boolean
	 */
	private $isSeekable;

	/**
	 *
	 * @var integer
	 */
	private $currentPage = 1;

	/**
	 *
	 * @var integer
	 */
	private $pages = 1;

	/**
	 *
	 * @var array
	 */
	private $data = [];

	/**
	 *
	 * @var Client
	 */
	private $client;

	/**
	 *
	 * @var string
	 */
	private $section;

	/**
	 *
	 * @var Response
	 */
	private $response;

	/**
	 *
	 * @param Client $client
	 * @param Response $response
	 * @param boolean $autoStart
	 */
	public function __construct(Client $client, Response $response, $autoStart = true)
	{
		$this->client = $client;
		$this->response = $response;

		if ($autoStart === true) {
			// collect request data
			$this->collect();
		}
	}

	/**
	 * Collect request data
	 *
	 * @return boolean
	 */
	public function collect()
	{
		// process response body
		$this->processResponse($this->response);
		// load next request data
		while ($this->isSeekable === true) {
			$this->nextPage();
		}
		return true;
	}

	/**
	 * Set data section
	 *
	 * @param string $section
	 * @return DataCollector
	 */
	public function setDataSection($section)
	{
		$this->section = $section;
		return $this;
	}

	/**
	 * Process response data
	 *
	 * @param Response $response
	 * @return array
	 */
	private function processResponse(Response $response)
	{
		// parse response body
		$body = json_decode($response->getBody(), true);
		if (isset($body['paging'])) {
			$this->pages = (int)$body['paging']['pages'];
			$this->isSeekable =  $this->pages > 1;
		}

		if (isset($body['data']) && !empty($body['data'])) {
			$data = $body['data'];
			if (!empty($this->section) && isset($data[$this->section])) {
				$this->data = array_merge($this->data, $data[$this->section]);
			} else {
				$this->data = array_merge($this->data, $data);
			}

		}
		return $this->data;
	}

	/**
	 * Load next page
	 *
	 * @return boolean
	 */
	private function nextPage()
	{
		$this->currentPage++;
		if ($this->currentPage > $this->pages) {
			$this->isSeekable = false;
		} else {
			$this->processResponse($this->client->repeatLastRequest(['page' => $this->currentPage]));
		}
		return true;
	}

	/**
	 * Get response data
	 *
	 * @return array
	 */
	public function getData()
	{
		if (empty($this->data)) {
			$this->collect();
		}

		return $this->data;
	}
}
