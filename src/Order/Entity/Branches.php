<?php declare(strict_types=1);

namespace MpApiClient\Order\Entity;

use DateTimeInterface;
use Exception;
use JsonSerializable;
use MpApiClient\Common\Util\InputDataUtil;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Branches implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private ?int               $branchId;
    private ?int               $secondaryBranchId;
    private ?DateTimeInterface $lastChange;

    private function __construct(?int $branchId, ?int $secondaryBranchId, ?DateTimeInterface $time)
    {
        $this->branchId          = $branchId;
        $this->secondaryBranchId = $secondaryBranchId;
        $this->lastChange        = $time;
    }

    /**
     * @param array<string, mixed> $data
     * @throws Exception
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            InputDataUtil::getNullableInt($data, 'branch_id'),
            InputDataUtil::getNullableInt($data, 'secondary_branch_id'),
            InputDataUtil::getNullableDate($data, 'last_change'),
        );
    }

    public function getBranchId(): ?int
    {
        return $this->branchId;
    }

    public function getSecondaryBranchId(): ?int
    {
        return $this->secondaryBranchId;
    }

    public function getLastChange(): ?DateTimeInterface
    {
        return $this->lastChange;
    }

    public function isOverridden(): bool
    {
        return $this->getSecondaryBranchId() !== null;
    }

}
