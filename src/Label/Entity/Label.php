<?php declare(strict_types=1);

namespace MpApiClient\Label\Entity;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Label implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string $id;
    private string $title;

    private function __construct(string $id, string $title)
    {
        $this->id    = $id;
        $this->title = $title;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (string) $data['id'],
            (string) $data['title'],
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

}
