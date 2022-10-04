<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity\Common;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

abstract class AbstractArticle implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    protected string            $id;
    protected int               $articleId;
    protected string            $title;
    protected string            $url;
    protected string            $shortDesc;
    protected string            $longDesc;
    protected int               $priority;
    protected ?string           $barcode;
    protected float             $price;
    protected ?float            $fairPrice;
    protected float             $purchasePrice;
    protected float             $rrp;
    protected MediaIterator     $media;
    /**
     * @deprecated
     */
    protected PromotionIterator $promotions;
    protected ParameterIterator $parameters;
    protected Dimensions        $dimensions;
    protected Availability      $availability;
    protected LabelIterator     $labels;
    protected OverrideIterator  $overrides;
    /**
     * @var string[]
     */
    protected array           $recommended;
    protected int             $deliveryDelay;
    protected bool            $freeDelivery;
    protected PackageSizeEnum $packageSize;
    protected bool            $mallboxAllowed;

    /**
     * @param string            $id
     * @param int               $articleId
     * @param string            $title
     * @param string            $url
     * @param string            $shortDesc
     * @param string            $longDesc
     * @param int               $priority
     * @param string|null       $barcode
     * @param float             $price
     * @param ?float            $fairPrice
     * @param float             $purchasePrice
     * @param float             $rrp
     * @param MediaIterator     $media
     * @param PromotionIterator $promotions
     * @param ParameterIterator $parameters
     * @param Dimensions        $dimensions
     * @param Availability      $availability
     * @param LabelIterator     $labels
     * @param OverrideIterator  $overrides
     * @param string[]          $recommended
     * @param int               $deliveryDelay
     * @param bool              $freeDelivery
     * @param PackageSizeEnum   $packageSize
     * @param bool              $mallboxAllowed
     */
    protected function __construct(
        string $id,
        int $articleId,
        string $title,
        string $url,
        string $shortDesc,
        string $longDesc,
        int $priority,
        ?string $barcode,
        float $price,
        ?float $fairPrice,
        float $purchasePrice,
        float $rrp,
        MediaIterator $media,
        PromotionIterator $promotions,
        ParameterIterator $parameters,
        Dimensions $dimensions,
        Availability $availability,
        LabelIterator $labels,
        OverrideIterator $overrides,
        array $recommended,
        int $deliveryDelay,
        bool $freeDelivery,
        PackageSizeEnum $packageSize,
        bool $mallboxAllowed
    ) {
        $this->id             = $id;
        $this->articleId      = $articleId;
        $this->title          = $title;
        $this->url            = $url;
        $this->shortDesc      = $shortDesc;
        $this->longDesc       = $longDesc;
        $this->priority       = $priority;
        $this->barcode        = $barcode;
        $this->price          = $price;
        $this->fairPrice      = $fairPrice;
        $this->purchasePrice  = $purchasePrice;
        $this->rrp            = $rrp;
        $this->media          = $media;
        $this->promotions     = $promotions;
        $this->parameters     = $parameters;
        $this->dimensions     = $dimensions;
        $this->availability   = $availability;
        $this->labels         = $labels;
        $this->overrides      = $overrides;
        $this->recommended    = $recommended;
        $this->deliveryDelay  = $deliveryDelay;
        $this->freeDelivery   = $freeDelivery;
        $this->packageSize    = $packageSize;
        $this->mallboxAllowed = $mallboxAllowed;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    abstract public static function createFromApi(array $data): self;

    public function getId(): string
    {
        return $this->id;
    }

    public function getArticleId(): int
    {
        return $this->articleId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getShortDesc(): string
    {
        return $this->shortDesc;
    }

    public function getLongDesc(): string
    {
        return $this->longDesc;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getFairPrice(): ?float
    {
        return $this->fairPrice;
    }

    public function getPurchasePrice(): float
    {
        return $this->purchasePrice;
    }

    public function getRrp(): float
    {
        return $this->rrp;
    }

    public function getMedia(): MediaIterator
    {
        return $this->media;
    }

    /**
     * @deprecated
     */
    public function getPromotions(): PromotionIterator
    {
        return $this->promotions;
    }

    public function getParameters(): ParameterIterator
    {
        return $this->parameters;
    }

    public function getDimensions(): Dimensions
    {
        return $this->dimensions;
    }

    public function getAvailability(): Availability
    {
        return $this->availability;
    }

    public function getLabels(): LabelIterator
    {
        return $this->labels;
    }

    public function getOverrides(): OverrideIterator
    {
        return $this->overrides;
    }

    /**
     * @return string[]
     */
    public function getRecommended(): array
    {
        return $this->recommended;
    }

    public function getDeliveryDelay(): int
    {
        return $this->deliveryDelay;
    }

    public function hasFreeDelivery(): bool
    {
        return $this->freeDelivery;
    }

    public function getPackageSize(): PackageSizeEnum
    {
        return $this->packageSize;
    }

    public function hasMallboxAllowed(): bool
    {
        return $this->mallboxAllowed;
    }

}
