<?php

namespace App\Models;

use App\Models\Enums\OrderStatus;
use App\Models\Enums\VehicleLocation;
use App\Models\Enums\VehicleStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'brand',
        'model',
        'year',
        'mileage',
        'fuel_type',
        'transmission',
        'category',
        'price',
        'images',
        'status',
        'location',
        'is_featured',
    ];

    protected $casts = [
        'status'      => VehicleStatus::class,
        'location'    => VehicleLocation::class,
        'images'      => 'array',
        'is_featured' => 'boolean',
        'price'       => 'decimal:2',
    ];

  /**
     * Les éléments de commande associés à ce véhicule.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Les commandes associées à ce véhicule (via order_items).
     */
    public function orders(): HasManyThrough
    {
        return $this->hasManyThrough(Order::class, OrderItem::class, 'vehicle_id', 'id', 'id', 'order_id');
    }

    /**
     * Vérifie si cette unité physique précise a une commande en cours.
     */
    public function isCurrentlyReserved(): bool
    {
        return $this->orders()
            ->whereIn('orders.status', [
                OrderStatus::PENDING_REVIEW,
                OrderStatus::CONFIRMED,
                OrderStatus::SHIPPING,
            ])
            ->exists();
    }

    /**
     * Vérifie si ce véhicule a été livré/vendu.
     */
    public function hasBeenSold(): bool
    {
        return $this->orders()
            ->where('orders.status', OrderStatus::DELIVERED)
            ->exists();
    }
}
