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
    case ORANGE = 'orange';
    case YELLOW = 'yellow';
    case GOLD = 'gold';
    case BEIGE = 'beige';
    case TAN = 'tan';
    case BRONZE = 'bronze';
    case COPPER = 'copper';
    case BURGUNDY = 'burgundy';
    case MAROON = 'maroon';
    case PURPLE = 'purple';
    case PINK = 'pink';
    case TEAL = 'teal';
    case TURQUOISE = 'turquoise';
    case NAVY = 'navy';
    case CREAM = 'cream';
    case CHARCOAL = 'charcoal';
    case GRAPHITE = 'graphite';
    case PEARL = 'pearl';
    case TWO_TONE = 'two_tone';
    case CUSTOM = 'custom';

    public function label(): string
    {
        return __("enums.vehicle_color.{$this->value}");
    }
}
