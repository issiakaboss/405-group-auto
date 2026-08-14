<?php

namespace App\Models;

use App\Models\Enums\VehicleRequestStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'make',
        'model',
        'year_min',
        'year_max',
        'max_budget',
        'desired_mileage',
        'body_style',
        'name',
        'email',
        'phone',
        'zip_code',
        'notes',
        'status'
    ];

    protected $casts = [
        'status' => VehicleRequestStatus::class,
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
