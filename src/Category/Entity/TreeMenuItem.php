<?php declare(strict_types=1);

namespace MpApiClient\Category\Entity;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class TreeMenuItem implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private int                     $menuItemId;
    private string                  $title;
    private bool                    $categoryVisible;
    private TreeSapCategoryIterator $sapCategories;
    private string                  $url;
    private bool                    $isPhe;

    private function __construct(int $menuItemId, string $title, bool $categoryVisible, TreeSapCategoryIterator $sapCategories, string $url, bool $isPhe)
    {
        $this->menuItemId      = $menuItemId;
        $this->title           = $title;
        $this->categoryVisible = $categoryVisible;
        $this->sapCategories   = $sapCategories;
        $this->url             = $url;
        $this->isPhe           = $isPhe;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (int) $data['menuItemId'],
            (string) $data['title'],
            (bool) $data['categoryVisible'],
            TreeSapCategoryIterator::createFromApi($data['sapCategories']),
            (string) $data['url'],
            (bool) $data['isPhe'],
        );
    }

    public function getMenuItemId(): int
    {
        return $this->menuItemId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function isCategoryVisible(): bool
    {
        return $this->categoryVisible;
    }

    public function getSapCategories(): TreeSapCategoryIterator
    {
        return $this->sapCategories;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function isPhe(): bool
    {
        return $this->isPhe;
    }

}
