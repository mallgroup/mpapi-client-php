<?php
namespace MPAPI\Services;

use MPAPI\Entity\AbstractEntity;
use MPAPI\Endpoints\Deliveries\DistrictsEndpoints;
use MPAPI\Endpoints\Deliveries\GeneralEndpoints;
use MPAPI\Endpoints\Deliveries\PartnerEndpoints;
use MPAPI\Endpoints\Deliveries\PartnerPickupPointsEndpoints;
use MPAPI\Endpoints\Deliveries\PricingEndpoints;

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
	protected $client;

	/**
	 *
	 * @var string
	 */
	const PATH = 'deliveries';

	/**
	 *
	 * @var AbstractDelivery[]
	 */
	protected $entities = [];

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
	 * Pricing endpoints
	 *
	 * @return MPAPI\Endpoints\Deliveries\PricingEndpoints
	 */
	public function pricing()
	{
		return new PricingEndpoints($this->client, $this);
	}

	/**
	 *
	 * @return MPAPI\Endpoints\Deliveries\GeneralEndpoints
	 */
	public function general()
	{
		return new GeneralEndpoints($this->client, $this);
	}

	/**
	 *
	 * @return MPAPI\Endpoints\Deliveries\PartnerPickupPointsEndpoints
	 */
	public function partnerPickupPoints()
	{
		return new PartnerPickupPointsEndpoints($this->client, $this);
	}

	/**
	 *
	 * @return MPAPI\Endpoints\Deliveries\DistrictsEndpoints
	 */
	public function districts()
	{
		return new DistrictsEndpoints($this->client, $this);
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
