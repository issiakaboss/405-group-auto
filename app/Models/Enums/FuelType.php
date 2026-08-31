<?php

namespace App\Models\Enums;

enum FuelType: string
{
    case GASOLINE = 'gasoline';
    case DIESEL = 'diesel';
    case ELECTRIC = 'electric';
    case HYBRID = 'hybrid';
    case PLUG_IN_HYBRID = 'plug_in_hybrid';

    public function label(): string
    {
        return __("enums.fuel_type.{$this->value}");
    }
}
