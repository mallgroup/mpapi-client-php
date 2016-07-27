<?php
namespace MPAPI\Tests\Unit;

use MPAPI\Entity\Availability;
use Codeception\Util\Fixtures;

class AvailabilityTest extends \Codeception\Test\Unit
{

	/**
	 *
	 * @var Availability
	 */
	private $object;

	protected function _before()
	{
		$this->object = new Availability(Fixtures::get('inStock'), Fixtures::get('status'));
	}

	protected function _after()
	{
		unset($this->object);
	}

	public function testGetData()
	{
		$this->assertNotEmpty($this->object->getData());
	}

	public function testGetStatus()
	{
		$this->assertNotEmpty($this->object->getStatus());
		$this->assertEquals('A', $this->object->getStatus());
	}

	public function testSetStatus()
	{
		$status = 'N';
		$this->assertNotEquals($this->object->getStatus(), $status);
		$this->object->setStatus($status);
		$this->assertNotEmpty($this->object->getStatus());
		$this->assertEquals($this->object->getStatus(), $status);
	}

	/**
	 * @expectedException \MPAPI\Exceptions\AvailabilityBadStatusException
	 */
	public function testSetStatusFailed()
	{
		$status = 'F';
		$this->object->setStatus($status);
	}

	public function testGetInStock()
	{
		$this->assertNotEmpty($this->object->getInStock());
		$this->assertEquals('22', $this->object->getInStock());
	}

	public function testSetInStock()
	{
		$inStock = 25;
		$this->assertNotEquals($this->object->getInStock(), $inStock);
		$this->object->setInStock($inStock);
		$this->assertNotEmpty($this->object->getInStock());
		$this->assertEquals($this->object->getInStock(), $inStock);
	}

	/**
	 * @expectedException \MPAPI\Exceptions\AvailabilityBadInStockValueException
	 */
	public function testSetInStockFailed()
	{
		$inStock = 'X';
		$this->object->setInStock($inStock);
	}

	public function testIsActive()
	{
		$this->assertTrue(is_bool($this->object->isActive()));
	}

	public function testIsOnStock()
	{
		$this->assertTrue(is_bool($this->object->isOnStock()));
	}
}