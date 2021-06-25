<?php declare(strict_types=1);

namespace MpApiClient\Order\Entity;

use JsonSerializable;
use MpApiClient\Common\Util\InputDataUtil;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Customer implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private int     $customerId;
    private string  $name;
    private ?string $company;
    private string  $phone;
    private string  $email;
    private string  $street;
    private string  $city;
    private string  $zip;
    private string  $country;

    private function __construct(
        int $customerId,
        string $name,
        ?string $company,
        string $phone,
        string $email,
        string $street,
        string $city,
        string $zip,
        string $country
    ) {
        $this->customerId = $customerId;
        $this->name       = $name;
        $this->company    = $company;
        $this->phone      = $phone;
        $this->email      = $email;
        $this->street     = $street;
        $this->city       = $city;
        $this->zip        = $zip;
        $this->country    = $country;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (int) $data['customer_id'],
            (string) $data['name'],
            InputDataUtil::getNullableString($data, 'company'),
            (string) $data['phone'],
            (string) $data['email'],
            (string) $data['street'],
            (string) $data['city'],
            (string) $data['zip'],
            (string) $data['country'],
        );
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

}
