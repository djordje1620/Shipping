<?php

namespace App\Repositories;


use App\Config\MySql;

class CityRepository
{
    private MySql $mySql;

    public function __construct()
    {
        $this->mySql = new MySql();
    }

    public function getAllCities(): array
    {
        $stmt = $this->mySql->getDb()->prepare("SELECT * FROM Cities");
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }                                                                   
}