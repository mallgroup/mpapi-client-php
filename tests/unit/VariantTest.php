<?php
namespace MPAPI\Tests\Unit;

use Codeception\Util\Fixtures;
use MPAPI\Entity\Products\Variant;

/**
 * Test variant entity
 *
 * @author jonas.habr@mall.cz
 */
class VariantTest extends \Codeception\Test\Unit
{

	/**
	 *
	 * @var Variant
	 */
	private $object;

	protected $data;

	protected function _before()
	{
		$this->object = new Variant(Fixtures::get('variant'));
	}

	protected function _after()
	{
		unset($this->object);
	}

	public function testGetData()
	{
		$this->assertNotEmpty($this->object->getData());
	}

	public function testGetId()
	{
		$this->assertNotEmpty($this->object->getId());
	}

	public function testSetId()
	{
		$oldValue = Fixtures::get('variant')['id'];
		$this->assertEquals($oldValue, $this->object->getId());
		$newValue = $oldValue . '4';
		$this->object->setId($newValue);
		$this->assertEquals($newValue, $this->object->getId());
	}

	public function testGetArticleId()
	{
		$this->assertNotEmpty($this->object->getArticleId());
	}

	public function testGetTitle()
	{
		$this->assertNotEmpty($this->object->getTitle());
	}

	public function testSetTitle()
	{
		$oldValue = Fixtures::get('variant')['title'];
		$this->assertEquals($oldValue, $this->object->getTitle());
		$newValue = $oldValue . ' updated';
		$this->object->setTitle($newValue);
		$this->assertEquals($newValue, $this->object->getTitle());
	}

	public function testGetShortdesc()
	{
		$this->assertNotEmpty($this->object->getShortdesc());
	}

	public function testSetShortdesc()
	{
		$oldValue = Fixtures::get('variant')['shortdesc'];
		$this->assertEquals($oldValue, $this->object->getShortdesc());
		$newValue = $oldValue . ' updated';
		$this->object->setShortdesc($newValue);
		$this->assertEquals($newValue, $this->object->getShortdesc());
	}

	public function testGetLongdesc()
	{
		$this->assertNotEmpty($this->object->getLongdesc());
	}

	public function testSetLongdesc()
	{
		$oldValue = Fixtures::get('variant')['longdesc'];
		$this->assertEquals($oldValue, $this->object->getLongdesc());
		$newValue = $oldValue . ' updated';
		$this->object->setLongdesc($newValue);
		$this->assertEquals($newValue, $this->object->getLongdesc());
	}

	public function testGetPriority()
	{
		$this->assertNotEmpty($this->object->getPriority());
	}

	public function testSetPriority()
	{
		$oldValue = Fixtures::get('variant')['priority'];
		$this->assertEquals($oldValue, $this->object->getPriority());
		$newValue = $oldValue + 1;
		$this->object->setPriority($newValue);
		$this->assertEquals($newValue, $this->object->getPriority());
	}

	public function testGetBarcode()
	{
		$this->assertNotEmpty($this->object->getBarcode());
	}

	public function testSetBarcode()
	{
		$oldValue = Fixtures::get('variant')['barcode'];
		$this->assertEquals($oldValue, $this->object->getBarcode());
		$newValue = $oldValue + 1;
		$this->object->setBarcode($newValue);
		$this->assertEquals($newValue, $this->object->getBarcode());
	}

	public function testGetPrice()
	{
		$this->assertNotEmpty($this->object->getPrice());
	}

	public function testSetPrice()
	{
		$oldValue = Fixtures::get('variant')['price'];
		$this->assertEquals($oldValue, $this->object->getPrice());
		$newValue = $oldValue + 1;
		$this->object->setPrice($newValue);
		$this->assertEquals($newValue, $this->object->getPrice());
	}

	public function testGetRrpPrice()
	{
		$this->assertNotEmpty($this->object->getRrpPrice());
	}

	public function testSetRrpPrice()
	{
		$oldValue = Fixtures::get('variant')['rrp'];
		$this->assertEquals($oldValue, $this->object->getRrpPrice());
		$newValue = $oldValue + 1;
		$this->object->setRrpPrice($newValue);
		$this->assertEquals($newValue, $this->object->getRrpPrice());
	}

	public function testGetParameters()
	{
		$this->assertNotEmpty($this->object->getParameters());
		$this->assertTrue(is_array($this->object->getParameters()));
	}

	public function testSetParameter()
	{
		$this->object->setParameter('MP_COLOR', ['blue','red']);
		$this->assertArrayHasKey('MP_COLOR', $this->object->getParameters());
	}

	public function testAddParameter()
	{
		$this->assertNotContains('MP_COLOR', array_keys($this->object->getParameters()));
		$this->object->addParameter('MP_COLOR', 'white');
		$this->assertArrayHasKey('MP_COLOR', $this->object->getParameters());
	}

	public function testGetLabels()
	{
		$this->assertEmpty($this->object->getLabels());
	}

	public function testSetLabels()
	{
		$this->assertEmpty($this->object->getLabels());
		$labels = Fixtures::get('labels');
		$this->object->setLabels($labels);
		$this->assertNotEmpty($this->object->getLabels());
	}

	public function testAddLabel()
	{
		$this->assertEmpty($this->object->getLabels());
		$this->object->addLabel('FREE-DELIVERY', '2018-02-01 00:00:00', '2020-04-01 00:00:00');
		$this->assertNotEmpty($this->object->getLabels());
		$this->assertTrue(is_array($this->object->getLabels()));
		$this->assertArrayHasKey('label', $this->object->getLabels()[0]);
		$this->assertEquals('FREE-DELIVERY', $this->object->getLabels()[0]['label']);
	}

	public function testGetMedia()
	{
		$media = $this->object->getMedia();
		$this->assertNotEmpty($media);
		$this->assertTrue($media[0]['main']);
		$this->assertEquals(Fixtures::get('variant')['media'][0]['switch'], $media[0]['switch']);
	}

	public function testSetMedia()
	{
		$this->object->setMedia([]);
		$this->assertEmpty($this->object->getMedia());
		$media = Fixtures::get('media');
		$this->object->setMedia($media);
		$this->assertNotEmpty($this->object->getMedia());
		$this->assertArrayHasKey('url', $this->object->getMedia()[2]);
		$this->assertFalse($this->object->getMedia()[2]['main']);
		$this->assertTrue($this->object->getMedia()[2]['switch']);
	}

	public function testMainMedia()
	{
		$media = Fixtures::get('media');
		$expectedMedia = Fixtures::get('mainMedia');
		$this->object->setMedia([]);
		$this->assertEmpty($this->object->getMedia());
		$this->object->addMedia($media[0]['url'], $media[0]['main']);
		$this->assertEquals($expectedMedia, current($this->object->getMedia()));
	}

	public function testOrdinaryMedia()
	{
		$media = Fixtures::get('media');
		$expectedMedia = Fixtures::get('ordinaryMedia');
		$this->object->setMedia([]);
		$this->assertEmpty($this->object->getMedia());
		$this->object->addMedia($media[1]['url']);
		$this->assertEquals($expectedMedia, current($this->object->getMedia()));
	}

	public function testColorSwitchMedia()
	{
		$media = Fixtures::get('media');
		$this->object->setMedia([]);
		$this->assertEmpty($this->object->getMedia());
		$this->object->addMedia($media[2]['url'], $media[2]['main'], $media[2]['switch']);
		$this->assertEquals($media[2], current($this->object->getMedia()));
	}

	public function testGetPromotions()
	{
		$this->assertEmpty($this->object->getPromotions());
	}

	public function testSetPromotions()
	{
		$this->assertEmpty($this->object->getPromotions());
		$promotions = Fixtures::get('promotions');
		$this->object->setPromotions($promotions);
		$this->assertNotEmpty($this->object->getPromotions());
		$this->assertArrayHasKey('price', $this->object->getPromotions());
	}

	public function testAddPromotions()
	{
		$this->assertEmpty($this->object->getPromotions());
		$this->object->addPromotion(135, '2027-10-11 00:00:00', '2027-10-11 23:59:59');
		$this->assertArrayHasKey('price', $this->object->getPromotions()[0]);
	}

	public function testGetDimensions()
	{
		$this->assertEmpty($this->object->getDimensions());
	}

	public function testAddDimensions()
	{
		$this->assertArrayNotHasKey('width', $this->object->getDimensions());
		$this->object->addDimensions(100, 200, 300, 400);
		$this->assertArrayHasKey('width', $this->object->getDimensions());
	}

	public function testGetAvailability()
	{
		$this->assertContains('status', array_keys($this->object->getAvailability()));
		$this->assertContains('in_stock', array_keys($this->object->getAvailability()));
	}

	public function testSetInStock()
	{
		$oldValue = $this->object->getAvailability()['in_stock'];
		$this->object->setInStock(3);
		$newValue = $this->object->getAvailability()['in_stock'];
		$this->assertNotEquals($oldValue, $newValue);
	}

	public function testSetStatus()
	{
		$oldValue = $this->object->getAvailability()['status'];
		$this->object->setStatus('N');
		$newValue = $this->object->getAvailability()['status'];
		$this->assertNotEquals($oldValue, $newValue);
	}

	public function testGetRecommended()
	{
		$this->assertEmpty($this->object->getRecommended());
	}

	public function testSetRecommended()
	{
		$this->assertEmpty($this->object->getRecommended());
		$this->object->setRecommended(['V-id-R-01', 'V-id-R-02']);
		$this->assertNotEmpty($this->object->getRecommended());
	}

	public function testAddRecommended()
	{
		$this->assertEmpty($this->object->getRecommended());
		$this->object->addRecommended(['V-id-R-03']);
		$this->assertNotEmpty($this->object->getRecommended());
	}

	public function testGetDeliveryDelay()
	{
		$this->assertNotEmpty($this->object->getDeliveryDelay());
	}

	public function testSetDeliveryDelay()
	{
		$oldDelay = Fixtures::get('variant')['delivery_delay'];
		$this->assertEquals($oldDelay, $this->object->getDeliveryDelay());
		$newDelay = $oldDelay + 1;
		$this->object->setDeliveryDelay($newDelay);
		$this->assertEquals($newDelay, $this->object->getDeliveryDelay());
	}

	public function testHasFreeDelivery()
	{
		$this->assertFalse($this->object->hasFreeDelivery());
	}

	public function testSetFreeDelivery()
	{
		$this->object->setFreeDelivery(true);
		$this->assertTrue($this->object->hasFreeDelivery());
	}
}
