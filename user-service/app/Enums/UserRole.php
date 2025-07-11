<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Entregador = 'courier';
    case Cliente = 'customer';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}