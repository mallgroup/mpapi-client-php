<?php declare(strict_types=1);

namespace MpApiClient\Order\Entity;

use DateTimeInterface;
use Exception;
use JsonSerializable;
use MpApiClient\Common\Util\InputDataUtil;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class BranchesV2 implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private ?string            $branchId;
    private ?string            $secondaryBranchId;
    private ?DateTimeInterface $lastChange;

    private function __construct(?string $branchId, ?string $secondaryBranchId, ?DateTimeInterface $time)
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
            InputDataUtil::getNullableString($data, 'branch_id'),
            InputDataUtil::getNullableString($data, 'secondary_branch_id'),
            InputDataUtil::getNullableDate($data, 'last_change'),
        );
    }

    public function getBranchId(): ?string
    {
        return $this->branchId;
    }

    public function getSecondaryBranchId(): ?string
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
