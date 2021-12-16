<?php declare(strict_types=1);

namespace MpApiClient\Order\Entity;

use DateTimeInterface;
use Exception;
use JsonSerializable;
use MpApiClient\Common\Util\InputDataUtil;
use MpApiClient\Common\Util\JsonSerializeEntityTrait;

final class Order implements JsonSerializable
{

    use JsonSerializeEntityTrait;

    private int                              $id;
    private int                              $purchaseId;
    private string                           $currency;
    private float                            $deliveryPrice;
    private float                            $codPrice;
    private float                            $cod;
    private float                            $discount;
    private string                           $paymentType;
    private string                           $deliveryMethod;
    private string                           $deliveryMethodId;
    private ?int                             $branchId;
    private Branches                         $branches;
    private ?string                          $trackingNumber;
    private ?string                          $trackingUrl;
    private ?DateTimeInterface               $shipDate;
    private ?DateTimeInterface               $deliveryDate;
    private ?DateTimeInterface               $deliveredAt;
    private ?DateTimeInterface               $firstDeliveryAttempt;
    private Customer                         $customer; // returned from API as address, but represents a customer
    private bool                             $confirmed;
    private StatusEnum                       $status;
    private ItemIterator                     $items;
    private bool                             $test;
    private bool                             $mdp;
    private bool                             $mdpClassic;
    private bool                             $mdpSpectrum;
    private bool                             $readyToReturn;
    private ?DateTimeInterface               $shipped;
    private ?DateTimeInterface               $open;
    private ?DateTimeInterface               $blocked;
    private ?DateTimeInterface               $lost;
    private ?DateTimeInterface               $returned;
    private ?DateTimeInterface               $cancelled;
    private ?DateTimeInterface               $delivered;
    private ?DateTimeInterface               $shipping;
    private ConsignmentStatusIterator        $ulozenkaStatusHistory;
    private ConsignmentStatusHistoryIterator $consignmentStatusHistory;

    private function __construct(
        int $id,
        int $purchaseId,
        string $currency,
        float $deliveryPrice,
        float $codPrice,
        float $cod,
        float $discount,
        string $paymentType,
        string $deliveryMethod,
        string $deliveryMethodId,
        ?int $branchId,
        Branches $branches,
        ?string $trackingNumber,
        ?string $trackingUrl,
        ?DateTimeInterface $shipDate,
        ?DateTimeInterface $deliveryDate,
        ?DateTimeInterface $deliveredAt,
        ?DateTimeInterface $firstDeliveryAttempt,
        Customer $address,
        bool $confirmed,
        StatusEnum $status,
        ItemIterator $items,
        bool $test,
        bool $mdp,
        bool $mdpClassic,
        bool $mdpSpectrum,
        bool $readyToReturn,
        ?DateTimeInterface $shipped,
        ?DateTimeInterface $open,
        ?DateTimeInterface $blocked,
        ?DateTimeInterface $lost,
        ?DateTimeInterface $returned,
        ?DateTimeInterface $cancelled,
        ?DateTimeInterface $delivered,
        ?DateTimeInterface $shipping,
        ConsignmentStatusIterator $ulozenkaStatusHistory,
        ConsignmentStatusHistoryIterator $consignmentStatusHistory
    ) {
        $this->id                       = $id;
        $this->purchaseId               = $purchaseId;
        $this->currency                 = $currency;
        $this->deliveryPrice            = $deliveryPrice;
        $this->codPrice                 = $codPrice;
        $this->cod                      = $cod;
        $this->discount                 = $discount;
        $this->paymentType              = $paymentType;
        $this->deliveryMethod           = $deliveryMethod;
        $this->deliveryMethodId         = $deliveryMethodId;
        $this->branchId                 = $branchId;
        $this->branches                 = $branches;
        $this->trackingNumber           = $trackingNumber;
        $this->trackingUrl              = $trackingUrl;
        $this->shipDate                 = $shipDate;
        $this->deliveryDate             = $deliveryDate;
        $this->deliveredAt              = $deliveredAt;
        $this->firstDeliveryAttempt     = $firstDeliveryAttempt;
        $this->customer                 = $address;
        $this->confirmed                = $confirmed;
        $this->status                   = $status;
        $this->items                    = $items;
        $this->test                     = $test;
        $this->mdp                      = $mdp;
        $this->mdpClassic               = $mdpClassic;
        $this->mdpSpectrum              = $mdpSpectrum;
        $this->readyToReturn            = $readyToReturn;
        $this->shipped                  = $shipped;
        $this->open                     = $open;
        $this->blocked                  = $blocked;
        $this->lost                     = $lost;
        $this->returned                 = $returned;
        $this->cancelled                = $cancelled;
        $this->delivered                = $delivered;
        $this->shipping                 = $shipping;
        $this->ulozenkaStatusHistory    = $ulozenkaStatusHistory;
        $this->consignmentStatusHistory = $consignmentStatusHistory;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @throws Exception
     * @internal
     */
    public static function createFromApi(array $data): self
    {
        return new self(
            (int) $data['id'],
            (int) $data['purchase_id'],
            (string) $data['currency'],
            (float) $data['delivery_price'],
            (float) $data['cod_price'],
            (float) $data['cod'],
            (float) $data['discount'],
            (string) $data['payment_type'],
            (string) $data['delivery_method'],
            (string) $data['delivery_method_id'],
            InputDataUtil::getNullableInt($data, 'branch_id'),
            Branches::createFromApi($data['branches']),
            InputDataUtil::getNullableString($data, 'tracking_number'),
            InputDataUtil::getNullableString($data, 'tracking_url'),
            InputDataUtil::getNullableDate($data, 'ship_date'),
            InputDataUtil::getNullableDate($data, 'delivery_date'),
            InputDataUtil::getNullableDate($data, 'delivered_at'),
            InputDataUtil::getNullableDate($data, 'first_delivery_attempt'),
            Customer::createFromApi($data['address']),
            (bool) $data['confirmed'],
            new StatusEnum((string) $data[StatusEnum::KEY_NAME]),
            ItemIterator::createFromApi($data['items']),
            (bool) $data['test'],
            (bool) $data['mdp'],
            (bool) $data['mdp_classic'],
            (bool) $data['mdp_spectrum'],
            (bool) $data['ready_to_return'],
            InputDataUtil::getNullableDate($data, 'shipped'),
            InputDataUtil::getNullableDate($data, 'open'),
            InputDataUtil::getNullableDate($data, 'blocked'),
            InputDataUtil::getNullableDate($data, 'lost'),
            InputDataUtil::getNullableDate($data, 'returned'),
            InputDataUtil::getNullableDate($data, 'cancelled'),
            InputDataUtil::getNullableDate($data, 'delivered'),
            InputDataUtil::getNullableDate($data, 'shipping'),
            ConsignmentStatusIterator::createFromApi($data['ulozenka_status_history']),
            ConsignmentStatusHistoryIterator::createFromApi($data['consignment_status_history']),
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPurchaseId(): int
    {
        return $this->purchaseId;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getDeliveryPrice(): float
    {
        return $this->deliveryPrice;
    }

    public function getCodPrice(): float
    {
        return $this->codPrice;
    }

    public function getCod(): float
    {
        return $this->cod;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function getPaymentType(): string
    {
        return $this->paymentType;
    }

    public function getDeliveryMethod(): string
    {
        return $this->deliveryMethod;
    }

    public function getDeliveryMethodId(): string
    {
        return $this->deliveryMethodId;
    }

    public function getBranchId(): ?int
    {
        return $this->branchId;
    }

    public function getBranches(): Branches
    {
        return $this->branches;
    }

    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    public function getTrackingUrl(): ?string
    {
        return $this->trackingUrl;
    }

    public function getShipDate(): ?DateTimeInterface
    {
        return $this->shipDate;
    }

    public function getDeliveryDate(): ?DateTimeInterface
    {
        return $this->deliveryDate;
    }

    public function getDeliveredAt(): ?DateTimeInterface
    {
        return $this->deliveredAt;
    }

    public function getFirstDeliveryAttempt(): ?DateTimeInterface
    {
        return $this->firstDeliveryAttempt;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function isConfirmed(): bool
    {
        return $this->confirmed;
    }

    public function getStatus(): StatusEnum
    {
        return $this->status;
    }

    public function getItems(): ItemIterator
    {
        return $this->items;
    }

    public function isTest(): bool
    {
        return $this->test;
    }

    public function isMdp(): bool
    {
        return $this->mdp;
    }

    public function isMdpClassic(): bool
    {
        return $this->mdpClassic;
    }

    public function isMdpSpectrum(): bool
    {
        return $this->mdpSpectrum;
    }

    public function isReadyToReturn(): bool
    {
        return $this->readyToReturn;
    }

    public function getShipped(): ?DateTimeInterface
    {
        return $this->shipped;
    }

    public function getOpen(): ?DateTimeInterface
    {
        return $this->open;
    }

    public function getBlocked(): ?DateTimeInterface
    {
        return $this->blocked;
    }

    public function getLost(): ?DateTimeInterface
    {
        return $this->lost;
    }

    public function getReturned(): ?DateTimeInterface
    {
        return $this->returned;
    }

    public function getCancelled(): ?DateTimeInterface
    {
        return $this->cancelled;
    }

    public function getDelivered(): ?DateTimeInterface
    {
        return $this->delivered;
    }

    public function getShipping(): ?DateTimeInterface
    {
        return $this->shipping;
    }

    public function getUlozenkaStatusHistory(): ConsignmentStatusIterator
    {
        return $this->ulozenkaStatusHistory;
    }

    public function getConsignmentStatusHistory(): ConsignmentStatusHistoryIterator
    {
        return $this->consignmentStatusHistory;
    }

}
