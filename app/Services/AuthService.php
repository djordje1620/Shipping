<?php

namespace App\Services;

use App\Config\Session;
use App\Repositories\UserRepository;

class AuthService
{
    private UserRepository $userRepository;
    private Session $session;

    public function __construct()
    {
        $this->session = new Session();
        $this->userRepository = new UserRepository();
    }

    public function login(string $email, string $password): bool
    {
        $user = $this->userRepository->getUserByEmail($email);

        if(!$user){
            $this->session->flash('form_validation_error', ["UserNotExists" =>["Invalid login details."]]);
            return false;
        }

        if(!password_verify($password,$user['password'])){
            $this->session->flash('form_validation_error', ["PasswordError" => ["Invalid password."]]);
            return false;
        }

        $this->session->set("LoggedIn", true);
        $this->session->set("User", $user['id']);
        $this->session->set("UserName", $user['first_name']);
        $this->session->set("Role", $user['role_id']);
        return true;
    }

    public function logout(): bool
    {
        $this->session->delete("LoggedIn");
        $this->session->delete("UserName");
        $this->session->delete("User");
        $this->session->delete("Role");

        return true;
    }
}