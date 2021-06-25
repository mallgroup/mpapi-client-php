<?php declare(strict_types=1);

namespace MpApiClient\Financial\Entity\Common;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Address implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string $street;
    private string $city;
    private string $zip;
    private string $country;

    private function __construct(string $street, string $city, string $zip, string $country)
    {
        $this->street  = $street;
        $this->city    = $city;
        $this->zip     = $zip;
        $this->country = $country;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (string) $data['street'],
            (string) $data['city'],
            (string) $data['zip'],
            (string) $data['country'],
        );
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
