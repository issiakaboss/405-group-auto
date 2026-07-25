<?php

namespace App\Models\Enums;

enum VehicleStatus: string
{
    case AVAILABLE_USA   = 'available_usa';
    case AVAILABLE_LOCAL = 'available_local';
    case IN_TRANSIT      = 'in_transit';
    case ON_ORDER        = 'on_order'; // Disponible sur commande / importation

    public function label(): string
    {
        return match ($this) {
            self::AVAILABLE_USA   => 'Stock USA',
            self::AVAILABLE_LOCAL => 'Stock Local',
            self::IN_TRANSIT      => 'En Transit',
            self::ON_ORDER        => 'Sur Commande',
        };
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::AVAILABLE_USA   => 'bg-amber-600 text-white',
            self::AVAILABLE_LOCAL => 'bg-green-600 text-white',
            self::IN_TRANSIT      => 'bg-blue-600 text-white',
            self::ON_ORDER        => 'bg-purple-600 text-white',
        };
    }
}