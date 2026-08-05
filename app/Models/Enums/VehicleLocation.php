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
        return match($this) {
            self::USA_OKLAHOMA => 'Oklahoma (USA)',
            self::USA_TEXAS    => 'Texas (USA)',
            self::USA_FLORIDA  => 'Florida (USA)',
            self::USA_GEORGIA  => 'Georgia (USA)',
        };
    }
}