<?php declare(strict_types=1);

namespace MpApiClient\Article\DTO;

use JsonSerializable;
use MpApiClient\Article\Entity\Common\Availability;
use MpApiClient\Article\Entity\Common\Dimensions;
use MpApiClient\Article\Entity\Common\LabelIterator;
use MpApiClient\Article\Entity\Common\MediaIterator;
use MpApiClient\Article\Entity\Common\PackageSizeEnum;
use MpApiClient\Article\Entity\Common\ParameterIterator;
use MpApiClient\Article\Entity\Common\PromotionIterator;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

abstract class AbstractArticleRequest implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    protected string            $id;
    protected string            $title;
    protected string            $shortDesc;
    protected string            $longDesc;
    protected int               $priority;
    protected ?string           $barcode       = null;
    protected ?float            $purchasePrice = null;
    protected ?float            $rrp           = null;
    protected MediaIterator     $media;
    /** @deprecated */
    protected PromotionIterator $promotions;
    protected ParameterIterator $parameters;
    protected LabelIterator     $labels;
    protected ?Dimensions       $dimensions    = null;
    protected ?Availability     $availability  = null;
    /**
     * @var string[]
     */
    protected array            $recommended    = [];
    protected ?int             $deliveryDelay  = null;
    protected ?bool            $freeDelivery   = null;
    protected ?PackageSizeEnum $packageSize    = null;
    protected ?bool            $mallboxAllowed = null;

    public function __construct(string $id, string $title, string $shortDesc, string $longDesc, int $priority)
    {
        $this->id        = $id;
        $this->title     = $title;
        $this->shortDesc = $shortDesc;
        $this->longDesc  = $longDesc;
        $this->priority  = $priority;

        // All iterators can be empty, even if they are not strictly mandatory (removal of nullability eases the workflow a lot)
        $this->media      = new MediaIterator();
        $this->promotions = new PromotionIterator();
        $this->parameters = new ParameterIterator();
        $this->labels     = new LabelIterator();
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getShortDesc(): string
    {
        return $this->shortDesc;
    }

    public function setShortDesc(string $shortDesc): void
    {
        $this->shortDesc = $shortDesc;
    }

    public function getLongDesc(): string
    {
        return $this->longDesc;
    }

    public function setLongDesc(string $longDesc): void
    {
        $this->longDesc = $longDesc;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(?string $barcode): void
    {
        $this->barcode = $barcode;
    }

    public function getPurchasePrice(): ?float
    {
        return $this->purchasePrice;
    }

    public function setPurchasePrice(?float $purchasePrice): void
    {
        $this->purchasePrice = $purchasePrice;
    }

    public function getRrp(): ?float
    {
        return $this->rrp;
    }

    public function setRrp(?float $rrp): void
    {
        $this->rrp = $rrp;
    }

    public function getMedia(): MediaIterator
    {
        return $this->media;
    }

    public function setMedia(MediaIterator $media): void
    {
        $this->media = $media;
    }

    /**
     * @deprecated
     */
    public function getPromotions(): PromotionIterator
    {
        return $this->promotions;
    }

    /**
     * @deprecated
     */
    public function setPromotions(PromotionIterator $promotions): void
    {
        $this->promotions = $promotions;
    }

    public function getParameters(): ParameterIterator
    {
        return $this->parameters;
    }

    public function setParameters(ParameterIterator $parameters): void
    {
        $this->parameters = $parameters;
    }

    public function getLabels(): LabelIterator
    {
        return $this->labels;
    }

    public function setLabels(LabelIterator $labels): void
    {
        $this->labels = $labels;
    }

    /**
     * @psalm-mutation-free
     */
    public function getDimensions(): ?Dimensions
    {
        return $this->dimensions;
    }

    public function setDimensions(?Dimensions $dimensions): void
    {
        $this->dimensions = $dimensions;
    }

    /**
     * @psalm-mutation-free
     */
    public function getAvailability(): ?Availability
    {
        return $this->availability;
    }

    public function setAvailability(?Availability $availability): void
    {
        $this->availability = $availability;
    }

    /**
     * @return string[]
     */
    public function getRecommended(): array
    {
        return $this->recommended;
    }

    public function setRecommended(string ...$recommended): void
    {
        $this->recommended = $recommended;
    }

    public function getDeliveryDelay(): ?int
    {
        return $this->deliveryDelay;
    }

    public function setDeliveryDelay(?int $deliveryDelay): void
    {
        $this->deliveryDelay = $deliveryDelay;
    }

    public function getFreeDelivery(): ?bool
    {
        return $this->freeDelivery;
    }

    public function setFreeDelivery(?bool $freeDelivery): void
    {
        $this->freeDelivery = $freeDelivery;
    }

    /**
     * @psalm-mutation-free
     */
    public function getPackageSize(): ?PackageSizeEnum
    {
        return $this->packageSize;
    }

    public function setPackageSize(?PackageSizeEnum $packageSize): void
    {
        $this->packageSize = $packageSize;
    }

    public function getMallboxAllowed(): ?bool
    {
        return $this->mallboxAllowed;
    }

    public function setMallboxAllowed(?bool $mallboxAllowed): void
    {
        $this->mallboxAllowed = $mallboxAllowed;
    }

}
