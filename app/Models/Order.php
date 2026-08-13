<?php

namespace App\Models;

use App\Models\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{


    protected $fillable = [
        'user_id',
        'total_estimated_price',
        'status',
        'phone',
        'address',
        'city',
        'country',
        'notes',
    ];

    protected $casts = [
        'total_estimated_price' => 'decimal:2',
        'status' => OrderStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
