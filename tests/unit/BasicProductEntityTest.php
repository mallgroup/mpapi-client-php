<?php
namespace MPAPI\Tests\Unit;

use Codeception\Util\Fixtures;
use MPAPI\Entity\BasicProduct;

/**
 * Test basic product entity
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class BasicProductTest extends \Codeception\Test\Unit
{

	/**
	 *
	 * @var BasicProduct
	 */
	private $object;

	/**
	 * @var array
	 */
	protected $data;

	protected function _before()
	{
		parent::_before();

		$this->data = Fixtures::get('productBasicData');
		$this->object = new BasicProduct(Fixtures::get('productBasicData'));
	}

	protected function _after()
	{
		parent::_after();
		unset($this->object);
	}

	public function testGetProductId()
	{
		$this->assertEquals($this->data['product_id'], $this->object->getProductId());
	}

	public function testGetCategoryId()
	{
		$this->assertEquals($this->data['category_id'], $this->object->getCategoryId());
	}

	public function testHasVariants()
	{
		$this->assertEquals($this->data['has_variants'], $this->object->hasVariants());
	}

	public function testGetVariantsCount()
	{
		$this->assertEquals($this->data['variants_count'], $this->object->getVariantsCount());
	}

	public function testGetOutputData()
	{
		$dataOutput = $this->object->getData();
		$this->assertNotEmpty($dataOutput);
		$this->assertArrayHasKey('id', $dataOutput);
		$this->assertArrayHasKey('product_id', $dataOutput);
		$this->assertArrayHasKey('title', $dataOutput);
		$this->assertArrayHasKey('category_id', $dataOutput);
		$this->assertArrayHasKey('variants_count', $dataOutput);
		$this->assertArrayHasKey('has_variants', $dataOutput);
		$this->assertArrayHasKey('status', $dataOutput);
	}
}
