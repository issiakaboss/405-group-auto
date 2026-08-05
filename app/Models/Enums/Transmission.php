<?php

namespace App\Models\Enums;

enum Transmission: string
{
    case AUTOMATIC = 'Automatic transmission';
    case MANUAL = 'Manual transmission';
    case CVT = 'CVT';
    case DUAL_CLUTCH = 'Dual-Clutch';

    public function label(): string
    {
        return match ($this) {
            self::AUTOMATIC => 'Automatic',
            self::MANUAL => 'Manual',
            self::CVT => 'CVT',
            self::DUAL_CLUTCH => 'Dual-Clutch',
        };
    }
}
