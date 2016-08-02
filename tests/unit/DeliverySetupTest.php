<?php
namespace MPAPI\Tests\Unit;

use MPAPI\Entity\DeliverySetup;
use Codeception\Util\Fixtures;

class DeliverySetupTest extends \Codeception\Test\Unit
{
	/**
	 *
	 * @var Availability
	 */
	private $object;

	protected function _before()
	{
		$this->object = new DeliverySetup(Fixtures::get('deliverySetupData'));
	}

	protected function _after()
	{
		unset($this->object);
	}

	public function testGetData()
	{
		$this->assertEquals(Fixtures::get('deliverySetupData'), $this->object->getData());
	}

	public function testGetId()
	{
		$this->assertNotEmpty($this->object->getId());
	}

	public function testSetId()
	{
		$this->assertEquals(Fixtures::get('deliverySetupData')['id'], $this->object->getId());
		$this->object->setId(Fixtures::get('updatedDeliverySetupId'));
		$this->assertEquals(Fixtures::get('updatedDeliverySetupId'), $this->object->getId());
	}

	public function testGetPrice()
	{
		$this->assertGreaterThan(0, $this->object->getPrice());
	}

	public function testSetPrice()
	{
		$this->assertEquals(Fixtures::get('deliverySetupData')['price'], $this->object->getPrice());
		$this->object->setPrice(Fixtures::get('updatedDeliverySetupPrice'));
		$this->assertEquals(Fixtures::get('updatedDeliverySetupPrice'), $this->object->getPrice());
	}

	public function testGetCodPrice()
	{
		$this->assertGreaterThan(0, $this->object->getCodPrice());
	}

 	public function testSetCodPrice()
	{
		$this->assertEquals(Fixtures::get('deliverySetupData')['cod_price'], $this->object->getCodPrice());
		$this->object->setCodPrice(Fixtures::get('updatedDeliverySetupCodPrice'));
		$this->assertEquals(Fixtures::get('updatedDeliverySetupCodPrice'), $this->object->getCodPrice());
	}

	public function testGetFreeLimit()
	{
		$this->assertGreaterThan(0, $this->object->getFreeLimit());
	}

	public function testHasFreeLimit()
	{
		$this->assertTrue($this->object->hasFreeLimit());
	}

	public function testSetFreeLimit()
	{
		$this->assertEquals(Fixtures::get('deliverySetupData')['free_limit'], $this->object->getFreeLimit());
		$this->object->setFreeLimit(Fixtures::get('updatedDeliverySetupFreeLimit'));
		$this->assertFalse($this->object->hasFreeLimit());
	}

	public function testGetDeliveryDelay()
	{
		$this->assertGreaterThan(0, $this->object->getDeliveryDelay());
	}

	public function testSetDeliveryDelay()
	{
		$this->assertEquals(Fixtures::get('deliverySetupData')['delivery_delay'], $this->object->getDeliveryDelay());
		$this->object->setDeliveryDelay(Fixtures::get('updatedDeliverySetupDeliveryDelay'));
		$this->assertEquals(Fixtures::get('updatedDeliverySetupDeliveryDelay'), $this->object->getDeliveryDelay());
	}
}
