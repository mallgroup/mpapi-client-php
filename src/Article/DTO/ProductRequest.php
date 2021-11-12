<?php declare(strict_types=1);

namespace MpApiClient\Article\DTO;

use MpApiClient\Article\Entity\Product;
use MpApiClient\Article\Entity\Variant;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class ProductRequest extends AbstractArticleRequest
{

    use JsonSerializeEntityTrait;

    private string                 $categoryId;
    private int                    $vat;
    private ?float                 $price = null;
    private VariantRequestIterator $variants;
    /**
     * @var string[]
     */
    private array   $variableParameters = [];
    private ?string $partnerTitle       = null;
    private ?string $brandId            = null;
    private ?float  $weeeFee            = null;

    public function __construct(string $id, string $title, string $shortDesc, string $longDesc, string $categoryId, int $vat, int $priority)
    {
        parent::__construct($id, $title, $shortDesc, $longDesc, $priority);
        $this->categoryId = $categoryId;
        $this->vat        = $vat;

        // All iterators can be empty, even if they are not strictly mandatory (removal of nullability eases the workflow a lot)
        $this->variants = new VariantRequestIterator();
    }

    public static function createFromProduct(Product $product): self
    {
        $self = new self(
            $product->getId(),
            $product->getTitle(),
            $product->getShortDesc(),
            $product->getLongDesc(),
            $product->getCategoryId(),
            $product->getVat(),
            $product->getPriority()
        );

        $self->setBarcode($product->getBarcode());
        $self->setPrice($product->getPrice());
        $self->setPurchasePrice($product->getPurchasePrice());
        $self->setRrp($product->getRrp());
        $self->setMedia($product->getMedia());
        $self->setPromotions($product->getPromotions());
        $self->setParameters($product->getParameters());
        $self->setDimensions($product->getDimensions());
        $self->setAvailability($product->getAvailability());
        $self->setLabels($product->getLabels());
        $self->setRecommended(...$product->getRecommended());
        $self->setDeliveryDelay($product->getDeliveryDelay());
        $self->setFreeDelivery($product->hasFreeDelivery());
        $self->setPackageSize($product->getPackageSize());
        $self->setMallboxAllowed($product->hasMallboxAllowed());
        $self->setVariableParameters(...$product->getVariableParameters());
        $self->setPartnerTitle($product->getPartnerTitle());
        $self->setBrandId($product->getBrandId());
        $self->setWeeeFee($product->getWeeeFee());

        /** @var Variant $variant - PHPStan false positive fix */
        foreach ($product->getVariants() as $variant) {
            $self->getVariants()->add(VariantRequest::createFromVariant($variant));
        }

        return $self;
    }

    /**
     * @return array<string, mixed>
     */
    public function getArrayForApi(): array
    {
        $mandatory = [
            'id'                  => $this->getId(),
            'title'               => $this->getTitle(),
            'shortdesc'           => $this->getShortdesc(),
            'longdesc'            => $this->getLongdesc(),
            'category_id'         => $this->getCategoryId(),
            'vat'                 => $this->getVat(),
            'media'               => $this->getMedia()->getArrayForApi(),
            'promotions'          => $this->getPromotions()->getArrayForApi(),
            'variants'            => $this->getVariants()->getArrayForApi(),
            'parameters'          => $this->getParameters()->getArrayForApi(),
            'variable_parameters' => $this->getVariableParameters(),
        ];

        $optional = array_filter(
            [
                'priority'        => $this->getPriority(),
                'barcode'         => $this->getBarcode(),
                'price'           => $this->getPrice(),
                'purchase_price'  => $this->getPurchasePrice(),
                'rrp'             => $this->getRrp(),
                'dimensions'      => $this->getDimensions() === null ? null : $this->getDimensions()->getArrayForApi(),
                'availability'    => $this->getAvailability() === null ? null : $this->getAvailability()->getArrayForApi(),
                'labels'          => $this->getLabels()->getArrayForApi(),
                'recommended'     => $this->getRecommended(),
                'delivery_delay'  => $this->getDeliveryDelay(),
                'free_delivery'   => $this->getFreeDelivery(),
                'package_size'    => $this->getPackageSize() === null ? null : $this->getPackageSize()->getValue(),
                'mallbox_allowed' => $this->getMallboxAllowed(),
                'partner_title'   => $this->getPartnerTitle(),
                'brand_id'        => $this->getBrandId(),
            ],
            fn($value): bool => !is_null($value)
        );

        return $mandatory + $optional;
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    public function setCategoryId(string $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getVat(): int
    {
        return $this->vat;
    }

    public function setVat(int $vat): void
    {
        $this->vat = $vat;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    public function getVariants(): VariantRequestIterator
    {
        return $this->variants;
    }

    public function setVariants(VariantRequestIterator $variants): void
    {
        $this->variants = $variants;
    }

    /**
     * @return string[]
     */
    public function getVariableParameters(): array
    {
        return $this->variableParameters;
    }

    public function setVariableParameters(string ...$variableParameters): void
    {
        $this->variableParameters = $variableParameters;
    }

    public function getPartnerTitle(): ?string
    {
        return $this->partnerTitle;
    }

    public function setPartnerTitle(?string $partnerTitle): void
    {
        $this->partnerTitle = $partnerTitle;
    }

    public function getBrandId(): ?string
    {
        return $this->brandId;
    }

    public function setBrandId(?string $brandId): void
    {
        $this->brandId = $brandId;
    }

    public function getWeeeFee(): ?float
    {
        return $this->weeeFee;
    }

    public function setWeeeFee(?float $weeeFee): void
    {
        $this->weeeFee = $weeeFee;
    }

}
