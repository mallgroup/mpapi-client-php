<?php
namespace MPAPI\Tests\Unit;

use MPAPI\Entity\DeliverySetup;
use Codeception\Util\Fixtures;
use MPAPI\Entity\DeliveryPricing;

class DeliverySetupTest extends \Codeception\Test\Unit
{
	/**
	 *
	 * @var DeliverySetup
	 */
	private $object;

	protected function _before()
	{
		$this->object = new DeliverySetup(Fixtures::get('deliverySetupId'));
		$this->object->addPricing(new DeliveryPricing(Fixtures::get('deliverySetupData')));
	}

	protected function _after()
	{
		unset($this->object);
	}

	public function testGetData()
	{
		$this->assertEquals(Fixtures::get('deliverySetupFinalStructure'), $this->object->getData());
	}

	public function testGetId()
	{
		$this->assertNotEmpty($this->object->getId());
	}
}
