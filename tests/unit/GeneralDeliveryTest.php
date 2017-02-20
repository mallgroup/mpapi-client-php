<?php
namespace MPAPI\Tests\Unit;

use Codeception\Util\Fixtures;
use MPAPI\Entity\GeneralDelivery;

/**
 * Test partner delivery entity
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class GeneralDeliveryTest extends \Codeception\Test\Unit
{

	/**
	 *
	 * @var GeneralDelivery
	 */
	private $object;

	protected function _before()
	{
		$this->object = new GeneralDelivery(Fixtures::get('generalDelivery'));
	}

	protected function _after()
	{
		unset($this->object);
	}

	public function testGetData()
	{
		$this->assertNotEmpty($this->object->getData());
	}

	public function testGetDescription()
	{
		$this->assertNotEmpty($this->object->getDescription());
	}

	public function testSetDescription()
	{
		$newDescription = 'new description';
		$this->object->setDescription($newDescription);
		$this->assertEquals($newDescription, $this->object->getDescription());
	}

	public function testGetTrackingUrl()
	{
		$this->assertNotEmpty($this->object->getTrackingUrl());
	}

	public function testSetTrackingUrl()
	{
		$this->object->setTrackingUrl(Fixtures::get('newTrackingUrl'));
		$this->assertEquals(Fixtures::get('newTrackingUrl'), $this->object->getTrackingUrl());
	}

	public function testIsActive()
	{
		$this->assertTrue($this->object->isActive());
	}

	public function testSetActive()
	{
		$this->object->setActive(false);
		$this->assertFalse($this->object->isActive());
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
}
