<?php

namespace App\Models\Enums;

enum FuelType: string
{
    case GASOLINE = 'Gasoline';
    case DIESEL = 'Diesel';
    case ELECTRIC = 'Electric';
    case HYBRID = 'Hybrid';
    case PLUG_IN_HYBRID = 'Plug-in Hybrid';

    public function label(): string
    {
        return match ($this) {
            self::GASOLINE => 'Gasoline',
            self::DIESEL => 'Diesel',
            self::ELECTRIC => 'Electric',
            self::HYBRID => 'Hybrid',
            self::PLUG_IN_HYBRID => 'Plug-in Hybrid',
        };
    }
}
