<?php

namespace App\Models\Enums;

enum VehicleRequestStatus: string
{
    case PENDING    = 'pending';
    case PROCESSING = 'processing';
    case COMPLETED  = 'completed';
    case CANCELLED  = 'cancelled';

    public function label(): string
    {
        return __("enums.vehicle_request_status.{$this->value}");
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::PENDING    => 'bg-amber-500/15 text-amber-400 border-amber-500/30',
            self::PROCESSING => 'bg-blue-500/15 text-blue-400 border-blue-500/30',
            self::COMPLETED  => 'bg-emerald-500/15 text-emerald-400 border-emerald-500/30',
            self::CANCELLED  => 'bg-rose-500/15 text-rose-400 border-rose-500/30',
        };
    }
}
