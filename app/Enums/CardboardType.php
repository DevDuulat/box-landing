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
            self::Micro => 'Микрокартон',
            self::ThreeLayer => 'Трехслойный',
            self::FiveLayer => 'Пятислойный',
        };
    }
}
