<?php

namespace App\Enums\Shipments;

enum SizeEnum: int
{
    case SMALL  = 1;
    case MEDIUM = 2;
    case LARGE = 3;

    public function getSizeName(): string
    {
        return match ($this){
            self::SMALL => 'Small',
            self::MEDIUM => 'Medium',
            self::LARGE => 'Large',
        };
    }
}
