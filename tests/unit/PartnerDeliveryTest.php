<?php
namespace MPAPI\Tests\Unit;

use MPAPI\Entity\PartnerDelivery;
use Codeception\Util\Fixtures;

/**
 * Test partner delivery entity
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class PartnerDeliveryTest extends \Codeception\Test\Unit
{

	/**
	 *
	 * @var PartnerDelivery
	 */
	private $object;

	protected function _before()
	{
		$this->object = new PartnerDelivery(Fixtures::get('partnerDelivery'));
	}

	protected function _after()
	{
		unset($this->object);
	}

	public function testGetData()
	{
		$this->assertNotEmpty($this->object->getData());
	}

	public function testGetDeliveryMethodId()
	{
		$this->assertNotEmpty($this->object->getDeliveryMethodId());
	}

	public function testGetPartnerId()
	{
		$this->assertNotEmpty($this->object->getPartnerId());
	}

	public function testSetPartnerId()
	{
		$partnerId = 4000;
		$this->object->setPartnerId($partnerId);
		$this->assertEquals($partnerId, $this->object->getPartnerId());
	}

	public function testIsPickupPoint()
	{
		$this->assertTrue($this->object->isPickupPoint());
	}

	public function testSetAsPickupPoint()
	{
		$this->object->setAsPickupPoint(false);
		$this->assertFalse($this->object->isPickupPoint());
	}

	public function testGetDeliveryDelay()
	{
		$this->assertNotEmpty($this->object->getDeliveryDelay());
	}

	public function testSetDeliveryDelay()
	{
		$newDeliveryDelay = 1;
		$this->object->setDeliveryDelay($newDeliveryDelay);
		$this->assertEquals($newDeliveryDelay, $this->object->getDeliveryDelay());
	}

	public function testGetHeightMin()
	{
		$this->assertGreaterThanOrEqual(0, $this->object->getHeightMin());
	}

	public function testSetHeightMin()
	{
		$newHeightMin = 10;
		$this->object->setHeightMin($newHeightMin);
		$this->assertEquals($newHeightMin, $this->object->getHeightMin());
	}

	public function testGetHeightMax()
	{
		$this->assertGreaterThanOrEqual(0, $this->object->getHeightMax());
	}

	public function testSetHeightMax()
	{
		$newHeightMax = 150;
		$this->object->setHeightMax($newHeightMax);
		$this->assertEquals($newHeightMax, $this->object->getHeightMax());
	}

	public function testGetLengthMin()
	{
		$this->assertGreaterThanOrEqual(0, $this->object->getLengthMin());
	}

	public function testSetLengthMin()
	{
		$newLengthMin = 10;
		$this->object->setLengthMin($newLengthMin);
		$this->assertEquals($newLengthMin, $this->object->getLengthMin());
	}

	public function testGetLengthMax()
	{
		$this->assertGreaterThanOrEqual(0, $this->object->getLengthMax());
	}

	public function testSetLengthMax()
	{
		$newLengthMax = 150;
		$this->object->setLengthMax($newLengthMax);
		$this->assertEquals($newLengthMax, $this->object->getLengthMax());
	}

	public function testGetWidthMin()
	{
		$this->assertGreaterThanOrEqual(0, $this->object->getWidthMin());
	}

	public function testSetWidthMin()
	{
		$newWidthMin = 10;
		$this->object->setWidthMin($newWidthMin);
		$this->assertEquals($newWidthMin, $this->object->getWidthMin());
	}

	public function testGetWidthMax()
	{
		$this->assertGreaterThanOrEqual(0, $this->object->getWidthMax());
	}

	public function testSetWidthMax()
	{
		$newWidthMax = 150;
		$this->object->setWidthMax($newWidthMax);
		$this->assertEquals($newWidthMax, $this->object->getWidthMax());
	}

	public function testGetWeightMin()
	{
		$this->assertGreaterThanOrEqual(0, $this->object->getWeightMin());
	}

	public function testSetWeightMin()
	{
		$newWeightMin = 10;
		$this->object->setWeightMin($newWeightMin);
		$this->assertEquals($newWeightMin, $this->object->getWeightMin());
	}

	public function testGetWeightMax()
	{
		$this->assertGreaterThanOrEqual(0, $this->object->getWeightMax());
	}

	public function testSetWeightMax()
	{
		$newWeightMax = 50;
		$this->object->setWeightMax($newWeightMax);
		$this->assertEquals($newWeightMax, $this->object->getWeightMax());
	}

	public function testGetPriority()
	{
		$this->assertGreaterThanOrEqual(0, $this->object->getPriority());
	}

	public function testSetPriority()
	{
		$newPriority = 10;
		$this->object->setPriority($newPriority);
		$this->assertEquals($newPriority, $this->object->getPriority());
	}

	public function testGetFreeLimit()
	{
		$this->assertGreaterThanOrEqual(0, $this->object->getFreeLimit());
	}

	public function testSetFreeLimit()
	{
		$newFreeLimit = 500;
		$this->object->setFreeLimit($newFreeLimit);
		$this->assertEquals($newFreeLimit, $this->object->getFreeLimit());
	}

	public function testGetCodPrice()
	{
		$this->assertGreaterThanOrEqual(0, $this->object->getCodPrice());
	}

	public function testSetCodPrice()
	{
		$newCodPrice = 99;
		$this->object->setCodPrice($newCodPrice);
		$this->assertEquals($newCodPrice, $this->object->getCodPrice());
	}

	public function testGetPrice()
	{
		$this->assertGreaterThanOrEqual(0, $this->object->getPrice());
	}

	public function testSetPrice()
	{
		$newCodPrice = 999;
		$this->object->setPrice($newCodPrice);
		$this->assertEquals($newCodPrice, $this->object->getPrice());
	}

	public function testGetCode()
	{
		$this->assertNotEmpty($this->object->getCode());
	}

	public function testSetCode()
	{
		$newCode = 'PPL new';
		$this->object->setCode($newCode);
		$this->assertEquals($newCode, $this->object->getCode());
	}

	public function testGetTitle()
	{
		$this->assertNotEmpty($this->object->getTitle());
	}

	public function testSetTitle()
	{
		$newTitle = 'new title';
		$this->object->setTitle($newTitle);
		$this->assertEquals($newTitle, $this->object->getTitle());
	}
}
