<?php declare(strict_types=1);

namespace MpApiClient;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use MpApiClient\Article\ArticleClient;
use MpApiClient\Brand\BrandClient;
use MpApiClient\Category\CategoryClient;
use MpApiClient\Checks\ChecksClient;
use MpApiClient\Common\Interfaces\ArticleClientInterface;
use MpApiClient\Common\Interfaces\BrandClientInterface;
use MpApiClient\Common\Interfaces\CategoryClientInterface;
use MpApiClient\Common\Interfaces\ChecksClientInterface;
use MpApiClient\Common\Interfaces\ClientInterface;
use MpApiClient\Common\Interfaces\FinancialClientInterface;
use MpApiClient\Common\Interfaces\LabelClientInterface;
use MpApiClient\Common\Interfaces\MpApiClientInterface;
use MpApiClient\Common\Interfaces\OrderClientInterface;
use MpApiClient\Common\Interfaces\ShopClientInterface;
use MpApiClient\Common\Interfaces\SupplyDelayClientInterface;
use MpApiClient\Financial\FinancialClient;
use MpApiClient\Label\LabelClient;
use MpApiClient\Order\OrderClient;
use MpApiClient\Shop\ShopClient;
use MpApiClient\SupplyDelay\SupplyDelayClient;

final class MpApiClient implements ClientInterface, MpApiClientInterface
{

    const APP_NAME    = 'mp-api-client';
    const APP_VERSION = '4.1.1';

    private BrandClientInterface       $brandClient;
    private CategoryClientInterface    $categoryClient;
    private ChecksClientInterface      $checksClient;
    private FinancialClientInterface   $financialClient;
    private LabelClientInterface       $labelClient;
    private OrderClientInterface       $ordersClient;
    private ArticleClientInterface     $articleClient;
    private ShopClientInterface        $shopClient;
    private SupplyDelayClientInterface $supplyDelayClient;

    public function __construct(GuzzleClientInterface $client, string $appTag)
    {
        $this->brandClient       = new BrandClient($client, $appTag);
        $this->categoryClient    = new CategoryClient($client, $appTag);
        $this->checksClient      = new ChecksClient($client, $appTag);
        $this->financialClient   = new FinancialClient($client, $appTag);
        $this->labelClient       = new LabelClient($client, $appTag);
        $this->ordersClient      = new OrderClient($client, $appTag);
        $this->articleClient     = new ArticleClient($client, $appTag);
        $this->shopClient        = new ShopClient($client, $appTag);
        $this->supplyDelayClient = new SupplyDelayClient($client, $appTag);
    }

    public static function createFromOptions(string $appTag, MpApiClientOptions $options): self
    {
        return new self(new GuzzleClient($options->getGuzzleOptionsArray()), $appTag);
    }

    public function orders(): OrderClientInterface
    {
        return $this->ordersClient;
    }

    public function article(): ArticleClientInterface
    {
        return $this->articleClient;
    }

    public function financial(): FinancialClientInterface
    {
        return $this->financialClient;
    }

    public function brand(): BrandClientInterface
    {
        return $this->brandClient;
    }

    public function category(): CategoryClientInterface
    {
        return $this->categoryClient;
    }

    public function checks(): ChecksClientInterface
    {
        return $this->checksClient;
    }

    public function shop(): ShopClientInterface
    {
        return $this->shopClient;
    }

    public function label(): LabelClientInterface
    {
        return $this->labelClient;
    }

    public function supplyDelay(): SupplyDelayClientInterface
    {
        return $this->supplyDelayClient;
    }

}
