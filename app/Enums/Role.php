<?php

namespace App\Enums;
enum Role: string
{
    case ADMIN = 'Admin';
    case USER = 'User';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Администратор',
            self::USER => 'Пользователь',
        };
    }
}
