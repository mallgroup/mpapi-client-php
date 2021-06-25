<?php declare(strict_types=1);

namespace MpApiClient\Order\Entity;

use JsonSerializable;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Stats implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private int $blocked;
    private int $open;
    private int $shipping;
    private int $shipped;
    private int $cancelled;
    private int $delivered;
    private int $lost;
    private int $returned;

    private function __construct(int $blocked, int $open, int $shipping, int $shipped, int $cancelled, int $delivered, int $lost, int $returned)
    {
        $this->blocked   = $blocked;
        $this->open      = $open;
        $this->shipping  = $shipping;
        $this->shipped   = $shipped;
        $this->cancelled = $cancelled;
        $this->delivered = $delivered;
        $this->lost      = $lost;
        $this->returned  = $returned;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (int) $data['blocked'],
            (int) $data['open'],
            (int) $data['shipping'],
            (int) $data['shipped'],
            (int) $data['cancelled'],
            (int) $data['delivered'],
            (int) $data['lost'],
            (int) $data['returned'],
        );
    }

    public function getBlocked(): int
    {
        return $this->blocked;
    }

    public function getOpen(): int
    {
        return $this->open;
    }

    public function getShipping(): int
    {
        return $this->shipping;
    }

    public function getShipped(): int
    {
        return $this->shipped;
    }

    public function getCancelled(): int
    {
        return $this->cancelled;
    }

    public function getDelivered(): int
    {
        return $this->delivered;
    }

    public function getLost(): int
    {
        return $this->lost;
    }

    public function getReturned(): int
    {
        return $this->returned;
    }

}
