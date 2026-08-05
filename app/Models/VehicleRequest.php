<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleRequest extends Model
{
    use HasFactory;

    protected $fillable = [
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
    ];
}
