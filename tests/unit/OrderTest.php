<?php
namespace MPAPI\Tests\Unit;

use MPAPI\Entity\Order;
use Codeception\Util\Fixtures;

class OrderTest extends \Codeception\Test\Unit
{

	/**
	 *
	 * @var Order
	 */
	private $object;

	protected function _before()
	{
		$this->object = new Order(Fixtures::get('orderData'));
	}

	protected function _after()
	{
		unset($this->object);
	}

	public function testGetData()
	{
		$this->assertNotEmpty($this->object->getData());
	}

	public function testGetOrderId()
	{
		$this->assertNotEmpty($this->object->getOrderId());
	}

	public function testGetItems()
	{
		$this->assertTrue(is_array($this->object->getItems()));
		$this->assertTrue(!empty($this->object->getItems()));
	}

	public function testGetEmptyPartnerId()
	{
		$this->assertEmpty($this->object->getPartnerId());
	}

	public function testGetNotEmptyPartnerId()
	{
		$this->object->setPartnerId(3000);
		$this->assertNotEmpty($this->object->getPartnerId());
	}

	public function testGetPurchaseId()
	{
		$this->assertTrue($this->object->getPurchaseId() > 0);
	}

	public function testGetCurrency()
	{
		$this->assertNotEmpty($this->object->getCurrencyId());
	}

	public function testGetDeliveryPrice()
	{
		$this->assertEmpty($this->object->getDeliveryPrice());
	}

	public function testGetCodPrice()
	{
		$this->assertEmpty($this->object->getCodPrice());
	}

	public function testGetName()
	{
		$this->assertNotEmpty($this->object->getName());
	}

	public function testGetPhone()
	{
		$this->assertNotEmpty($this->object->getPhone());
	}

	public function testGetEmail()
	{
		$this->assertNotEmpty($this->object->getEmail());
	}

	public function testGetCity()
	{
		$this->assertNotEmpty($this->object->getCity());
	}

	public function testGetStreet()
	{
		$this->assertNotEmpty($this->object->getStreet());
	}

	public function testGetZip()
	{
		$this->assertNotEmpty($this->object->getZip());
	}

	public function testGetCountry()
	{
		$this->assertNotEmpty($this->object->getCountry());
	}

	public function testGetConfirmed()
	{
		$this->assertTrue(is_bool($this->object->getConfirmed()));
	}

	public function testGetStatus()
	{
		$this->assertNotEmpty($this->object->getStatus());
	}

	public function testGetDeliveryCodPrice()
	{
		$this->assertEmpty($this->object->getDeliveryCodPrice());
	}

	public function testGetExternalDeliveryMethodId()
	{
		$this->assertEmpty($this->object->getExternalDeliveryMethodId());
	}
}