<?php

namespace App\Models\Enums;

enum VehicleType: string
{
    case CARS_AND_TRUCKS = 'cars_and_trucks';
    case SUVs = 'suvs';
    case VANS_MINIVANS = 'vans_minivans';
    case COMMERCIAL = 'commercial';
    case LUXURY = 'luxury';

    public function label(): string
    {
        return __("enums.vehicle_type.{$this->value}");
    }
}
