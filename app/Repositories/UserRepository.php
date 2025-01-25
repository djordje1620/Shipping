<?php

namespace App\Repositories;

use App\Config\MySql;
use App\Models\User;

class UserRepository
{
    private MySql $mySql;

    public function __construct()
    {
        $this->mySql = new MySql();
    }

    public function save(User $user): bool
    {
        $query = "INSERT INTO users (email, password, role_id, first_name, last_name, phone, city_id, street) 
              VALUES (:email, :password, :role_id, :first_name, :last_name, :phone, :city_id, :street)";

        $stmt = $this->mySql->getDb()->prepare($query);

        return $stmt->execute([
            'email'      => $user->getEmail(),
            'password'   => $user->getPassword(),
            'role_id'    => $user->getRoleId(),
            'first_name' => $user->getFirstName(),
            'last_name'  => $user->getLastName(),
            'phone'      => $user->getPhone(),
            'city_id'    => $user->getCityId(),
            'street'     => $user->getStreet(),
        ]);
    }

    public function getUserByEmail(string $email): ?array
    {
        $stmt = $this->mySql->getDb()->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result === false ? null : $result;
    }

    public function getUserEmailById($userId): ?array
    {
        $query = "SELECT email FROM users WHERE id = :user_id";
        $stmt = $this->mySql->getDb()->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}