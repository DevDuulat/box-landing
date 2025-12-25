<?php

namespace App\Enums;

enum LeadStatus: int
{
    case NEW = 1;
    case PROCESSED = 2;
    case CLOSED = 3;

    public function label(): string
    {
        return match($this) {
            self::NEW => 'Новая',
            self::PROCESSED => 'В обработке',
            self::CLOSED => 'Завершена',
        };
    }
}
