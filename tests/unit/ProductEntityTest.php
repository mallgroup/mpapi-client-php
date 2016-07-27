<?php
namespace MPAPI\Tests\Unit\LabelTest;

use MPAPI\Entity\Product;
use Codeception\Util\Fixtures;

/**
 * Test product entity
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class ProductTest extends \Codeception\Test\Unit
{

	/**
	 *
	 * @var Product
	 */
	private $object;

	protected function _before()
	{
		$this->object = new Product(Fixtures::get('product'));
	}

	protected function _after()
	{
		unset($this->object);
	}

	public function testGetId()
	{
		$this->assertNotEmpty($this->object->getId());
	}

	public function testGetTitle()
	{
		$this->assertNotEmpty($this->object->getTitle());
	}

	public function testGetCategoryId()
	{
		$this->assertNotEmpty($this->object->getCategoryId());
	}

	public function testGetShortdesc()
	{
		$this->assertNotEmpty($this->object->getShortdesc());
	}

	public function testGetLongdesc()
	{
		$this->assertNotEmpty($this->object->getLongdesc());
	}

	public function testGetBrandId()
	{
		$this->assertNotEmpty($this->object->getBrandId());
	}

	public function testGetPriority()
	{
		$this->assertNotEmpty($this->object->getPriority());
	}

	public function testGetBarcode()
	{
		$this->assertEmpty($this->object->getBarcode());
	}

	public function testGetPrice()
	{
		$this->assertEmpty($this->object->getPrice());
	}

	public function testGetVat()
	{
		$this->assertNotEmpty($this->object->getVat());
	}

	public function testGetRrpPrice()
	{
		$this->assertEmpty($this->object->getRrpPrice());
	}

	public function testGetVariants()
	{
		$this->assertNotEmpty($this->object->getVariants());
	}

	public function testGetData()
	{
		$this->assertNotEmpty($this->object->getData());
	}
}
