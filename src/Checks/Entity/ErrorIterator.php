<?php declare(strict_types=1);

namespace MpApiClient\Checks\Entity;

use MpApiClient\Common\Util\AbstractIntKeyIterator;

/**
 * @extends AbstractIntKeyIterator<Error>
 * @property Error[] $data
 */
final class ErrorIterator extends AbstractIntKeyIterator
{

    private function __construct(Error ...$data)
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
            ...array_map(fn(array $item): Error => Error::createFromApi($item), $data)
        );
    }

    /**
     * @return false|Error
     */
    public function current()
    {
        return current($this->data);
    }

    public function get(int $key): ?Error
    {
        return $this->data[$key] ?? null;
    }

}
