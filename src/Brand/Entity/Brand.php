<?php declare(strict_types=1);

namespace MpApiClient\Brand\Entity;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Brand implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string $brandId;
    private string $title;

    private function __construct(string $brandId, string $title)
    {
        $this->brandId = $brandId;
        $this->title   = $title;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (string) $data['brand_id'],
            (string) $data['title'],
        );
    }

    public function getBrandId(): string
    {
        return $this->brandId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

}
