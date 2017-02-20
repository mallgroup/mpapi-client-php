<?php
namespace MPAPI\Tests\Unit;

use Codeception\Util\Fixtures;
use MPAPI\Entity\Deliveries\PricingLevels;

class PricingLevelsTest extends \Codeception\Test\Unit
{

	/**
	 *
	 * @var PricingsLevels
	 */
	private $object;

	protected $data;

	protected $changes = false;

	protected function _before()
	{
		parent::_before();

		$this->data = Fixtures::get('pricingLevelsData');
		$changes = $this->changes;
		$this->object = new PricingLevels($this->data);
	}

	protected function _after()
	{
		parent::_after();
		unset($this->object);
	}

	public function testGetData()
	{
		$data = $this->object->getData();
		$this->assertNotEmpty($data);
		$this->assertArrayHasKey(PricingLevels::KEY_TYPE, $data[0]);
		$this->assertArrayHasKey(PricingLevels::KEY_PRICE, $data[0]);
		$this->assertArrayHasKey(PricingLevels::KEY_COD_PRICE, $data[0]);
		$this->assertArrayHasKey(PricingLevels::KEY_LIMIT, $data[0]);
		$this->assertArrayNotHasKey(PricingLevels::TYPE_PRICE, $data[0]);
	}

	/**
	 * @expectedException MPAPI\Exceptions\PricingLevelBadTypeException
	 */
	public function testAddLevelExceptionThrown()
	{
		$this->object->addLevel('x', 120, 40, 1000);
	}

	public function testAddLevel()
	{
		$this->assertEquals($this->data[0][PricingLevels::KEY_PRICE], $this->object->getData()[0][PricingLevels::KEY_PRICE]);

		// test if level only updated
		$this->object->addLevel('p', 130, 50, 1000);
		$this->assertEquals($this->data[0][PricingLevels::KEY_TYPE], $this->object->getData()[0][PricingLevels::KEY_TYPE]);
		$this->assertNotEquals($this->data[0][PricingLevels::KEY_PRICE], $this->object->getData()[0][PricingLevels::KEY_PRICE]);
		$this->assertEquals(130,  $this->object->getData()[0][PricingLevels::KEY_PRICE]);
		$this->assertFalse(isset($this->object->getData()[1]));

		// test if new level added
		$this->object->addLevel('w', 100, 30, 800);
		$this->assertTrue(isset($this->object->getData()[1]));
		$this->assertEquals(100,  $this->object->getData()[1][PricingLevels::KEY_PRICE]);
	}
}
