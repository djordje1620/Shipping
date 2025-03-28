<?php

namespace App\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Services\UserService;
use App\Validators\Users\LoginValidator;
use App\Validators\Users\RegisterValidator;
use App\Config\Session;

class UserController
{
    private readonly Session $session;
    private readonly UserService $userService;
    private  readonly AuthService $authService;
    public function __construct()
    {
        $this->session = new Session();
        $this->userService = new UserService();
        $this->authService = new AuthService();
    }

    public function register(array $data): bool
    {
        $validator = new RegisterValidator();
        if(!$validator->validateData($data)){
            $this->session->flash("form_validation_error", $validator->getErrors());
            return false;
        }

        return $this->userService->registerUser($data);
    }

    public function login(array $data): bool
    {
        $validator = new LoginValidator();
        if(!$validator->validateData($data)){
            $this->session->flash("form_validation_error", $validator->getErrors());
            return false;
        }

        return $this->authService->login($data['email'], $data['password']);
    }

    public function logout(): bool
    {
        return $this->authService->logout();
    }
    
}