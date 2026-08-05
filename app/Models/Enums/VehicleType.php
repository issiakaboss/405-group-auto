<?php

namespace App\Models\Enums;

enum VehicleType: string
{
    case CARS_AND_TRUCKS = 'Cars & Trucks';
    case SUVs = 'SUVs';
    case VANS_MINIVANS = 'Vans/Minivans';
    case COMMERCIAL = 'Commercial';
    case LUXURY = 'Luxury';

    public function label(): string
    {
        return match ($this) {
            self::CARS_AND_TRUCKS => 'Cars & Trucks',
            self::SUVs => 'SUVs',
            self::VANS_MINIVANS => 'Vans / Minivans',
            self::COMMERCIAL => 'Commercial',
            self::LUXURY => 'Luxury',
        };
    }
}
