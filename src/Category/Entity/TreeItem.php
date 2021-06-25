<?php declare(strict_types=1);

namespace MpApiClient\Category\Entity;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class TreeItem implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string               $title;
    private bool                 $categoryVisible;
    private TreeItemIterator     $items;
    private TreeMenuItemIterator $menuItems;

    private function __construct(string $title, bool $categoryVisible, TreeItemIterator $items, TreeMenuItemIterator $menuItems)
    {
        $this->title           = $title;
        $this->categoryVisible = $categoryVisible;
        $this->items           = $items;
        $this->menuItems       = $menuItems;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (string) $data['title'],
            (bool) $data['categoryVisible'],
            TreeItemIterator::createFromApi($data['items']),
            TreeMenuItemIterator::createFromApi($data['menuItems']),
        );
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromMixedApi(array $data): self
    {
        // Ugly hack, because the API does not return a valid tree object (mixes 2 objects into same list)
        // -> new endpoint that returns valid data should be created
        $items     = [];
        $menuItems = [];
        foreach ($data['items'] ?? [] as $item) {
            if (isset($item['menuItemId'])) {
                $menuItems[] = $item;
            } else {
                $items[] = $item;
            }
        }

        return new self(
            (string) $data['title'],
            (bool) $data['categoryVisible'],
            TreeItemIterator::createFromMixedApi($items),
            TreeMenuItemIterator::createFromApi($menuItems),
        );
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function isCategoryVisible(): bool
    {
        return $this->categoryVisible;
    }

    public function getItems(): TreeItemIterator
    {
        return $this->items;
    }

    public function getMenuItems(): TreeMenuItemIterator
    {
        return $this->menuItems;
    }

}
