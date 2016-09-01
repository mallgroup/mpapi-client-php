<?php
namespace MPAPI\Services;

use MPAPI\Entity\AbstractDeliveriesEntity;

/**
 * Delivery settings
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
	 * @var Deliveries[]
	 */
	private $entities = [];

	/**
	 * Orders constructor.
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 *
	 * @return \MPAPI\Endpoints\Deliveries\PartnerEndpoints
	 */
	public function partner()
	{
		return new PartnerEndpoints($this->client);
	}

	/**
	 *
	 * @return \MPAPI\Endpoints\Deliveries\GeneralEndpoints
	 */
	public function general()
	{
		return new GeneralEndpoints($this->client);
	}

	/**
	 * Add delivery method
	 *
	 * @see \MPAPI\Services\AbstractService::add()
	 * @param AbstractDeliveriesEntity $entity
	 * @return Deliveries
	 */
	public function add(AbstractDeliveriesEntity $entity)
	{
		$this->entities[] = $entity;
		return $this;
	}
}
