<?php declare(strict_types=1);

namespace MpApiClient\Article\Entity\Common;

use JsonSerializable;
use MpApiClient\Common\Util\InputDataUtil;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Media implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string  $url;
    private bool    $main;
    private ?string $switch;
    private bool    $energyLabel;
    private bool    $informationList;

    public function __construct(string $url, bool $main, ?string $switch = null, bool $energyLabel = false, bool $informationList = false)
    {
        $this->url             = $url;
        $this->main            = $main;
        $this->switch          = $switch;
        $this->energyLabel     = $energyLabel;
        $this->informationList = $informationList;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (string) $data['url'],
            (bool) $data['main'],
            InputDataUtil::getNullableString($data, 'switch'),
            (bool) $data['energy_label'],
            (bool) $data['information_list'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function getArrayForApi(): array
    {
        return [
            'url'              => $this->getUrl(),
            'main'             => $this->isMain(),
            'switch'           => $this->getSwitch(),
            'energy_label'     => $this->isEnergyLabel(),
            'information_list' => $this->isInformationList(),
        ];
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function isMain(): bool
    {
        return $this->main;
    }

    public function setMain(bool $main): void
    {
        $this->main = $main;
    }

    public function getSwitch(): ?string
    {
        return $this->switch;
    }

    public function setSwitch(?string $switch): void
    {
        $this->switch = $switch;
    }

    public function isEnergyLabel(): bool
    {
        return $this->energyLabel;
    }

    public function setEnergyLabel(bool $energyLabel): void
    {
        $this->energyLabel = $energyLabel;
    }

    public function isInformationList(): bool
    {
        return $this->informationList;
    }

    public function setInformationList(bool $informationList): void
    {
        $this->informationList = $informationList;
    }

}
