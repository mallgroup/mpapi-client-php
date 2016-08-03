<?php
namespace MPAPI\Entity;

/**
 * Delivery setup entity
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class DeliverySetup extends AbstractEntity
{
	/**
	 *
	 * @var string
	 */
	const KEY_ID = 'id';

	/**
	 *
	 * @var string
	 */
	const KEY_PRICING = 'pricing';

	/**
	 *
	 * @var string
	 */
	protected $data;

	/**
	 * Construct
	 *
	 * @param string $deliverySetupId
	 */
	public function __construct($deliverySetupId)
	{
		parent::__construct([self::KEY_ID => $deliverySetupId]);
	}

	/**
	 * Get delivery setup id
	 *
	 * @return string
	 */
	public function getId()
	{
		return $this->data[self::KEY_ID];
	}

	/**
	 * Add delivery pricing into delivery setup
	 *
	 * @param DeliveryPricing $pricing
	 * @return DeliverySetup
	 */
	public function addPricing(DeliveryPricing $pricing)
	{
		if (!isset($this->data[self::KEY_PRICING])) {
			$this->data[self::KEY_PRICING] = [];
		}
		$this->data[self::KEY_PRICING][] = $pricing;
		return $this;
	}

	/**
	 * @see \MPAPI\Entity\AbstractEntity::getData()
	 */
	public function getData()
	{
		$retval = [
			self::KEY_ID => $this->getId()
		];

		/* @var DeliveryPricing $deliveryPricing */
		foreach ($this->data[self::KEY_PRICING] as $deliveryPricing) {
			$retval[self::KEY_PRICING][] = $deliveryPricing->getData();
		}

		return $retval;
	}
}
