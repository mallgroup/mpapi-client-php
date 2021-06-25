<?php declare(strict_types=1);

namespace MpApiClient\Financial\Entity\Invoice;

use MpApiClient\Common\Util\JsonSerializeEntityTrait;
use MpApiClient\Financial\Entity\Common\Address;
use MpApiClient\Financial\Entity\Common\Supplier as CommonSupplier;

final class Supplier extends CommonSupplier
{

    use JsonSerializeEntityTrait;

    private Bank $bank;

    private function __construct(string $name, string $registrationNumber, string $taxIdentification, string $vatNumber, string $note, Address $address, Bank $bank)
    {
        parent::__construct($name, $registrationNumber, $taxIdentification, $vatNumber, $note, $address);
        $this->bank = $bank;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (string) $data['name'],
            (string) $data['registrationNumber'],
            (string) $data['taxIdentification'],
            (string) $data['vatNumber'],
            (string) $data['note'],
            Address::createFromApi($data['address']),
            Bank::createFromApi($data['bank']),
        );
    }

    public function getBank(): Bank
    {
        return $this->bank;
    }

}
