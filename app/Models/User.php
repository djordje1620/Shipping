<?php

namespace App\Models;

use App\Config\MySql;
use PDO;

class User extends MySql
{
    private ?int $id;
    private string $email;
    private string $password;
    private ?int $role_id;
    private string $firstName;
    private string $lastName;
    private string $phone;
    private int $cityId;
    private string $street;

    public function __construct(
        ?int   $id,
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        int    $role_id,
        string $phone,
        int    $cityId,
        string $street
    )
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->role_id = $role_id;
        $this->phone = $phone;
        $this->cityId = $cityId;
        $this->street = $street;
    }

    // Getters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getCityId(): int
    {
        return $this->cityId;
    }

    public function getRoleId(): int
    {
        return $this->role_id;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

}