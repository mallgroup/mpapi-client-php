<?php
namespace MPAPI\Entity;
use GuzzleHttp\Psr7\Response;

/**
 * Class Paging
 *
 * @package MPAPI\Entity
 */
class Paging
{
	/**
	 * @var int
	 */
	private $page = 1;

	/**
	 * @var int
	 */
	private $size = 100;

	/**
	 * @var int
	 */
	private $pageCount = 0;

	/**
	 * @var int
	 */
	private $itemsCount = 0;

	/**
	 * Paging constructor.
	 *
	 * @param int $page
	 * @param int $size
	 * @param int $pageCount
	 * @param int $itemsCount
	 */
	public function __construct($page = 1, $size = 100, $pageCount = 0, $itemsCount = 0)
	{
		$this->page = $page;
		$this->size = $size;
		$this->pageCount = $pageCount;
		$this->itemsCount = $itemsCount;
	}

	public static function fromResponse(Response $response)
	{
		$responseData = json_decode($response->getBody(), true);
		/**
		 * Export variables
		 * $total
		 * $pages
		 * $size
		 * $page
		 */
		extract($responseData['paging']);
		return new self($page, $size, $pages, $total);
	}

	/**
	 * @return int
	 */
	public function getPage()
	{
		return $this->page;
	}

	/**
	 * @return int
	 */
	public function getSize()
	{
		return $this->size;
	}

	/**
	 * @return int
	 */
	public function getPageCount()
	{
		return $this->pageCount;
	}

	/**
	 * @return int
	 */
	public function getItemsCount()
	{
		return $this->itemsCount;
	}
}