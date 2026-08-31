<?php

namespace App\Models\Enums;

enum OrderStatus: string
{
    case PENDING_REVIEW = 'pending_review';
    case CONFIRMED      = 'confirmed';
    case SHIPPING       = 'shipping';
    case DELIVERED      = 'delivered';
    case CANCELLED      = 'cancelled';

    public function label(): string
    {
        return __("enums.order_status.{$this->value}");
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::PENDING_REVIEW => 'bg-amber-100 text-amber-800 border-amber-200',
            self::CONFIRMED      => 'bg-blue-100 text-blue-800 border-blue-200',
            self::SHIPPING       => 'bg-purple-100 text-purple-800 border-purple-200',
            self::DELIVERED      => 'bg-emerald-100 text-emerald-800 border-emerald-200',
            self::CANCELLED      => 'bg-rose-100 text-rose-800 border-rose-200',
        };
    }
}
