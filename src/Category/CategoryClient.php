<?php declare(strict_types=1);

namespace MpApiClient\Category;

use MpApiClient\Category\Entity\CategoryIterator;
use MpApiClient\Category\Entity\ParameterIterator;
use MpApiClient\Category\Entity\TreeItemIterator;
use MpApiClient\Common\AbstractMpApiClient;
use MpApiClient\Common\Interfaces\CategoryClientInterface;
use MpApiClient\Shop\Entity\ShopIdEnum;

final class CategoryClient extends AbstractMpApiClient implements CategoryClientInterface
{

    private const LIST       = '/v1/categories';
    private const PARAMETERS = '/v1/categories/%s/parameters';
    private const TREE       = '/v1/categories/tree/%s';

    public function list(): CategoryIterator
    {
        return CategoryIterator::createFromApi($this->sendJson('GET', self::LIST)['data']);
    }

    public function getParameters(string $categoryId): ParameterIterator
    {
        return ParameterIterator::createFromApi($this->sendJson('GET', sprintf(self::PARAMETERS, $categoryId))['data']);
    }

    public function tree(ShopIdEnum $shopId): TreeItemIterator
    {
        return TreeItemIterator::createFromMixedApi(
            $this->sendJson('GET', sprintf(self::TREE, $shopId->getValue()))['data']
        );
    }

}
