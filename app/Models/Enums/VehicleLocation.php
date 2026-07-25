<?php

namespace App\Models\Enums;

enum VehicleLocation: string
{
    case USA_OKLAHOMA      = 'usa_oklahoma';
    case CI_ABIDJAN        = 'ci_abidjan';
    case BF_OUAGADOUGOU    = 'bf_ouagadougou';
    case GH_ACCRA          = 'gh_accra';
    case TG_LOME           = 'tg_lome';

    public function label(): string
    {
        return match($this) {
            self::USA_OKLAHOMA   => 'Oklahoma City (USA)',
            self::CI_ABIDJAN     => 'Abidjan (Côte d\'Ivoire)',
            self::BF_OUAGADOUGOU => 'Ouagadougou (Burkina Faso)',
            self::GH_ACCRA       => 'Accra (Ghana)',
            self::TG_LOME        => 'Lomé (Togo)',
        };
    }
}