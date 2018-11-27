<?php

namespace MPAPI\Tests\Unit;

use Codeception\Test\Unit;
use Codeception\Util\Fixtures;
use MPAPI\Entity\Checks\DeliveryError;

class DeliveryErrorsEntityTest extends Unit
{
	/**
	 *
	 * @var DeliveryError
	 */
	private $object;

	protected function _before()
	{
		$this->object = new DeliveryError(Fixtures::get('deliveryError'));
	}

	public function testGetCode()
	{
		$data = Fixtures::get('deliveryError');
		$this->assertEquals($data['code'], $this->object->getCode());
	}

	public function testGetMessage()
	{
		$data = Fixtures::get('deliveryError');
		$this->assertEquals($data['msg'], $this->object->getMessage());
	}

	public function testGetAttribute()
	{
		$data = Fixtures::get('deliveryError');
		$this->assertEquals($data['attribute'], $this->object->getAttribute());
	}

	public function testGetValue()
	{
		$data = Fixtures::get('deliveryError');
		$this->assertEquals($data['value'], $this->object->getValue());
	}
}
