<?php

namespace App\Models\Enums;

enum BodyStyle: string
{
    case SEDAN = 'Sedan';
    case COUPE = 'Coupe';
    case SUV = 'SUV';
    case TRUCK_PICKUP = 'Truck/Pickup';
    case CONVERTIBLE = 'Convertible';
    case WAGON = 'Wagon';
    case HATCHBACK = 'Hatchback';

    public function label(): string
    {
        return match ($this) {
            self::SEDAN => 'Sedan',
            self::COUPE => 'Coupe',
            self::SUV => 'SUV',
            self::TRUCK_PICKUP => 'Truck / Pickup',
            self::CONVERTIBLE => 'Convertible',
            self::WAGON => 'Wagon',
            self::HATCHBACK => 'Hatchback',
        };
    }
}
