<?php

namespace App\Models;

use App\Config\MySql;

class ShipmentMethod extends MySql
{
    private MySql $mySql;

    public function __construct()
    {
        $this->mySql = new MySql();
    }

    public function getShipemntMethods(): array
    {
        $stmt = $this->mySql->getDb()->prepare("SELECT * FROM shipment_methods");
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}