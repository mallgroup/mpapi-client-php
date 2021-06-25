<?php declare(strict_types=1);

namespace MpApiClient\Financial\Entity\Invoice;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Bank implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string $iban;
    private string $swift;
    private string $bankName;
    private string $bankAccount;

    private function __construct(string $iban, string $swift, string $bankName, string $bankAccount)
    {
        $this->iban        = $iban;
        $this->swift       = $swift;
        $this->bankName    = $bankName;
        $this->bankAccount = $bankAccount;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (string) $data['iban'],
            (string) $data['swift'],
            (string) $data['bankName'],
            (string) $data['bankAccount'],
        );
    }

    public function getIban(): string
    {
        return $this->iban;
    }

    public function getSwift(): string
    {
        return $this->swift;
    }

    public function getBankName(): string
    {
        return $this->bankName;
    }

    public function getBankAccount(): string
    {
        return $this->bankAccount;
    }

}
