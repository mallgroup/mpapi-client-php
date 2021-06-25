<?php declare(strict_types=1);

namespace MpApiClient\Category\Entity;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Category implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string $categoryId;
    private string $title;

    private function __construct(string $categoryId, string $title)
    {
        $this->categoryId = $categoryId;
        $this->title      = $title;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (string) $data['category_id'],
            (string) $data['title'],
        );
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

}
