<?php

namespace App\Models\Enums;

enum Transmission: string
{
    case AUTOMATIC = 'automatic';
    case MANUAL = 'manual';
    case CVT = 'cvt';
    case DUAL_CLUTCH = 'dual_clutch';

    public function label(): string
    {
        return __("enums.transmission.{$this->value}");
    }
}
