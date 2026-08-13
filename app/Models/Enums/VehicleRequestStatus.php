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
        return match($this) {
            self::PENDING    => 'Pending',
            self::PROCESSING => 'Processing',
            self::COMPLETED  => 'Completed',
            self::CANCELLED  => 'Cancelled',
        };
    }

    public function badgeColor(): string
    {
        return match($this) {
            self::PENDING    => 'bg-amber-50 text-amber-700 border-amber-200/50',
            self::PROCESSING => 'bg-blue-50 text-blue-700 border-blue-200/50',
            self::COMPLETED  => 'bg-emerald-50 text-emerald-700 border-emerald-200/50',
            self::CANCELLED  => 'bg-red-50 text-red-700 border-red-200/50',
        };
    }
}