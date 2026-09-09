<?php

namespace App\Models\Enums;

enum VehicleModel: string
{
    case CAMRY = 'Camry';
    case COROLLA = 'Corolla';
    case RAV4 = 'RAV4';
    case HIGHLANDER = 'Highlander';
    case TACOMA = 'Tacoma';
    case TUNDRA = 'Tundra';
    case MUSTANG = 'Mustang';
    case F_150 = 'F-150';
    case EXPLORER = 'Explorer';
    case ESCAPE = 'Escape';
    case SILVERADO = 'Silverado';
    case EQUINOX = 'Equinox';
    case TAHOE = 'Tahoe';
    case SUBURBAN = 'Suburban';
    case CIVIC = 'Civic';
    case ACCORD = 'Accord';
    case CR_V = 'CR-V';
    case PILOT = 'Pilot';
    case ALTIMA = 'Altima';
    case SENTRA = 'Sentra';
    case ROGUE = 'Rogue';
    case PATHFINDER = 'Pathfinder';
    case SERIES_3 = '3 Series';
    case SERIES_5 = '5 Series';
    case X3 = 'X3';
    case X5 = 'X5';
    case C_CLASS = 'C-Class';
    case E_CLASS = 'E-Class';
    case GLC = 'GLC';
    case A4 = 'A4';
    case Q5 = 'Q5';
    case ES = 'ES';
    case RX = 'RX';
    case ELANTRA = 'Elantra';
    case TUCSON = 'Tucson';
    case SANTA_FE = 'Santa Fe';
    case SORENTO = 'Sorento';
    case SPORTAGE = 'Sportage';
    case CHEROKEE = 'Cherokee';
    case GRAND_CHEROKEE = 'Grand Cherokee';
    case WRANGLER = 'Wrangler';
    case MODEL_3 = 'Model 3';
    case MODEL_Y = 'Model Y';
    case OUTBACK = 'Outback';
    case CX_5 = 'CX-5';
    case CX_9 = 'CX-9';
    case GOLF = 'Golf';
    case TIGUAN = 'Tiguan';
    case MALIBU = 'Malibu';
    case CUSTOM = 'Custom';

    public function label(): string
    {
        return $this->value;
    }
}
