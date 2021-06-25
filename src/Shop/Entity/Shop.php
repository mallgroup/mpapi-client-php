<?php declare(strict_types=1);

namespace MpApiClient\Shop\Entity;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Shop implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private ShopIdEnum $shopId;
    private string     $countryId;
    private string     $name;
    private string     $currencyIso;
    private string     $currencySymbol;
    private string     $url;

    private function __construct(ShopIdEnum $shopId, string $countryId, string $name, string $currencyIso, string $currencySymbol, string $url)
    {
        $this->shopId         = $shopId;
        $this->countryId      = $countryId;
        $this->name           = $name;
        $this->currencyIso    = $currencyIso;
        $this->currencySymbol = $currencySymbol;
        $this->url            = $url;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            new ShopIdEnum((string) $data['shop_id']),
            (string) $data['country_id'],
            (string) $data['name'],
            (string) $data['currency_iso'],
            (string) $data['currency_symbol'],
            (string) $data['url'],
        );
    }

    public function getShopId(): ShopIdEnum
    {
        return $this->shopId;
    }

    public function getCountryId(): string
    {
        return $this->countryId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCurrencyIso(): string
    {
        return $this->currencyIso;
    }

    public function getCurrencySymbol(): string
    {
        return $this->currencySymbol;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

}
