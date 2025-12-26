<?php

namespace App\Enums;
enum Status: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'В ожидании',
            self::IN_PROGRESS => 'В работе',
            self::COMPLETED => 'Завершено',
            self::CANCELLED => 'Отменено',
        };
    }
}
