<?php

namespace App\Models\Enums;

enum BodyStyle: string
{
    case SEDAN = 'sedan';
    case COUPE = 'coupe';
    case SUV = 'suv';
    case TRUCK_PICKUP = 'truck_pickup';
    case CONVERTIBLE = 'convertible';
    case WAGON = 'wagon';
    case HATCHBACK = 'hatchback';

   public function label(): string
{
    return __("enums.body_style.{$this->value}");
}
}
