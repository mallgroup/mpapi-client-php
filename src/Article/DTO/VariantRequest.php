<?php declare(strict_types=1);

namespace MpApiClient\Article\DTO;

use MpApiClient\Article\Entity\Common\MediaIterator;
use MpApiClient\Article\Entity\Common\ParameterIterator;
use MpApiClient\Article\Entity\Variant;

final class VariantRequest extends AbstractArticleRequest
{

    private float $price;

    public function __construct(
        string $id,
        string $title,
        string $shortDesc,
        string $longDesc,
        int $priority,
        float $price,
        MediaIterator $media,
        ParameterIterator $parameters
    ) {
        parent::__construct($id, $title, $shortDesc, $longDesc, $priority);
        $this->price      = $price;
        $this->media      = $media;
        $this->parameters = $parameters;
    }

    public static function createFromVariant(Variant $variant): self
    {
        $self = new self(
            $variant->getId(),
            $variant->getTitle(),
            $variant->getShortDesc(),
            $variant->getLongDesc(),
            $variant->getPriority(),
            $variant->getPrice(),
            $variant->getMedia(),
            $variant->getParameters(),
        );

        $self->setBarcode($variant->getBarcode());
        $self->setPurchasePrice($variant->getPurchasePrice());
        $self->setRrp($variant->getRrp());
        $self->setPromotions($variant->getPromotions());
        $self->setDimensions($variant->getDimensions());
        $self->setAvailability($variant->getAvailability());
        $self->setLabels($variant->getLabels());
        $self->setRecommended(...$variant->getRecommended());
        $self->setDeliveryDelay($variant->getDeliveryDelay());
        $self->setFreeDelivery($variant->hasFreeDelivery());
        $self->setPackageSize($variant->getPackageSize());
        $self->setMallboxAllowed($variant->hasMallboxAllowed());

        return $self;
    }

    /**
     * @return array<string, mixed>
     */
    public function getArrayForApi(): array
    {
        $mandatory = [
            'id'         => $this->getId(),
            'title'      => $this->getTitle(),
            'shortdesc'  => $this->getShortdesc(),
            'longdesc'   => $this->getLongdesc(),
            'media'      => $this->getMedia()->getArrayForApi(),
            'parameters' => $this->getParameters()->getArrayForApi(),
            'promotions' => $this->getPromotions()->getArrayForApi(),
            'priority'   => $this->getPriority(),
            'price'      => $this->getPrice(),
        ];

        $optional = array_filter(
            [
                'barcode'         => $this->getBarcode(),
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
            ],
            fn($value): bool => !is_null($value)
        );

        return array_merge($mandatory, $optional);
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

}
