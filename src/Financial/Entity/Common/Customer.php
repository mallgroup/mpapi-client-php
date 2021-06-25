<?php declare(strict_types=1);

namespace MpApiClient\Financial\Entity\Common;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Customer implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string  $name;
    private string  $registrationNumber;
    private string  $taxIdentification;
    private string  $vatNumber;
    private string  $note;
    private Address $address;

    private function __construct(string $name, string $registrationNumber, string $taxIdentification, string $vatNumber, string $note, Address $address)
    {
        $this->name               = $name;
        $this->registrationNumber = $registrationNumber;
        $this->taxIdentification  = $taxIdentification;
        $this->vatNumber          = $vatNumber;
        $this->note               = $note;
        $this->address            = $address;
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
        );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRegistrationNumber(): string
    {
        return $this->registrationNumber;
    }

    public function getTaxIdentification(): string
    {
        return $this->taxIdentification;
    }

    public function getVatNumber(): string
    {
        return $this->vatNumber;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

}
