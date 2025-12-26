<?php

namespace App\Enums;

enum CardboardType: int
{
    case Micro = 1;
    case ThreeLayer = 2;
    case FiveLayer = 3;


    public function label(): string
    {
        return match($this) {
            self::Micro => match(app()->getLocale()) {
                'kg' => 'Микрокартон',
                default => 'Микрокартон',
            },
            self::ThreeLayer => match(app()->getLocale()) {
                'kg' => 'Үч кабаттуу',
                default => 'Трехслойный',
            },
            self::FiveLayer => match(app()->getLocale()) {
                'kg' => 'Беш кабаттуу',
                default => 'Пятислойный',
            },
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($case) => [
            $case->value => $case->label()
        ])->toArray();
    }
}