<?php declare(strict_types=1);

namespace MpApiClient\Common\DTO;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Paging implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private int $total;
    private int $pages;
    private int $size;
    private int $page;

    private function __construct(int $total, int $pages, int $size, int $page)
    {
        $this->total = $total;
        $this->pages = $pages;
        $this->size  = $size;
        $this->page  = $page;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (int) $data['total'],
            (int) $data['pages'],
            (int) $data['size'],
            (int) $data['page'],
        );
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getPages(): int
    {
        return $this->pages;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getPage(): int
    {
        return $this->page;
    }

}
