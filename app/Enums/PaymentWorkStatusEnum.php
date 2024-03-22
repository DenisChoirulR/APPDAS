<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PaymentWorkStatusEnum implements HasLabel
{
    case NotYet;
    case Progress;
    case Complete;

    public function getLabel(): ?string
    {
        return match ($this){
            self::NotYet => 'Not Yet',
            self::Progress => 'Progress',
            self::Complete => 'Complete',
        };
    }
}
