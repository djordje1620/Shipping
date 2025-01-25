<?php

namespace App\Enums\Shipments;

enum LocationEnum: int
{
    case BELGRADE = 1;
    case NOVI_SAD = 2;
    case ZAGREB = 3;
    case SARAJEVO = 4;
    case PODGORICA = 5;
    case TIRANA = 6;
    case SKOPJE = 7;
    case BIJELJINA = 8;
    case ZENICA = 9;
    case TUZLA = 10;
    case MOSTAR = 11;
    case KRAGUJEVAC = 12;
    case NIŠ = 13;
    case VALJEVO = 14;
    case KIKINDA = 15;
    case SENTA = 16;
    case VRANJE = 17;
    case PRISTINA = 18;
    case GJAKOVA = 19;
    case MITROVICA = 20;

    public function getCityName(): string
    {
        return match ($this) {
            self::BELGRADE => 'Beograd',
            self::NOVI_SAD => 'Novi Sad',
            self::ZAGREB => 'Zagreb',
            self::SARAJEVO => 'Sarajevo',
            self::PODGORICA => 'Podgorica',
            self::TIRANA => 'Tirana',
            self::SKOPJE => 'Skoplje',
            self::BIJELJINA => 'Bijeljina',
            self::ZENICA => 'Zenica',
            self::TUZLA => 'Tuzla',
            self::MOSTAR => 'Mostar',
            self::KRAGUJEVAC => 'Kragujevac',
            self::NIŠ => 'Niš',
            self::VALJEVO => 'Valjevo',
            self::KIKINDA => 'Kikinda',
            self::SENTA => 'Senta',
            self::VRANJE => 'Vranje',
            self::PRISTINA => 'Priština',
            self::GJAKOVA => 'Gjakova',
            self::MITROVICA => 'Mitrovica',
        };
    }
}