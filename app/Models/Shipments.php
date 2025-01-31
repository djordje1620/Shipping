<?php

namespace App\Models;

//Status:
//poslato - 1, primljeno - 2, odbijeno - 3, vraceno - 3
//Size:
//small, medium, large
//Method:
//airplane, ship, truck


class Shipments
{

    private ?int $id;
    private ?int $userId;
    private ?string $trackingNumber;
    private ?string $status;
    private ?string $size;
    private ?string $locationFrom;
    private ?string $locationTo;
    private ?string $note;
    private ?int $methodId;
    private ?string $deliveryInfo;

    public function __construct(
        ?int $id = null,
        ?int $userId = null,
        ?string $trackingNumber = null,
        ?string $status = null,
        ?string $size = null,
        ?string $locationFrom = null,
        ?string $locationTo = null,
        ?string $note = null,
        ?int $methodId = null,
        ?string $deliveryInfo = null,
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->trackingNumber = $trackingNumber;
        $this->status = $status;
        $this->size = $size;
        $this->locationFrom = $locationFrom;
        $this->locationTo = $locationTo;
        $this->note = $note;
        $this->methodId = $methodId;
        $this->deliveryInfo = $deliveryInfo;
    }

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getLocationFrom(): ?string
    {
        return $this->locationFrom;
    }

    public function getLocationTo(): ?string
    {
        return $this->locationTo;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function getMethodId(): ?int
    {
        return $this->methodId;
    }

    public function getDeliveryInfo(): ?string
    {
        return $this->deliveryInfo;
    }

}