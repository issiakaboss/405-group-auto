<?php

namespace App\Models\Enums;

enum VehicleStatus: string
{
    case AVAILABLE  = 'available';   // En stock aux USA (disponible à l'achat / commande)
    case IN_TRANSIT = 'in_transit';  // En cours d'expédition maritime / douane
    case RESERVED   = 'reserved';    // Acompte versé par un client
    case SOLD       = 'sold';        // Vendu et livré
    
    public function label(): string
    {
        return __("enums.vehicle_status.{$this->value}");
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::AVAILABLE  => 'bg-emerald-600 text-white',
            self::IN_TRANSIT => 'bg-blue-600 text-white',
            self::RESERVED   => 'bg-amber-500 text-white',
            self::SOLD       => 'bg-gray-600 text-white',
        };
    }
}
