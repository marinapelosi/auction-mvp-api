<?php

namespace App\Enums;

enum CarType: string
{
    case COMMON = 'common';
    case LUXURY = 'luxury';

    /**
     * Returns the allowed rate range for the car type.
     *
     * @return array ['FeeMin' => float, 'FeeMax' => float]
     */
    public function getBasicFeeRange(): array
    {
        return match ($this) {
            self::COMMON => ['FeeMin' => 10, 'FeeMax' => 50],
            self::LUXURY => ['FeeMin' => 25, 'FeeMax' => 200],
        };
    }

    /**
     * Returns the specific seller fee percentage for the car type
     *
     * @return float
     */
    public function getSellerPercentageFee(): float
    {
        return match ($this) {
            self::COMMON => 0.02,
            self::LUXURY => 0.04,
        };
    }
}
