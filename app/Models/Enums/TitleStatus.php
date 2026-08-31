<?php

namespace App\Models\Enums;

enum TitleStatus: string
{
    case CLEAN_TITLE = 'clean_title';
    case SALVAGE = 'salvage';
    case REBUILT = 'rebuilt';
    case LEMON = 'lemon';

    public function label(): string
    {
        return __("enums.title_status.{$this->value}");
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::CLEAN_TITLE => 'bg-emerald-100 text-emerald-800 border-emerald-200',
            self::SALVAGE => 'bg-rose-100 text-rose-800 border-rose-200',
            self::REBUILT => 'bg-amber-100 text-amber-800 border-amber-200',
            self::LEMON => 'bg-slate-100 text-slate-700 border-slate-200',
        };
    }
}
