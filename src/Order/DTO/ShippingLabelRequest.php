<?php declare(strict_types=1);

namespace MpApiClient\Order\DTO;

final class ShippingLabelRequest
{

    public const TYPE_PDF = 'pdf';
    public const TYPE_ZPL = 'zpl';

    private string $labelType;
    private int    $firstPosition;
    private int    $labelsPerPage;
    /**
     * @var array<int, int>
     */
    private array $labels = [];

    public function __construct(string $labelType, int $firstPosition, int $labelsPerPage)
    {
        $this->labelType     = $labelType;
        $this->firstPosition = $firstPosition;
        $this->labelsPerPage = $labelsPerPage;
    }

    /**
     * @return array<string, mixed>
     */
    public function getArrayForApi(): array
    {
        $labels = [];
        foreach ($this->getLabels() as $orderId => $parcelCount) {
            $labels[] = ['order_id' => $orderId, 'parcel_count' => $parcelCount];
        }

        return [
            'labels_type'     => $this->getLabelType(),
            'first_position'  => $this->getFirstPosition(),
            'labels_per_page' => $this->getLabelsPerPage(),
            'labels'          => $labels,
        ];
    }

    public function addLabel(int $orderId, int $parcelCount): void
    {
        $this->labels[$orderId] = $parcelCount;
    }

    public function removeLabel(int $orderId): void
    {
        if (isset($this->labels[$orderId])) {
            unset($this->labels[$orderId]);
        }
    }

    public function getLabelType(): string
    {
        return $this->labelType;
    }

    public function getFirstPosition(): int
    {
        return $this->firstPosition;
    }

    public function getLabelsPerPage(): int
    {
        return $this->labelsPerPage;
    }

    /**
     * @return array<int, int>
     */
    public function getLabels(): array
    {
        return $this->labels;
    }

}
