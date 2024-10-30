<?php

namespace App\Services\BidCalculators\FeeRules;

use App\Enums\FixedFee;

class StorageFeeRuleCalculatorService
{
    /*
     * Return the Storage fixed Fee
     * @return float
     */
    public function calculate(): float
    {
        $storageFee = FixedFee::STORAGE_FEE;
        return $storageFee->getValue();
    }
}
