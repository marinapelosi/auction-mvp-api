<?php

namespace App\Services\BidCalculators\FeeRules;

use App\Enums\CarType;

class SellerSpecialFeeRuleCalculatorService
{
    /*
     * Calculates the Seller Fee and returns a value depending on the car type percentage for the Seller Fee
     * @return float
     */
    public function calculate(float $price, CarType $carType): float
    {
        return $price * $carType->getSellerPercentageFee();
    }
}
