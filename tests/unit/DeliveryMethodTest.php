<?php
namespace MPAPI\Tests\Unit;

use MPAPI\Entity\DeliveryMethod;
use Codeception\Util\Fixtures;
use MPAPI\Entity\DeliverySetup;

class DeliveryMethodTest extends \Codeception\Test\Unit
{
	/**
	 *
	 * @var Availability
	 */
	private $object;

	protected function _before()
	{
		$this->object = new DeliveryMethod(Fixtures::get('deliveryMethodData'));
	}

	protected function _after()
	{
		unset($this->object);
	}

	public function testGetData()
	{
		$this->assertContains(Fixtures::get('deliveryMethodData'), $this->object->getData());
	}

	public function testGetId()
	{
		$this->assertNotEmpty($this->object->getId());
	}

	public function testSetId()
	{
		$this->assertEquals(Fixtures::get('deliveryMethodData')['id'], $this->object->getId());
		$this->object->setId(Fixtures::get('updatedDeliveryMethodId'));
		$this->assertEquals(Fixtures::get('updatedDeliveryMethodId'), $this->object->getId());
	}

	public function testGetTitle()
	{
		$this->assertNotEmpty($this->object->getTitle());
	}

	public function testSetTitle()
	{
		$this->assertEquals(Fixtures::get('deliveryMethodData')['title'], $this->object->getTitle());
		$this->object->setTitle(Fixtures::get('updatedDeliveryMethodTitle'));
		$this->assertEquals(Fixtures::get('updatedDeliveryMethodTitle'), $this->object->getTitle());
	}

	public function testGetPrice()
	{
		$this->assertGreaterThan(0, $this->object->getPrice());
	}

	public function testSetPrice()
	{
		$this->assertEquals(Fixtures::get('deliveryMethodData')['price'], $this->object->getPrice());
		$this->object->setPrice(Fixtures::get('updatedDeliveryMethodPrice'));
		$this->assertEquals(Fixtures::get('updatedDeliveryMethodPrice'), $this->object->getPrice());
	}

	public function testGetCodPrice()
	{
		$this->assertGreaterThan(0, $this->object->getCodPrice());
	}

 	public function testSetCodPrice()
	{
		$this->assertEquals(Fixtures::get('deliveryMethodData')['cod_price'], $this->object->getCodPrice());
		$this->object->setCodPrice(Fixtures::get('updatedDeliveryMethodCodPrice'));
		$this->assertEquals(Fixtures::get('updatedDeliveryMethodCodPrice'), $this->object->getCodPrice());
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
		$this->assertEquals(Fixtures::get('deliveryMethodData')['free_limit'], $this->object->getFreeLimit());
		$this->object->setFreeLimit(Fixtures::get('updatedDeliveryMethodFreeLimit'));
		$this->assertFalse($this->object->hasFreeLimit());
	}

	public function testGetDeliveryDelay()
	{
		$this->assertGreaterThan(0, $this->object->getDeliveryDelay());
	}

	public function testSetDeliveryDelay()
	{
		$this->assertEquals(Fixtures::get('deliveryMethodData')['delivery_delay'], $this->object->getDeliveryDelay());
		$this->object->setDeliveryDelay(Fixtures::get('updatedDeliveryMethodDeliveryDelay'));
		$this->assertEquals(Fixtures::get('updatedDeliveryMethodDeliveryDelay'), $this->object->getDeliveryDelay());
	}

	public function testIsPickupPoint()
	{
		$this->assertTrue($this->object->isPickupPoint());
	}

	public function testSetPickupPoint()
	{
		$this->assertEquals(Fixtures::get('deliveryMethodData')['is_pickup_point'], $this->object->isPickupPoint());
		$this->object->setPickupPoint(Fixtures::get('updatedDeliveryMethodPickupPoint'));
		$this->assertEquals(Fixtures::get('updatedDeliveryMethodPickupPoint'), $this->object->isPickupPoint());
	}

	public function testHasSetups()
	{
		$this->assertFalse($this->object->hasSetups());
	}

	public function testGetDeliverySetups()
	{
		$this->assertTrue(is_array($this->object->getDeliverySetups()));
	}

	public function testGetDeliverySetupsData()
	{
		$this->assertTrue(is_array($this->object->getDeliverySetupsData()));
	}

	public function testAddDeliverySetup()
	{
		$this->assertFalse($this->object->hasSetups());
		$this->object->addDeliverySetup(new DeliverySetup(Fixtures::get('deliverySetupData')));
		$this->assertTrue($this->object->hasSetups());
	}
}
