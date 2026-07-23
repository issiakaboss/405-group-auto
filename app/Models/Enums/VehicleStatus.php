<?php

namespace App\Models\Enums;

enum VehicleStatus: string
{
    case AVAILABLE_USA = 'available_usa';
    case IN_TRANSIT = 'in_transit';
    case AVAILABLE_LOCAL = 'available_local';
    case SOLD = 'sold';

    // Méthode utilitaire pour afficher des libellés propres sur l'interface
    public function label(): string
    {
        return match($this) {
            self::AVAILABLE_USA => 'Stock USA',
            self::AVAILABLE_LOCAL => 'Stock Local',
            self::IN_TRANSIT => 'En Transit',
            self::SOLD => 'Vendu',
        };
    }

    // Couleur Tailwind associée pour les badges
    public function badgeColor(): string
    {
        return match($this) {
            self::AVAILABLE_USA => 'bg-amber-600 text-white',
            self::AVAILABLE_LOCAL => 'bg-green-600 text-white',
            self::IN_TRANSIT => 'bg-blue-600 text-white',
            self::SOLD => 'bg-red-600 text-white',
        };
    }
}