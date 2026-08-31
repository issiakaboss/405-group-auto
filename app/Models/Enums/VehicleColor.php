<?php

namespace App\Models\Enums;

enum VehicleColor: string
{
    case WHITE = 'white';
    case BLACK = 'black';
    case SILVER = 'silver';
    case GRAY = 'gray';
    case RED = 'red';
    case BLUE = 'blue';
    case BROWN = 'brown';
    case GREEN = 'green';
    case CUSTOM = 'custom';

    public function label(): string
    {
        return __("enums.vehicle_color.{$this->value}");
    }
}
