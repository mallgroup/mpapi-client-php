<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity\Common;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Dimensions implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private float $weight;
    private float $width;
    private float $height;
    private float $length;

    public function __construct(float $weight = 0, float $width = 0, float $height = 0, float $length = 0)
    {
        $this->weight = $weight;
        $this->width  = $width;
        $this->height = $height;
        $this->length = $length;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (float) $data['weight'],
            (float) $data['width'],
            (float) $data['height'],
            (float) $data['length'],
        );
    }

    /**
     * @return array<string, float>
     */
    public function getArrayForApi(): array
    {
        return [
            'weight' => $this->getWeight(),
            'width'  => $this->getWidth(),
            'height' => $this->getHeight(),
            'length' => $this->getLength(),
        ];
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): void
    {
        $this->weight = $weight;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function setWidth(float $width): void
    {
        $this->width = $width;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function setHeight(float $height): void
    {
        $this->height = $height;
    }

    public function getLength(): float
    {
        return $this->length;
    }

    public function setLength(float $length): void
    {
        $this->length = $length;
    }

}
