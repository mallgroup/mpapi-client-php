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

final class Product extends AbstractArticle
{

    protected ProductStageEnum $stage;
    protected string           $categoryId;
    protected float            $vat;
    protected VariantIterator  $variants;
    /**
     * @var string[]
     */
    protected array   $variableParameters;
    protected ?string $partnerTitle;
    protected ?string $brandId;
    protected ?float  $weeeFee;

    /**
     * @psalm-suppress DeprecatedClass
     * @param string            $id
     * @param int               $articleId
     * @param ProductStageEnum  $stage
     * @param string            $title
     * @param string            $url
     * @param string            $shortDesc
     * @param string            $longDesc
     * @param string            $categoryId
     * @param int               $priority
     * @param string|null       $barcode
     * @param float             $price
     * @param ?float            $fairPrice
     * @param float             $purchasePrice
     * @param float             $vat
     * @param float             $rrp
     * @param MediaIterator     $media
     * @param PromotionIterator $promotions
     * @param VariantIterator   $variants
     * @param ParameterIterator $parameters
     * @param string[]          $variableParameters
     * @param Dimensions        $dimensions
     * @param Availability      $availability
     * @param LabelIterator     $labels
     * @param OverrideIterator  $overrides
     * @param string[]          $recommended
     * @param int               $deliveryDelay
     * @param bool              $freeDelivery
     * @param PackageSizeEnum   $packageSize
     * @param bool              $mallboxAllowed
     * @param string|null       $partnerTitle
     * @param string|null       $brandId
     * @param float|null        $weeeFee
     */
    private function __construct(
        string $id,
        int $articleId,
        ProductStageEnum $stage,
        string $title,
        string $url,
        string $shortDesc,
        string $longDesc,
        string $categoryId,
        int $priority,
        ?string $barcode,
        float $price,
        ?float $fairPrice,
        float $purchasePrice,
        float $vat,
        float $rrp,
        MediaIterator $media,
        PromotionIterator $promotions,
        VariantIterator $variants,
        ParameterIterator $parameters,
        array $variableParameters,
        Dimensions $dimensions,
        Availability $availability,
        LabelIterator $labels,
        OverrideIterator $overrides,
        array $recommended,
        int $deliveryDelay,
        bool $freeDelivery,
        PackageSizeEnum $packageSize,
        bool $mallboxAllowed,
        ?string $partnerTitle,
        ?string $brandId,
        ?float $weeeFee
    ) {
        parent::__construct(
            $id,
            $articleId,
            $title,
            $url,
            $shortDesc,
            $longDesc,
            $priority,
            $barcode,
            $price,
            $fairPrice,
            $purchasePrice,
            $rrp,
            $media,
            $promotions,
            $parameters,
            $dimensions,
            $availability,
            $labels,
            $overrides,
            $recommended,
            $deliveryDelay,
            $freeDelivery,
            $packageSize,
            $mallboxAllowed
        );
        $this->stage              = $stage;
        $this->categoryId         = $categoryId;
        $this->vat                = $vat;
        $this->variants           = $variants;
        $this->variableParameters = $variableParameters;
        $this->partnerTitle       = $partnerTitle;
        $this->brandId            = $brandId;
        $this->weeeFee            = $weeeFee;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @throws Exception
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        /** @psalm-suppress DeprecatedClass */
        return new self(
            (string) $data['id'],
            (int) $data['article_id'],
            new ProductStageEnum((string) $data[ProductStageEnum::KEY_NAME]),
            (string) $data['title'],
            (string) $data['url'],
            (string) $data['shortdesc'],
            (string) $data['longdesc'],
            (string) $data['category_id'],
            (int) $data['priority'],
            InputDataUtil::getNullableString($data, 'barcode'),
            (float) $data['price'],
            isset($data['fair_price']) ? (float)$data['fair_price'] : null,
            (float) $data['purchase_price'],
            (float) $data['vat'],
            (float) $data['rrp'],
            MediaIterator::createFromApi($data['media']),
            PromotionIterator::createFromApi($data['promotions']),
            VariantIterator::createFromApi($data['variants']),
            ParameterIterator::createFromApi($data['parameters']),
            $data['variable_parameters'],
            Dimensions::createFromApi($data['dimensions']),
            Availability::createFromApi($data['availability']),
            LabelIterator::createFromApi($data['labels']),
            OverrideIterator::createFromApi($data['overrides']),
            $data['recommended'],
            (int) $data['delivery_delay'],
            (bool) $data['free_delivery'],
            new PackageSizeEnum($data['package_size']),
            (bool) $data['mallbox_allowed'],
            InputDataUtil::getNullableString($data, 'partner_title'),
            InputDataUtil::getNullableString($data, 'brand_id'),
            InputDataUtil::getNullableFloat($data, 'weee_fee'),
        );
    }

    public function getStage(): ProductStageEnum
    {
        return $this->stage;
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    public function getVat(): float
    {
        return $this->vat;
    }

    public function getVariants(): VariantIterator
    {
        return $this->variants;
    }

    /**
     * @return string[]
     */
    public function getVariableParameters(): array
    {
        return $this->variableParameters;
    }

    public function getPartnerTitle(): ?string
    {
        return $this->partnerTitle;
    }

    public function getBrandId(): ?string
    {
        return $this->brandId;
    }

    public function getWeeeFee(): ?float
    {
        return $this->weeeFee;
    }

}
