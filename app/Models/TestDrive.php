<?php

namespace App\Models;

use App\Models\Enums\TestDriveStatus;
use Illuminate\Database\Eloquent\Model;

class TestDrive extends Model
{
   protected $fillable = [
        'user_id',
        'vehicle_id',
        'date',
        'visit_time',
        'notes',
        'status',
    ];

    protected $casts = [
        'status' => TestDriveStatus::class,
        'date'   => 'date',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
