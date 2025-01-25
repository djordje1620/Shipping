<?php

namespace App\Interfaces;

interface IRequestHandler
{
    public function handleRequest(): void;
}