<?php

namespace App\Models\Enums;

enum MoneyOwedStatus: string
{
    case PAID_OFF = 'Paid Off (No balance)';
    case LIEN = 'Lien / Money Still Owed';

    public function label(): string
    {
        return match ($this) {
            self::PAID_OFF => 'Paid Off',
            self::LIEN => 'Lien / Money Still Owed',
        };
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::PAID_OFF => 'bg-emerald-100 text-emerald-800 border-emerald-200',
            self::LIEN => 'bg-amber-100 text-amber-800 border-amber-200',
        };
    }
}
