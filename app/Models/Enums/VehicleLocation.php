<?php

namespace App\Models\Enums;

enum VehicleLocation: string
{
    case USA_OKLAHOMA = 'usa_oklahoma';
    case USA_TEXAS    = 'usa_texas';
    case USA_FLORIDA  = 'usa_florida';
    case USA_GEORGIA  = 'usa_georgia';

    public function label(): string
    {
        return __("enums.vehicle_location.{$this->value}");
    }
}
