<?php

namespace App\Enums\Shipments;

enum StatusEnum : int
{
    case SENT = 1;
    case RECEIVED = 2;
    case DENIED = 3;
    case RETURNED = 4;

    public function getStatusName(): string
    {
        return match ($this){
            self::SENT => 'SENT',
            self::RECEIVED => 'RECEIVED',
            self::DENIED => 'DENIED',
            self::RETURNED => 'RETURNED',
        };
    }
}

