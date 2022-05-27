<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity;

use Exception;
use MpApiClient\Article\Entity\Common\AbstractArticle;
use MpApiClient\Article\Entity\Common\Availability;
use MpApiClient\Article\Entity\Common\Dimensions;
use MpApiClient\Article\Entity\Common\LabelIterator;
use MpApiClient\Article\Entity\Common\MediaIterator;
use MpApiClient\Article\Entity\Common\OverrideIterator;
use MpApiClient\Article\Entity\Common\PackageSizeEnum;
use MpApiClient\Article\Entity\Common\ParameterIterator;
use MpApiClient\Article\Entity\Common\PromotionIterator;
use MpApiClient\Common\Util\InputDataUtil;

final class Variant extends AbstractArticle
{

    /**
     * @param array<string, mixed> $data
     *
     * @throws Exception
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (string) $data['id'],
            (int) $data['article_id'],
            (string) $data['title'],
            (string) $data['url'],
            (string) $data['shortdesc'],
            (string) $data['longdesc'],
            (int) $data['priority'],
            InputDataUtil::getNullableString($data, 'barcode'),
            (float) $data['price'],
            isset($data['fair_price']) ? (float) $data['fair_price'] : null,
            (float) $data['purchase_price'],
            (float) $data['rrp'],
            MediaIterator::createFromApi($data['media']),
            PromotionIterator::createFromApi($data['promotions']),
            ParameterIterator::createFromApi($data['parameters']),
            Dimensions::createFromApi($data['dimensions']),
            Availability::createFromApi($data['availability']),
            LabelIterator::createFromApi($data['labels']),
            OverrideIterator::createFromApi($data['overrides']),
            $data['recommended'],
            (int) $data['delivery_delay'],
            (bool) $data['free_delivery'],
            new PackageSizeEnum($data['package_size']),
            (bool) $data['mallbox_allowed'],
        );
    }

}
