<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserRoleEnum implements HasLabel
{
    case Admin;

    public function getLabel(): ?string
    {
        return match ($this){
            self::Admin => 'Admin'
        };
    }
}
