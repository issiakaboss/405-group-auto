<?php

namespace App\Models\Enums;

enum VisitTimeSlot: string
{
    case SLOT_0800 = 'slot_0800';
    case SLOT_0900 = 'slot_0900';
    case SLOT_1000 = 'slot_1000';
    case SLOT_1100 = 'slot_1100';
    case SLOT_1200 = 'slot_1200';
    case SLOT_1300 = 'slot_1300';
    case SLOT_1400 = 'slot_1400';
    case SLOT_1500 = 'slot_1500';
    case SLOT_1600 = 'slot_1600';
    case SLOT_1700 = 'slot_1700';
    case SLOT_1800 = 'slot_1800';

    public function label(): string
    {
        return __("enums.visit_time_slot.{$this->value}");
    }
}
