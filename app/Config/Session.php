<?php

namespace App\Config;

class Session
{
    public function __construct()
    {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }

    public function get(string $key)
    {
        return $_SESSION[$key];
    }

    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function hasKey(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function delete(string $key): void
    {
        unset($_SESSION[$key]);
    }


    public function flash(string $key, $value): void
    {
        $this->set($key, $value);
    }

    public function getFlash(string $key): ?array
    {
        $value = $this->get($key);
        $this->delete($key);
        return $value;
    }


}