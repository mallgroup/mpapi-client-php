<?php declare(strict_types=1);

namespace MpApiClient\Financial\Entity\Common;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Attachment implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string $filename;
    private string $mime;

    private function __construct(string $filename, string $mime)
    {
        $this->filename = $filename;
        $this->mime     = $mime;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (string) $data['filename'],
            (string) $data['mime'],
        );
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getMime(): string
    {
        return $this->mime;
    }

}
