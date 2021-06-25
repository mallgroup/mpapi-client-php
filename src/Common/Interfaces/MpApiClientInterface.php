<?php declare(strict_types=1);

namespace MpApiClient\Common\Interfaces;

use MpApiClient\MpApiClientOptions;

interface MpApiClientInterface
{

    public static function createFromOptions(string $appTag, MpApiClientOptions $options): MpApiClientInterface;

    public function orders(): OrderClientInterface;

    public function article(): ArticleClientInterface;

    public function financial(): FinancialClientInterface;

    public function brand(): BrandClientInterface;

    public function category(): CategoryClientInterface;

    public function checks(): ChecksClientInterface;

    public function shop(): ShopClientInterface;

    public function label(): LabelClientInterface;

    public function supplyDelay(): SupplyDelayClientInterface;

}
