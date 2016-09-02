<?php
namespace MPAPI\Services;

use MPAPI\Endpoints\Deliveries\PartnerEndpoints;
use MPAPI\Entity\AbstractEntity;

/**
 * Deliveries
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class Deliveries extends AbstractService
{
	/**
	 *
	 * @var Client
	 */
	private $client;

	/**
	 *
	 * @var string
	 */
	const PATH = 'deliveries';

	/**
	 *
	 * @var AbstractDelivery[]
	 */
	private $entities = [];

	/**
	 * Deliveries constructor.
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 *
	 * @return MPAPI\Endpoints\Deliveries\PartnerEndpoints
	 */
	public function partner()
	{
		return new PartnerEndpoints($this->client, $this);
	}

	/**
	 *
	 * @return MPAPI\Endpoints\Deliveries\GeneralEndpoints
	 */
	public function general()
	{
		return [];
	}

	/**
	 * Add delivery method
	 *
	 * @see \MPAPI\Services\AbstractService::add()
	 * @param AbstractEntity $entity
	 * @return Deliveries
	 */
	public function add(AbstractEntity $entity)
	{
		$this->entities[] = $entity;
		return $this;
	}

	/**
	 *
	 * @return \MPAPI\Services\AbstractDelivery[]
	 */
	public function getEntities()
	{
		return $this->entities;
	}
}
