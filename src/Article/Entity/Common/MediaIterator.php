<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity\Common;

use MpApiClient\Common\Util\AbstractIntKeyIterator;

/**
 * @extends AbstractIntKeyIterator<Media>
 * @property Media[] $data
 */
final class MediaIterator extends AbstractIntKeyIterator
{

    public function __construct(Media ...$data)
    {
        $this->data = $data;
    }

    /**
     * @param array<int, array<string, mixed>> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            ...array_map(fn(array $item): Media => Media::createFromApi($item), $data)
        );
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getArrayForApi(): array
    {
        return array_map(fn(Media $media): array => $media->getArrayForApi(), array_values($this->data));
    }

    /**
     * @return false|Media
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(int $key): ?Media
    {
        return $this->data[$key] ?? null;
    }

    public function remove(int $key): void
    {
        parent::remove($key);
    }

    public function removeByUrl(string $url): void
    {
        $this->data = array_filter($this->data, fn(Media $media): bool => $media->getUrl() !== $url);
    }

    public function add(Media $value): void
    {
        $this->data[] = $value;
    }

}
