<?php

namespace App\Services\BidCalculators\FeeRules;

use App\Enums\CarType;
use App\Enums\FixedFee;

class BasicFeeRuleCalculatorService
{
    /*
     * Calculates the Basic Fee and returns a value depending on the car type range limit
     * @return float
     */
    public function calculate(float $price, CarType $carType): float
    {
        $feeRange = $carType->getBasicFeeRange();

        $basicFee = FixedFee::BASIC_FEE;

        $fee = $basicFee->isPercentage() ? $price * $basicFee->getValue() : $basicFee->getValue();

        if ($fee < $feeRange['FeeMin']) {
            return $feeRange['FeeMin'];
        }

        if ($fee > $feeRange['FeeMax']) {
            return $feeRange['FeeMax'];
        }

        return $fee;
    }
}
