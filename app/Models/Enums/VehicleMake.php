<?php

namespace App\Models\Enums;

enum VehicleMake: string
{
    case TOYOTA = 'Toyota';
    case FORD = 'Ford';
    case CHEVROLET = 'Chevrolet';
    case BMW = 'BMW';
    case MERCEDES_BENZ = 'Mercedes-Benz';
    case HONDA = 'Honda';
    case NISSAN = 'Nissan';
    case AUDI = 'Audi';
    case LEXUS = 'Lexus';
    case HYUNDAI = 'Hyundai';
    case KIA = 'Kia';
    case DODGE = 'Dodge';
    case JEEP = 'Jeep';
    case VOLKSWAGEN = 'Volkswagen';
    case SUBARU = 'Subaru';
    case MAZDA = 'Mazda';
    case VOLVO = 'Volvo';
    case TESLA = 'Tesla';
    case GMC = 'GMC';
    case RAM = 'Ram';

    public function label(): string
    {
        return $this->value;
    }
}
