<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PaymentStatusEnum implements HasLabel
{
    case Paid;
    case NotPaid;

    public function getLabel(): ?string
    {
        return match ($this){
            self::Paid => 'Paid',
            self::NotPaid => 'Not Paid',
        };
    }
}
