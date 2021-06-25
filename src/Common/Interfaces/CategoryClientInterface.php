<?php declare(strict_types=1);

namespace MpApiClient\Common\Interfaces;

use MpApiClient\Category\Entity\CategoryIterator;
use MpApiClient\Category\Entity\ParameterIterator;
use MpApiClient\Category\Entity\TreeItemIterator;
use MpApiClient\Exception\MpApiException;
use MpApiClient\Shop\Entity\ShopIdEnum;

interface CategoryClientInterface
{

    /**
     * @throws MpApiException
     */
    public function list(): CategoryIterator;

    /**
     * @throws MpApiException
     */
    public function getParameters(string $categoryId): ParameterIterator;

    /**
     * @throws MpApiException
     */
    public function tree(ShopIdEnum $shopId): TreeItemIterator;

}
