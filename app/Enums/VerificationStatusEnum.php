<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum VerificationStatusEnum implements HasLabel
{
    case Passed;
    case NotPass;

    public function getLabel(): ?string
    {
        return match ($this){
            self::Passed => 'Lulus',
            self::NotPass => 'Tidak Lulus',
        };
    }
}
