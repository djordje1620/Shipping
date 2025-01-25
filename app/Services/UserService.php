<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    private UserRepository $userRepository;
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function registerUser(array $data): bool
    {
        $user = new User(
            null,
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            password_hash($data['password'], PASSWORD_BCRYPT),
            2,
            $data['phone'],
            $data['city'],
            $data['street'],
        );
        
        return $this->userRepository->save($user);
    }
}