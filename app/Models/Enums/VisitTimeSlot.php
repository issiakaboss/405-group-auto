<?php
namespace App\Models\Enums;

enum VisitTimeSlot: string
{
    case SLOT_0800 = '08:00';
    case SLOT_0900 = '09:00';
    case SLOT_1000 = '10:00';
    case SLOT_1100 = '11:00';
    case SLOT_1200 = '12:00';
    case SLOT_1300 = '13:00';
    case SLOT_1400 = '14:00';
    case SLOT_1500 = '15:00';
    case SLOT_1600 = '16:00';
    case SLOT_1700 = '17:00';
    case SLOT_1800 = '18:00';

    public function label(): string
    {
        return match ($this) {
            self::SLOT_0800 => '08:00 AM',
            self::SLOT_0900 => '09:00 AM',
            self::SLOT_1000 => '10:00 AM',
            self::SLOT_1100 => '11:00 AM',
            self::SLOT_1200 => '12:00 PM',
            self::SLOT_1300 => '01:00 PM',
            self::SLOT_1400 => '02:00 PM',
            self::SLOT_1500 => '03:00 PM',
            self::SLOT_1600 => '04:00 PM',
            self::SLOT_1700 => '05:00 PM',
            self::SLOT_1800 => '06:00 PM',
        };
    }
}