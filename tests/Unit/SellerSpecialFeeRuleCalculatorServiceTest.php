<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Enums\CarType;
use App\Services\BidCalculators\FeeRules\SellerSpecialFeeRuleCalculatorService;

class SellerSpecialFeeRuleCalculatorServiceTest extends TestCase
{
    protected SellerSpecialFeeRuleCalculatorService $sellerSpecialFeeCalculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sellerSpecialFeeCalculator = new SellerSpecialFeeRuleCalculatorService();
    }

    /**
     * Test calculation of seller fee for a common car
     */
    public function testCalculateSellerFeeForCommonCar()
    {
        $price = 1000.00;
        $carType = CarType::COMMON;
        $expectedFee = $price * $carType->getSellerPercentageFee(); // 1000 * 0.02 = 20.00

        $calculatedFee = $this->sellerSpecialFeeCalculator->calculate($price, $carType);

        $this->assertEqualsWithDelta($expectedFee, $calculatedFee, 0.01);
    }

    /**
     * Test calculation of seller fee for a luxury car
     */
    public function testCalculateSellerFeeForLuxuryCar()
    {
        $price = 2500.00;
        $carType = CarType::LUXURY;
        $expectedFee = $price * $carType->getSellerPercentageFee(); // 2500 * 0.04 = 100.00

        $calculatedFee = $this->sellerSpecialFeeCalculator->calculate($price, $carType);

        $this->assertEqualsWithDelta($expectedFee, $calculatedFee, 0.01);
    }
}
