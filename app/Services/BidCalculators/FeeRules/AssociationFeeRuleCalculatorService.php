<?php

namespace App\Services\BidCalculators\FeeRules;

use App\Enums\AssociationFee;

class AssociationFeeRuleCalculatorService
{
    /*
     * Return the Association Fee depending on the price range
     * @return float
     */
    public function calculate(float $price): float
    {
        return match (true) {
            $price > 0 && $price <= 500 => (float) AssociationFee::BETWEEN_1_TO_500->value,
            $price > 500 && $price <= 1000 => (float) AssociationFee::GREATER_THAN_500_UP_TO_1000->value,
            $price > 1000 && $price <= 3000 => (float) AssociationFee::GREATER_THAN_1000_UP_TO_3000->value,
            $price > 3000 => (float) AssociationFee::OVER_3000->value,
            default => 0,
        };
    }
}
