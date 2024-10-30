<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Enums\CarType;
use App\Enums\FixedFee;
use App\Services\BidCalculators\FeeRules\BasicFeeRuleCalculatorService;

class BidBasicFeeRuleCalculatorServiceTest extends TestCase
{
    protected BasicFeeRuleCalculatorService $basicFeeCalculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->basicFeeCalculator = new BasicFeeRuleCalculatorService();
    }

    // Tests calculation within the valid range for a common car
    public function testCalculateWithinRangeForCommonCar()
    {
        $price = 300;
        $carType = CarType::COMMON;

        // Basic fee at 10%, expected result within range [10, 50]
        $expectedFee = $price * FixedFee::BASIC_FEE->getValue(); // 30
        $calculatedFee = $this->basicFeeCalculator->calculate($price, $carType);

        $this->assertEquals($expectedFee, $calculatedFee);
    }

    // Tests calculation below the minimum range for a common car
    public function testCalculateBelowRangeForCommonCar()
    {
        $price = 50;
        $carType = CarType::COMMON;

        // Calculated fee should return FeeMin (10) as it's below range
        $calculatedFee = $this->basicFeeCalculator->calculate($price, $carType);
        $this->assertEquals($carType->getBasicFeeRange()['FeeMin'], $calculatedFee);
    }

    // Tests calculation above the maximum range for a common car
    public function testCalculateAboveRangeForCommonCar()
    {
        $price = 1000;
        $carType = CarType::COMMON;

        // Calculated fee should return FeeMax (50) as it's above range
        $calculatedFee = $this->basicFeeCalculator->calculate($price, $carType);
        $this->assertEquals($carType->getBasicFeeRange()['FeeMax'], $calculatedFee);
    }

    // Tests calculation within the valid range for a luxury car
    public function testCalculateWithinRangeForLuxuryCar()
    {
        $price = 1000;
        $carType = CarType::LUXURY;

        // Basic fee at 10%, expected result within range [25, 200]
        $expectedFee = $price * FixedFee::BASIC_FEE->getValue(); // 100
        $calculatedFee = $this->basicFeeCalculator->calculate($price, $carType);

        $this->assertEquals($expectedFee, $calculatedFee);
    }

    // Tests calculation below the minimum range for a luxury car
    public function testCalculateBelowRangeForLuxuryCar()
    {
        $price = 50;
        $carType = CarType::LUXURY;

        // Calculated fee should return FeeMin (25) as it's below range
        $calculatedFee = $this->basicFeeCalculator->calculate($price, $carType);
        $this->assertEquals($carType->getBasicFeeRange()['FeeMin'], $calculatedFee);
    }

    // Tests calculation above the maximum range for a luxury car
    public function testCalculateAboveRangeForLuxuryCar()
    {
        $price = 5000;
        $carType = CarType::LUXURY;

        // Calculated fee should return FeeMax (200) as it's above range
        $calculatedFee = $this->basicFeeCalculator->calculate($price, $carType);
        $this->assertEquals($carType->getBasicFeeRange()['FeeMax'], $calculatedFee);
    }
}
