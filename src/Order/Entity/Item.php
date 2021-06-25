<?php declare(strict_types=1);

namespace MpApiClient\Order\Entity;

use JsonSerializable;
use MpApiClient\Common\Util\InputDataUtil;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Item implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private string $id;
    private int    $articleId;
    private int    $quantity;
    private float  $price;
    private int    $vat;
    private ?float $commission;
    private string $title;
    /**
     * @var string[]
     */
    private array $serialNumbers;

    /**
     * @param string     $id
     * @param int        $articleId
     * @param int        $quantity
     * @param float      $price
     * @param int        $vat
     * @param float|null $commission
     * @param string     $title
     * @param string[]   $serialNumbers
     */
    private function __construct(string $id, int $articleId, int $quantity, float $price, int $vat, ?float $commission, string $title, array $serialNumbers)
    {
        $this->id            = $id;
        $this->articleId     = $articleId;
        $this->quantity      = $quantity;
        $this->price         = $price;
        $this->vat           = $vat;
        $this->commission    = $commission;
        $this->title         = $title;
        $this->serialNumbers = $serialNumbers;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            $data['id'],
            (int) $data['article_id'],
            (int) $data['quantity'],
            (float) $data['price'],
            (int) $data['vat'],
            InputDataUtil::getNullableFloat($data, 'commission'),
            (string) $data['title'],
            $data['serial_numbers'],
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getArticleId(): int
    {
        return $this->articleId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getVat(): int
    {
        return $this->vat;
    }

    public function getCommission(): ?float
    {
        return $this->commission;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string[]
     */
    public function getSerialNumbers(): array
    {
        return $this->serialNumbers;
    }

}
