<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ActivityGroupEnum implements HasLabel
{
    case P0;
    case P1;
    case P2;


    public function getLabel(): ?string
    {
        return match ($this){
            self::P0 => 'Penanaman (P0)',
            self::P1 => 'Pemeliharaan (P1)',
            self::P2 => 'Pemeliharaan (P2)',
        };
    }
}
