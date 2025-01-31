<?php

namespace App\Repositories;

use App\Config\MySql;
use App\Models\Shipments;

class ShipmentRepository
{
    private MySql $mySql;
    public function __construct()
    {
        $this->mySql = new MySql();
    }

    public function save(Shipments $shipment): bool
    {
        $query = "INSERT INTO shipments (user_id, tracking_number, status, size, location_from, location_to, method_id, note, delivery_info) VALUES (:user_id, :tracking_number, :status, :size, :location_from, :location_to, :method_id, :note, :delivery_info)";


        $stmt = $this->mySql->getDb()->prepare($query);

        return $stmt->execute([
            'user_id'           => $shipment->getUserId(),
            'tracking_number'   => $shipment->getTrackingNumber(),
            'status'            => $shipment->getStatus(),
            'size'              => $shipment->getSize(),
            'location_from'     => $shipment->getLocationFrom(),
            'location_to'       => $shipment->getLocationTo(),
            'method_id'         => $shipment->getMethodId(),
            'note'              => $shipment->getNote(),
            'delivery_info'     => $shipment->getDeliveryInfo()
        ]);
    }

    public function checkTrackingNumber($trackingNumber): bool
    {
        $stmt = $this->mySql->getDb()->prepare("SELECT COUNT(*) FROM shipments WHERE tracking_number = :tracking_number");
        $stmt->bindParam(':tracking_number', $trackingNumber);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function getShipmentsForUser(int $userId):array
    {
        $stmt = $this->mySql->getDb()->prepare("SELECT s.*, u.first_name, u.last_name, sm.method FROM shipments s INNER JOIN shipment_methods sm ON s.method_id=sm.id INNER JOIN users u ON s.user_id=u.id WHERE user_id = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getShipmentByTrackingNumber(string $tracking_number): mixed
    {
        $stmt = $this->mySql->getDb()->prepare("SELECT * FROM shipments WHERE tracking_number = :tracking_number");
        $stmt->bindParam(':tracking_number', $tracking_number);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
