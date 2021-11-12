<?php declare(strict_types=1);

namespace MpApiClient\Tests\functional;

use Codeception\Util\Fixtures;
use MpApiClient\Category\CategoryClient;
use MpApiClient\Category\Entity\Category;
use MpApiClient\Category\Entity\CategoryIterator;
use MpApiClient\Category\Entity\Parameter;
use MpApiClient\Category\Entity\ParameterValue;
use MpApiClient\Category\Entity\ParameterValueIterator;
use MpApiClient\Category\Entity\TreeItem;
use MpApiClient\Category\Entity\TreeItemIterator;
use MpApiClient\Category\Entity\TreeMenuItem;
use MpApiClient\Category\Entity\TreeMenuItemIterator;
use MpApiClient\Category\Entity\TreeMenuConstraint;
use MpApiClient\Category\Entity\TreeMenuConstraintIterator;
use MpApiClient\Category\Entity\TreeSapCategory;
use MpApiClient\Category\Entity\TreeSapCategoryIterator;
use MpApiClient\Exception\MpApiException;
use MpApiClient\Shop\Entity\ShopIdEnum;
use MpApiClient\Tests\_support\FunctionalTester;

final class CategoryClientCest
{

    private CategoryClient $client;

    public function _before(FunctionalTester $I): void
    {
        // get new client before every test
        $this->client = new CategoryClient($I->getGuzzleClient(), 'category-client-cest');
    }

    /**
     * @throws MpApiException
     */
    public function testList(FunctionalTester $I): void
    {
        $categories = $this->client->list();

        $I->assertInstanceOf(CategoryIterator::class, $categories);

        foreach ($categories as $category) {
            $I->assertInstanceOf(Category::class, $category);
            $I->assertIsString($category->getCategoryId());
            $I->assertIsString($category->getTitle());
        }
    }

    /**
     * @throws MpApiException
     */
    public function testGetParameters(FunctionalTester $I): void
    {
        // Expected parameters to be returned, with all data types set correctly
        $parametersArr = Fixtures::get('categoryParameters');

        $parameters = $this->client->getParameters(Fixtures::get('categoryId'));

        foreach ($parameters as $idx => $parameter) {
            $I->assertInstanceOf(Parameter::class, $parameter);
            $I->assertInstanceOf(ParameterValueIterator::class, $parameter->getValues());

            $I->assertEquals($parametersArr[$idx]['param_id'], $parameter->getParamId());
            $I->assertEquals($parametersArr[$idx]['title'], $parameter->getTitle());
            $I->assertEquals($parametersArr[$idx]['unit'], $parameter->getUnit());
            $I->assertEquals($parametersArr[$idx]['unit'] !== '', $parameter->hasUnit());

            foreach ($parameter->getValues() as $valIdx => $value) {
                $I->assertInstanceOf(ParameterValue::class, $value);
                $I->assertEquals($parametersArr[$idx]['values'][$valIdx]['value'], $value->getValue());
                $I->assertEquals($parametersArr[$idx]['values'][$valIdx]['text'], $value->getText());
            }
        }
    }

    /**
     * @throws MpApiException
     */
    public function testTree(FunctionalTester $I): void
    {
        $tree = $this->client->tree(ShopIdEnum::CZ10MA());

        $I->assertInstanceOf(TreeItemIterator::class, $tree);
        $this->assertTreeItems($I, $tree);
    }

    /*
     * Assertion helpers
     */

    private function assertTreeItems(FunctionalTester $I, TreeItemIterator $items): void
    {
        foreach ($items as $item) {
            $I->assertInstanceOf(TreeItem::class, $item);

            $I->assertIsString($item->getTitle());
            $I->assertIsBool($item->isCategoryVisible());
            $I->assertInstanceOf(TreeItemIterator::class, $item->getItems());
            $I->assertInstanceOf(TreeMenuItemIterator::class, $item->getMenuItems());

            $this->assertTreeItems($I, $item->getItems());
            $this->assertTreeMenuItems($I, $item->getMenuItems());
        }
    }

    private function assertTreeMenuItems(FunctionalTester $I, TreeMenuItemIterator $menuItems): void
    {
        foreach ($menuItems as $menuItem) {
            $I->assertInstanceOf(TreeMenuItem::class, $menuItem);

            $I->assertIsInt($menuItem->getMenuItemId());
            $I->assertIsString($menuItem->getTitle());
            $I->assertIsString($menuItem->getUrl());
            $I->assertIsBool($menuItem->isPhe());
            $I->assertInstanceOf(TreeSapCategoryIterator::class, $menuItem->getSapCategories());

            $this->assertTreeSapCategories($I, $menuItem->getSapCategories());
        }
    }

    private function assertTreeSapCategories(FunctionalTester $I, TreeSapCategoryIterator $sapCategories): void
    {
        foreach ($sapCategories as $sapCategory) {
            $I->assertInstanceOf(TreeSapCategory::class, $sapCategory);

            $I->assertIsString($sapCategory->getOperator());
            $I->assertIsString($sapCategory->getSegment());
            $I->assertIsString($sapCategory->getProductTypeId());
            $I->assertInstanceOf(TreeMenuConstraintIterator::class, $sapCategory->getMenuConstraints());

            $this->assertTreeMenuConstraints($I, $sapCategory->getMenuConstraints());
        }
    }

    private function assertTreeMenuConstraints(FunctionalTester $I, TreeMenuConstraintIterator $menuConstraints): void
    {
        foreach ($menuConstraints as $menuConstraint) {
            $I->assertInstanceOf(TreeMenuConstraint::class, $menuConstraint);

            $I->assertIsString($menuConstraint->getOperator());
            $I->assertIsString($menuConstraint->getParamId());
            $I->assertIsInt($menuConstraint->getClass());
            $I->assertIsString($menuConstraint->getValue1());

            if ($menuConstraint->getValue2() !== null) {
                $I->assertIsString($menuConstraint->getValue2());
            }
        }
    }

}
