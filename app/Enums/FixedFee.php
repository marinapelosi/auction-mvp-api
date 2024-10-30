<?php

namespace App\Enums;

enum FixedFee: string
{
    case BASIC_FEE = 'basic_fee';
    case STORAGE_FEE = 'storage_fee';

    public function getValue(): float
    {
        return match ($this) {
            self::BASIC_FEE => 0.10,
            self::STORAGE_FEE => 100.0,
        };
    }

    public function isPercentage(): bool
    {
        return match ($this) {
            self::BASIC_FEE => true,
            self::STORAGE_FEE => false,
        };
    }
}
