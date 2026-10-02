<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class SoldVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'sold_date',
        'client_name',
        'client_phone',
        'invoice_path',
        'is_visible',
    ];

    protected $casts = [
        'sold_date' => 'date',
        'is_visible' => 'boolean',
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    protected static function booted(): void
    {
        static::deleting(function (SoldVehicle $soldVehicle): void {
            if ($soldVehicle->invoice_path) {
                Storage::disk('local')->delete($soldVehicle->invoice_path);
            }
        });
    }
}
