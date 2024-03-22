<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PaymentStepEnum implements HasLabel
{
    case DP;
    case P0;
    case P1;
    case P2;
    case SD;

    public function getLabel(): ?string
    {
        return match ($this){
            self::DP => 'Down Payment',
            self::P0 => 'Termin 1 / P0',
            self::P1 => 'Termin 2 / P1',
            self::P2 => 'Termin 3 / P2',
            self::SD => 'Jaminan',
        };
    }
}
