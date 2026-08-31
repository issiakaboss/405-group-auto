<?php

namespace App\Models;

use App\Models\Enums\BodyStyle;
use App\Models\Enums\FuelType;
use App\Models\Enums\Transmission;
use App\Models\Enums\VehicleColor;
use App\Models\Enums\VehicleLocation;
use App\Models\Enums\VehicleType;
use App\Models\Enums\OrderStatus;
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
        'make',
        'model',
        'trim',
        'year',
        'mileage',
        'vehicle_type',
        'body_style',
        'exterior_color',
        'interior_color',
        'fuel_type',
        'transmission',
        'has_clean_title',
        'location',
        'price',
        'description',
        'images',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'vehicle_type' => VehicleType::class,
        'body_style' => BodyStyle::class,
        'exterior_color' => VehicleColor::class,
        'interior_color' => VehicleColor::class,
        'fuel_type' => FuelType::class,
        'transmission' => Transmission::class,
        'has_clean_title' => 'boolean',
        'status' => VehicleStatus::class,
        'location' => VehicleLocation::class,
        'images' => 'array',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function orders(): HasManyThrough
    {
        return $this->hasManyThrough(Order::class, OrderItem::class, 'vehicle_id', 'id', 'id', 'order_id');
    }

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

    public function hasBeenSold(): bool
    {
        return $this->orders()
            ->where('orders.status', OrderStatus::DELIVERED)
            ->exists();
    }

    protected static function booted(): void
    {
        static::creating(function (Vehicle $vehicle): void {
            if (empty($vehicle->title)) {
                $vehicle->title = trim(sprintf('%s %s %s', $vehicle->make, $vehicle->model, $vehicle->trim ?: ''));
            }
        });

        static::updating(function (Vehicle $vehicle): void {
            if (empty($vehicle->title)) {
                $vehicle->title = trim(sprintf('%s %s %s', $vehicle->make, $vehicle->model, $vehicle->trim ?: ''));
            }
        });
    }

    public function getBrandAttribute(): ?string
    {
        return $this->attributes['make'] ?? null;
    }

    public function getCategoryAttribute(): ?string
    {
        return $this->attributes['vehicle_type'] ?? null;
    }

    public function getTitleAttribute($value): string
    {
        if (! empty($value)) {
            return $value;
        }

        return trim(sprintf('%s %s %s', $this->make, $this->model, $this->trim ?: ''));
    }
}
