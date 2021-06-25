<?php declare(strict_types=1);

namespace MpApiClient\Category\Entity;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class TreeSapCategory implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string                     $segment;
    private string                     $productTypeId;
    private string                     $operator;
    private TreeMenuConstraintIterator $menuConstraints;

    private function __construct(string $segment, string $productTypeId, string $operator, TreeMenuConstraintIterator $menuConstraints)
    {
        $this->segment         = $segment;
        $this->productTypeId   = $productTypeId;
        $this->operator        = $operator;
        $this->menuConstraints = $menuConstraints;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (string) $data['segment'],
            (string) $data['productTypeId'],
            (string) $data['operator'],
            TreeMenuConstraintIterator::createFromApi($data['menuConstraints']),
        );
    }

    public function getSegment(): string
    {
        return $this->segment;
    }

    public function getProductTypeId(): string
    {
        return $this->productTypeId;
    }

    public function getOperator(): string
    {
        return $this->operator;
    }

    public function getMenuConstraints(): TreeMenuConstraintIterator
    {
        return $this->menuConstraints;
    }

}
