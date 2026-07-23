<?php

namespace App\Models;

use App\Models\Enums\VehicleStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
   use HasFactory;

    protected $guarded = [];
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
        'status' => VehicleStatus::class,
        'images' => 'array',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
    ];
}
