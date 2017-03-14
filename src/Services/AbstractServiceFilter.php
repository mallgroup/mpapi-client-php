<?php
namespace MPAPI\Services;

/**
 * Abstract service class for filtering
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
abstract class AbstractServiceFilter
{
	/**
	 *
	 * @var string
	 */
	const ARGUMENT_FILTER = 'filter';

	/**
	 *
	 * @var string
	 */
	const FILTER_TYPE_IDS = 'ids';

	/**
	 *
	 * @var string
	 */
	const FILTER_TYPE_BASIC = 'basic';

	/**
	 *
	 * @var string
	 */
	const FILTER_TYPE_STRICT = 'strict';

	/**
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 *
	 * @var array
	 */
	protected $filterType = [
		self::FILTER_TYPE_IDS,
		self::FILTER_TYPE_BASIC
	];

	/**
	 * Set filter to modify response data structure
	 *
	 * @param string $filterType
	 * @return AbstractServiceFilter
	 */
	public function setFilter($filterType)
	{
		if (in_array($filterType, $this->filterType)) {
			$this->client->setArguments(self::ARGUMENT_FILTER, $filterType);
		}
		return $this;
	}

	/**
	 * Get filter
	 *
	 * @return string
	 */
	public function getFilter()
	{
		$retval = $this->client->getArguments(self::ARGUMENT_FILTER);
		if (empty($retval)) {
			$retval = self::FILTER_TYPE_IDS;
		}
		return $retval;
	}

	/**
	 * Remove filter
	 * 
	 * @return AbstractServiceFilter
	 */
	public function removeFilter()
	{
		$this->client->removeArgument(self::ARGUMENT_FILTER);
		return $this;
	}
}