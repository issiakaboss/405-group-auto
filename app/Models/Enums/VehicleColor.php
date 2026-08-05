<?php

namespace App\Models\Enums;

enum VehicleColor: string
{
    case WHITE = 'White';
    case BLACK = 'Black';
    case SILVER = 'Silver';
    case GRAY = 'Gray';
    case RED = 'Red';
    case BLUE = 'Blue';
    case BROWN = 'Brown';
    case GREEN = 'Green';
    case CUSTOM = 'Custom';

    public function label(): string
    {
        return match ($this) {
            self::WHITE => 'White',
            self::BLACK => 'Black',
            self::SILVER => 'Silver',
            self::GRAY => 'Gray',
            self::RED => 'Red',
            self::BLUE => 'Blue',
            self::BROWN => 'Brown',
            self::GREEN => 'Green',
            self::CUSTOM => 'Custom',
        };
    }
}
