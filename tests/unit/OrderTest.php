<?php
namespace MPAPI\Tests\Unit;

use Codeception\Test\Unit;
use Codeception\Util\Fixtures;
use MPAPI\Entity\Order;
use MPAPI\Entity\Orders\UlozenkaConsignmentStatusIterator;

class OrderTest extends Unit
{

	/**
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
		$this->assertEquals(Fixtures::get('orderData')['items'], $this->object->getItems());
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

	public function testGetCod()
	{
		$this->assertNotEmpty($this->object->getCod());
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

	public function testSetConfirmed()
	{
		$this->object->setConfirmed(true);
		$this->assertTrue($this->object->getConfirmed());
	}

	public function testGetStatus()
	{
		$this->assertNotEmpty($this->object->getStatus());
	}

	public function testSetStatus()
	{
		$this->object->setStatus(Order::STATUS_SHIPPED);
		$this->assertEquals(Order::STATUS_SHIPPED, $this->object->getStatus());
	}

	public function testGetCodPrice()
	{
		$this->assertEmpty($this->object->getCodPrice());
	}

	public function getDeliveryMethod()
	{
		$this->assertEmpty($this->object->getDeliveryMethod());
	}

	public function testGetTransportId()
	{
		$this->assertEmpty($this->object->getTransportId());
	}

	public function testGetTrackingNumber()
	{
		$this->assertNotEmpty($this->object->getTrackingNumber());
	}

	public function testGetTrackingUrl()
	{
		$this->assertEquals(Fixtures::get('orderData')['tracking_url'],$this->object->getTrackingUrl());
	}

	public function testGetDiscount()
	{
		$this->assertEmpty($this->object->getDiscount());
	}

	public function testGetPaymentType()
	{
		$this->assertEmpty($this->object->getPaymentType());
	}

	public function testGetCreated()
	{
		$this->assertEmpty($this->object->getCreated());
	}

	public function testGetCustomerId()
	{
		$this->assertEmpty($this->object->getCustomerId());
	}

	public function testGetMdp()
	{
		$this->assertFalse($this->object->getMdp());
	}

	public function testIsReadyToReturn()
	{
		$this->assertFalse($this->object->isReadyToReturn());
	}

	public function testIsBranchOverridden()
	{
		$this->assertFalse($this->object->isBranchOverridden());
	}

	public function testGetUlozenkaStatusHistory()
	{
		$this->assertInstanceOf(UlozenkaConsignmentStatusIterator::class, $this->object->getUlozenkaStatusHistory());
		$this->assertEmpty($this->object->getUlozenkaStatusHistory()->toArray());
	}

}
