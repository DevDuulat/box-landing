<?php

namespace App\Enums;

enum ColorType: int
{
    case Brown = 1;
    case White = 2;

    public function label(): string
    {
        return match($this) {
            self::Brown => 'Бурый',
            self::White => 'Белый',
        };
    }
}
