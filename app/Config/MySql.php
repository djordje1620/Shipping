<?php

namespace App\Config;

class MySql
{

    CONST DSN = "mysql:host=localhost; dbname=shipping;";
    const USER = "root";
    const PASSWORD = "";
    private readonly \PDO $db;
    public function __construct()
    {
        $this->db = new \PDO(self::DSN, self::USER, self::PASSWORD);
    }

    public function getDb(): \PDO
    {
        return $this->db;   
    }
}