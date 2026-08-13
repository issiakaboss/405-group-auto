<?php

namespace App\Models\Enums;
enum TestDriveStatus: string
{
    case PENDING   = 'pending';
    case CONFIRMED = 'confirmed';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case CLOSED    = 'closed';

    public function label(): string
    {
        return match($this) {
            self::PENDING   => 'Pending',
            self::CONFIRMED => 'Confirmed',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
            self::CLOSED    => 'Closed',
        };
    }

    public function badgeColor(): string
    {
        return match($this) {
            self::PENDING   => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
            self::CONFIRMED => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
            self::COMPLETED => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
            self::CANCELLED => 'bg-rose-500/10 text-rose-400 border-rose-500/20',
            self::CLOSED    => 'bg-slate-500/10 text-slate-400 border-slate-500/20',
        };
    }
}