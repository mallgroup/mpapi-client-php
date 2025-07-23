<?php declare(strict_types=1);

namespace MpApiClient\TaricCode\Entity;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class TaricCode implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            $data['id'],
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

}
