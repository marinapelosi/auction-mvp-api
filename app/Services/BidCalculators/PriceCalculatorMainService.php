<?php

namespace App\Services\BidCalculators;

use App\Enums\CarType;
use App\Services\BidCalculators\FeeRules\AssociationFeeRuleCalculatorService;
use App\Services\BidCalculators\FeeRules\BasicFeeRuleCalculatorService;
use App\Services\BidCalculators\FeeRules\SellerSpecialFeeRuleCalculatorService;
use App\Services\BidCalculators\FeeRules\StorageFeeRuleCalculatorService;

class PriceCalculatorMainService
{
    protected float $price;
    protected CarType $carType;

    protected BasicFeeRuleCalculatorService $basicFeeCalculator;
    protected SellerSpecialFeeRuleCalculatorService $sellerSpecialFeeCalculator;
    protected AssociationFeeRuleCalculatorService $associationFeeCalculator;
    protected StorageFeeRuleCalculatorService $storageFeeCalculator;

    public function __construct(float $price, CarType $carType)
    {
        $this->price = $price;
        $this->carType = $carType;

        $this->basicFeeCalculator = new BasicFeeRuleCalculatorService();
        $this->sellerSpecialFeeCalculator = new SellerSpecialFeeRuleCalculatorService();
        $this->associationFeeCalculator = new AssociationFeeRuleCalculatorService();
        $this->storageFeeCalculator = new StorageFeeRuleCalculatorService();
    }

    /**
     * Calculates and returns an array of fees and the total cost for the given car type and price.
     *
     * @return array
     */
    public function carPriceCalculator(): array
    {
        // Individual Fees Calculation
        $basicFee = $this->basicFeeCalculator->calculate($this->price, $this->carType);
        $sellerSpecialFee = $this->sellerSpecialFeeCalculator->calculate($this->price, $this->carType);
        $associationFee = $this->associationFeeCalculator->calculate($this->price);
        $storageFee = $this->storageFeeCalculator->calculate();


        $total = $this->calculateTotal([$basicFee, $sellerSpecialFee, $associationFee, $storageFee]);

        return $this->formatFees([
            'basicFee' => $basicFee,
            'sellerSpecialFee' => $sellerSpecialFee,
            'associationFee' => $associationFee,
            'storageFee' => $storageFee,
            'total' => $total,
        ]);
    }

    /**
     * Calculate the total fee based on individual fees.
     *
     * @param array $fees
     * @return float
     */
    protected function calculateTotal(array $fees): float
    {
        return $this->price + array_sum($fees);
    }

    /**
     * Format all fees to two decimal places.
     *
     * @param array $fees
     * @return array
     */
    protected function formatFees(array $fees): array
    {
        return array_map(fn($fee) => number_format($fee, 2, '.', ''), $fees);
    }
}
